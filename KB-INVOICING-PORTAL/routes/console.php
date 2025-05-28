<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\OrderDetail;
use App\Models\Renewal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderRenewalInvoice;
use App\Models\Notification;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('orders:check-renewals', function () {
    $today = Carbon::today();

    // Fetch all orders expiring soon or on the current day
    $orderDetails = OrderDetail::whereNotNull('end_date')
        // ->where('end_date', '>=', $today)
        // ->where(function ($query) use ($today) {
        //     $query
        //     // ->whereDate('end_date', '<=', $today->addDays(10))
        //     ->orWhereDate('end_date', '=', $today); // Include orders expiring today
        // })
        ->get();
        
    foreach ($orderDetails as $order) {
        createOrUpdateRenewal($order, $this);
    }

    $this->info('Renewal check completed.');
})->purpose('Check for expiring orders, create renewals, and send invoices.')
    ->daily(); // Schedules the command to run daily

function createOrUpdateRenewal(OrderDetail $orderDetail, $command)
{
    // Check if a renewal already exists and is unpaid
    $existingRenewal = Renewal::where('order_detail_id', $orderDetail->id)
        ->where('payment_status', 'unpaid')
        ->first();

    if ($existingRenewal) {
        $command->info("An unpaid renewal already exists for Order Detail ID: {$orderDetail->id}");
        return;
    }

    // Check if it's been at least 10 days since the last renewal
    $lastRenewal = Renewal::where('order_detail_id', $orderDetail->id)
        ->orderBy('created_at', 'desc')
        ->first();

    if ($lastRenewal && Carbon::parse($lastRenewal->created_at)->diffInDays(now()) < 10) {
        $command->info("Renewal cannot be created yet for Order Detail ID: {$orderDetail->id}. Wait for 10 days since the last renewal.");
        return;
    }

    // Calculate the duration between start_date and end_date
    $startDate = Carbon::parse($orderDetail->start_date);
    $endDate = Carbon::parse($orderDetail->end_date);
    $daysDifference = $endDate->diffInDays($startDate);

    // Generate a unique invoice number with random 7 digits
    $randomNumber = mt_rand(10000, 99999); // Generate a 7-digit random number

    // Fetch the last renewal invoice for the same order detail
    $lastOrderDetailInvoice = Renewal::where('order_detail_id', $orderDetail->id)
        ->orderBy('created_at', 'desc')
        ->value('invoice_number');

    // Check if there's a previous renewal and generate the new invoice number
    $baseInvoiceNumber = $orderDetail->order->invoice_number;
    $renewalCount = $lastOrderDetailInvoice
        ? intval(substr($lastOrderDetailInvoice, strrpos($lastOrderDetailInvoice, '-') + 1)) + 1
        : 1;

    // Generate the new invoice number for the renewal (e.g., INV1234567-78654321)
    $newInvoiceNumber = $baseInvoiceNumber . 'R' . $randomNumber;

    // Create the renewal record
    $renewal = Renewal::create([
        'order_detail_id' => $orderDetail->id,
        'renewal_price' => $orderDetail->price,
        'is_renewed' => false,
        'next_due_date' => $endDate->addDays($daysDifference), // Calculate next_due_date
        'invoice_number' => $newInvoiceNumber,
        'payment_status' => 'unpaid',
    ]);

    $command->info("Renewal created with Invoice Number: {$newInvoiceNumber} for Order Detail ID: {$orderDetail->id}. Payment unpaid.");

    // Send the invoice email for the renewal
    sendInvoice($orderDetail, $renewal, $command);
}

function sendInvoice(OrderDetail $order, Renewal $renewal, $command)
{
    $email = $order->order->user->email ?? null;

    if ($email) {
        try {
            // Sending the email
            Mail::to($email)->send(new OrderRenewalInvoice($order, $renewal));

            // Log notification in the database
            Notification::create([
                'user_id' => $order->order->user->id,
                'invoice_number' => $renewal->invoice_number,
                'type' => 'invoice',
                'channel' => 'email',
                'sent_at' => now(),
                'is_successful' => true,
                'response_details' => 'Invoice email sent successfully.'
            ]);

            $command->info("Invoice email sent to {$email} for Renewal Invoice Number: {$renewal->invoice_number}");

            
        } catch (\Exception $e) {
            // Log failed notification in the database
            Notification::create([
                'user_id' => $order->order->user->id,
                'invoice_number' => $renewal->invoice_number,
                'type' => 'invoice',
                'channel' => 'email',
                'sent_at' => now(),
                'is_successful' => false,
                'response_details' => $e->getMessage()
            ]);

            $command->error("Failed to send email to {$email} for Renewal Invoice Number: {$renewal->invoice_number}. Error: {$e->getMessage()}");
        }
    } else {
        $command->error("No email found for user associated with Renewal Invoice Number: {$renewal->invoice_number}");
    }
}
