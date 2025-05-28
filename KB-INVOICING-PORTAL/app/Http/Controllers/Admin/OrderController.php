<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StripePaymentService;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Carbon\Carbon;
use App\Models\{
    BankInformation,
    Order,
    Product,
    User,
    OrderDetail,
    Renewal,
};


class OrderController extends Controller
{
    protected $stripePaymentService, $sendInvoice;

    public function __construct(StripePaymentService $stripePaymentService)
    {
        $this->stripePaymentService = $stripePaymentService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch orders
            $orders = Order::with('user', 'orderDetails.product')->latest()->get();
            // Map orders to unified structure
            $ordersData = $orders->map(function ($order) {
                $firstDetail = $order->orderDetails->first(); // for start/end date
                $daysLeft = null;

                if ($firstDetail && $firstDetail->end_date) {
                    $endDate = Carbon::parse($firstDetail->end_date);
                    $now = Carbon::now();
                    $daysLeft = round($now->diffInDays($endDate, false), 0); // signed difference
                }

                return [
                    'id' => $order->id,
                    'domain' => $order->domain,
                    'invoice_number' => $order->invoice_number,
                    'user_email' => $order->user?->email ?? 'N/A',
                    'products' => $order->orderDetails->pluck('product.name')->implode(', '),
                    'amount' => $order->currency_symbol . $order->orderDetails->sum('price'),
                    'type' => 'initial',
                    'date' => $order->created_at->format('Y-m-d'),

                    'payment_status' => '<span class="badge bg-' . ($order->payment_status === 'paid' ? 'success' : 'warning') . '">' . ucfirst($order->payment_status) . '</span>',

                    'payment_interval' => '<span class="badge bg-info">' . ucfirst($order->payment_interval) . '</span>',

                    'expire_in' => $daysLeft !== null
                        ? '<span class="badge bg-' . ($daysLeft > 0 ? 'success' : 'danger') . '">' . abs($daysLeft) . ' days ' . ($daysLeft > 0 ? 'left' : 'ago') . '</span>'
                        : '<span class="badge bg-secondary">N/A</span>',
                ];
            });


            // Return for DataTable
            return datatables()->of($ordersData)
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.orders.edit', $row['id']);
                    $invoiceUrl = route('admin.orders.invoice', ['id' => $row['id'], 'type' => 'initial']);
                    $deleteUrl = route('admin.orders.destroy', $row['id']);

                    $status = strtolower(strip_tags($row['payment_status']));

                    return '
                <div class="dropdown">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    actions
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item edit" href="' . $editUrl . '"><i class="fas fa-edit me-2"></i> Edit</a></li>
                        <li><a class="dropdown-item invoice" href="' . $invoiceUrl . '"><i class="fas fa-file me-2"></i> Invoice</a></li>
                        <li><a class="dropdown-item delete" href="#" data-id="' . $row['id'] . '" data-url="' . $deleteUrl . '"><i class="fas fa-trash-alt me-2"></i> Delete</a></li>
                    <li>
    <a class="dropdown-item change-payment-status" href="#" 
        data-id="' . $row['id'] . '" 
        data-status="' . $status . '">
        <i class="fas fa-money-bill-wave me-2"></i> Mark as ' . ($status === 'paid' ? 'Unpaid' : 'Paid') . '
    </a>
</li>
                    </ul>
                </div>';
                })
                ->rawColumns(['payment_status', 'payment_interval', 'expire_in', 'action']) // ✅ important!
                ->addIndexColumn() // Adds DT_RowIndex

                ->make(true);
        }

        // Fetch products and users for the order form
        $products = Product::get();
        $users = User::get();

        return view('admin.orders.index', compact('products', 'users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'domain' => 'required|string',
            'payment_interval' => 'required|in:mo,yr,payment',
    
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.quantity' => 'required|integer|min:1',
            'order_details.*.price' => 'required|numeric|min:0',
            'bank_information_ids' => 'nullable|array',
            'bank_information_ids.*' => 'exists:bank_information,id',
            'currency' => 'required|string',
    
            // ✅ New validations
            'payment_type' => 'nullable|in:cash,stripe,bank_transfer',
            'tax_type' => 'nullable|in:percent,amount',
            'tax_value' => 'nullable|numeric|min:0',
            'notes' => 'nullable',
        ]);
    
        // Define currency symbols
        $currencySymbols = [
            'USD' => '$',
            'GBP' => '£',
            'PKR' => '₨.',
            'MYR' => 'RM.',
            // Add more if needed
        ];
    
        // Generate a unique invoice number
        $invoiceNumber = 'INV' . mt_rand(10000, 99999);
    
        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'domain' => $request->domain,
            'payment_interval' => $request->payment_interval,
            'payment_status' => $request->payment_status ?? 'unpaid',
            'notes' => $request->notes ?? null,
            'bank_information_ids' => $request->bank_information_ids ?? null,
            'currency' => $request->currency,
            'currency_symbol' => $currencySymbols[$request->currency] ?? $request->currency,
            'invoice_number' => $invoiceNumber,
    
            // ✅ New fields
            'payment_type' => $request->payment_type,
            'tax_type' => $request->tax_type,
            'tax_value' => $request->tax_value,
        ]);
    
        // Add order details
        foreach ($request->order_details as $detail) {
            $order->orderDetails()->create([
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'is_free' => $detail['is_free'] ?? false,
                'time_interval' => $detail['time_interval'] ?? false,
                'start_date' => $detail['start_date'] ?? null,
                'end_date' => $detail['end_date'] ?? null,
                'extra_days' => $detail['extra_days'] ?? null,
            ]);
        }
    
        return response()->json([
            'message' => 'Order created successfully with Invoice Number: ' . $invoiceNumber,
            'orderId' => $order->id,
        ]);
    }
    



    public function create()
    {
        // Fetch products and users for the order form
        $products = Product::get();
        $users = User::get();
        $banks = BankInformation::all();

        return view('admin.orders.create', compact('products', 'users', 'banks'));
    }

    public function edit($id)
    {
        $products = Product::get();
        $users = User::get();
        $order = Order::with('orderDetails')->findOrFail($id);
        $banks = BankInformation::all();

        return view('admin.orders.edit', compact('order', 'products', 'users', 'banks'));

        // return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'domain' => 'required|string',
            'payment_interval' => 'required|in:mo,yr,payment',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.quantity' => 'required|integer|min:1',
            'order_details.*.price' => 'required|numeric|min:0',
            'bank_information_ids' => 'nullable|array',
            'bank_information_ids.*' => 'exists:bank_information,id',
            'currency' => 'required|string',

            // ✅ New validations
            'payment_type' => 'nullable|in:cash,stripe,bank_transfer',
            'tax_type' => 'nullable|in:percent,amount',
            'tax_value' => 'nullable|numeric|min:0',
            'notes' => 'nullable',
        ]);

        // Define currency symbols
        $currencySymbols = [
            'USD' => '$',
            'GBP' => '£',
            'PKR' => '₨.',
            'MYR' => 'RM.',
            // add more if needed
        ];

        $order = Order::findOrFail($id);

        // Update order fields
        $order->user_id = $request->user_id;
        $order->domain = $request->domain;
        $order->payment_interval = $request->payment_interval;
        $order->notes = $request->notes ?? null;
        $order->bank_information_ids = $request->bank_information_ids ?? null;
        $order->currency = $request->currency;
        $order->currency_symbol = $currencySymbols[$request->currency] ?? $request->currency; // fallback
        $order->payment_type = $request->payment_type;
        $order->tax_type = $request->tax_type;
        $order->tax_value = $request->tax_value;
        $order->save();

        // Update or create order details
        $existingDetails = $order->orderDetails()->pluck('id')->toArray();
        $submittedDetails = collect($request->order_details)->pluck('id')->filter()->toArray();

        // Delete removed order details
        $detailsToDelete = array_diff($existingDetails, $submittedDetails);
        OrderDetail::destroy($detailsToDelete);

        // Process submitted details
        foreach ($request->order_details as $detail) {
            $order->orderDetails()->updateOrCreate(
                ['id' => $detail['id'] ?? null], // Match existing detail if ID is provided
                [
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                    'is_free' => $detail['is_free'] ?? false,
                    'time_interval' => $detail['time_interval'] ?? false,
                    'start_date' => $detail['start_date'] ?? null,
                    'end_date' => $detail['end_date'] ?? null,
                    'extra_days' => $detail['extra_days'] ?? null,
                ]
            );
        }

        return response()->json(['message' => 'Order updated successfully.']);
    }

    public function destroy($id)
    {
        try {
            // Find the order by ID and delete it
            $order = Order::findOrFail($id);
            $order->delete();

            return response()->json(['message' => 'Order deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete the order.'], 500);
        }
    }
    public function invoice($id, $type)
    {

        if ($type === 'initial') {
            $order = Order::with('orderDetails.product', 'user')->findOrFail($id);
            // Fetch banks using stored bank IDs (nullable-safe)
            $bankInfos = BankInformation::whereIn('id', $order->bank_information_ids ?? [])->get();
            $data = [
                'invoice_no' => $order->invoice_number,
                'date' => $order->created_at->format('Y-m-d'),

                'currency_symbol' => $order->currency_symbol,
                'payment_status' => $order->payment_status,
                'tax_type' => $order->tax_type,
                'tax_value' => $order->tax_value,
                'payment_type' => $order->payment_type,

                'user' => [
                    'name' => $order->user->name,
                    'address' => $order->user->address,
                    'email' => $order->user->email,
                    'phone' => $order->user->phone,
                ],
                'items' => $order->orderDetails->map(function ($item) {
                    return [
                        'product_name' => $item->product->name,
                        'price' => $item->is_free ? 'Free' : $item->price,
                        'quantity' => $item->quantity,
                        'expire_in' => $item->time_interval == 1 ? 'Full Time Access' : $item->formatted_end_date,
                        'total' => $item->is_free ? '-' : $item->price * $item->quantity,
                    ];
                }),
                'bank_infos' => $bankInfos->map(function ($bank) {
                    return [
                        'bank_name' => $bank->bank_name,
                        'account_name' => $bank->account_name,
                        'account_number' => $bank->account_number,
                        'swift_code' => $bank->swift_code,
                        'iban' => $bank->iban,
                    ];
                }),
                'notes' => $order->notes,
            ];
        } elseif ($type === 'renewal') {
            $renewal = Renewal::with('orderDetail.product', 'orderDetail.order.user')->findOrFail($id);
            $data = [
                'invoice_no' => $renewal->invoice_number,
                'date' => $renewal->created_at->format('Y-m-d'),

                'currency_symbol' => $renewal->orderDetail->order->currency_symbol,
                'payment_status' => $renewal->orderDetail->order->payment_status,
                'tax_type' => $renewal->orderDetail->order->tax_type,
                'tax_value' => $renewal->orderDetail->order->tax_value,
                'payment_type' => $renewal->orderDetail->order->payment_type,


                'user' => [
                    'name' => $renewal->orderDetail->order->user->name,
                    'address' => $renewal->orderDetail->order->user->address,
                    'email' => $renewal->orderDetail->order->user->email,
                    'phone' => $renewal->orderDetail->order->user->phone,
                ],
                'items' => [
                    [
                        'product_name' => $renewal->orderDetail->product->name,
                        'price' => $renewal->orderDetail->is_free ? 'Free' : $renewal->orderDetail->price,
                        'quantity' => $renewal->orderDetail->quantity,
                        'expire_in' => $renewal->orderDetail->time_interval == 1 ? 'Full Time Access' : $renewal->orderDetail->formatted_end_date,
                        'total' => $renewal->orderDetail->is_free ? '-' : $renewal->orderDetail->price * $renewal->orderDetail->quantity,
                    ],
                ],
                'notes' => $renewal->notes,
            ];
        } else {
            abort(404, 'Invalid Invoice Type');
        }

        return view('admin.invoice.invoice', compact('data', 'type'));
    }



    public function invoice_index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch orders
            $orders = Order::with('user', 'orderDetails.product')->where('invoice_number', 'INV39596')->latest()->get();


            // Fetch renewals
            $renewals = Renewal::with('orderDetail.product', 'orderDetail.order.user')->get();

            // Map orders to unified structure
            $ordersData = $orders->map(function ($order) {
                $firstDetail = $order->orderDetails->first(); // for start/end date
                $daysLeft = null;

                if ($firstDetail && $firstDetail->end_date) {
                    $endDate = Carbon::parse($firstDetail->end_date);
                    $now = Carbon::now();
                    $daysLeft = round($now->diffInDays($endDate, false), 0); // signed difference
                }

                return [
                    'id' => $order->id,
                    'invoice_number' => $order->invoice_number,
                    'user_name' => $order->user?->name ?? 'N/A',
                    'products' => $order->orderDetails->pluck('product.name')->implode(', '),
                    'amount' => $order->currency_symbol . $order->orderDetails->sum('price'),
                    'type' => 'initial',
                    'date' => $order->created_at->format('Y-m-d'),

                    'payment_status' => '<span class="badge bg-' . ($order->payment_status === 'paid' ? 'success' : 'warning') . '">' . ucfirst($order->payment_status) . '</span>',

                    'payment_interval' => '<span class="badge bg-info">' . ucfirst($order->payment_interval) . '</span>',

                    'expire_in' => $daysLeft !== null
                        ? '<span class="badge bg-' . ($daysLeft > 0 ? 'success' : 'danger') . '">' . abs($daysLeft) . ' days ' . ($daysLeft > 0 ? 'left' : 'ago') . '</span>'
                        : '<span class="badge bg-secondary">N/A</span>',
                ];
            });

            // Map renewals to unified structure
            $renewalsData = $renewals->map(function ($renewal) {
                $detail = $renewal->orderDetail;
                $daysLeft = null;

                if ($detail && $detail->end_date) {
                    $endDate = Carbon::parse($detail->end_date);
                    $now = Carbon::now();
                    $daysLeft = round($now->diffInDays($endDate, false), 0);
                }

                $order = $detail->order;

                return [
                    'id' => $renewal->id,
                    'invoice_number' => $renewal->invoice_number,
                    'user_name' => $order->user?->name ?? 'N/A',
                    'products' => $detail->product?->name ?? 'N/A',
                    'amount' => $order->currency_symbol . $renewal->renewal_price,
                    'type' => 'renewal',
                    'date' => $renewal->created_at->format('Y-m-d'),

                    'payment_status' => '<span class="badge bg-' . ($renewal->payment_status === 'paid' ? 'success' : 'warning') . '">' . ucfirst($renewal->payment_status) . '</span>',

                    'payment_interval' => '<span class="badge bg-info">' . ucfirst($renewal->payment_interval) . '</span>',

                    'expire_in' => $daysLeft !== null
                        ? '<span class="badge bg-' . ($daysLeft > 0 ? 'success' : 'danger') . '">' . abs($daysLeft) . ' days ' . ($daysLeft > 0 ? 'left' : 'ago') . '</span>'
                        : '<span class="badge bg-secondary">N/A</span>',
                ];
            });

            // Combine orders and renewals data
            $allInvoices = $ordersData->merge($renewalsData);

            // Return for DataTable
            return datatables()->of($allInvoices)
                ->addColumn('action', function ($row) {
                    $invoiceUrl = route('admin.orders.invoice', ['id' => $row['id'], 'type' => $row['type']]);
                    $sendInvoice = route('admin.orders.invoice.send', ['invoice_number' => $row['invoice_number'], 'type' => $row['type']]);

                    $btn = '<a href="' . $invoiceUrl . '" class="invoice btn btn-success btn-sm">';
                    $btn .= '<i class="fas fa-file"></i>';
                    $btn .= '</a>';

                    return $btn;
                })
                ->addIndexColumn() // Adds DT_RowIndex
                ->rawColumns(['payment_status', 'payment_interval', 'expire_in', 'action']) // ✅ important!
                ->make(true);
        }

        return view('admin.invoice.invoices');
    }


    public function invoice_show(Request $request)
    {

    }



    public function invoice_pay($invoice_no, StripePaymentService $stripePaymentService)
    {
        // Check if the invoice is for an initial order or a renewal
        $order = Order::with('orderDetails.product', 'user')->where('invoice_number', $invoice_no)->first();

        if (!$order) {
            // If the order doesn't exist, check if it's a renewal
            $renewal = Renewal::with('orderDetail.product', 'orderDetail.order.user')->where('invoice_number', $invoice_no)->firstOrFail();
            $order = $renewal->orderDetail->order; // For renewals, retrieve the associated order
            $type = 'renewal';

            // Build array for renewal
            $paymentData = [
                'invoice_number' => $renewal->invoice_number,
                'amount' => $order->currency_symbol . $renewal->orderDetail->is_free ? 0 : $renewal->orderDetail->price * $renewal->orderDetail->quantity,
                'items' => [
                    [
                        'product_name' => $renewal->orderDetail->product->name,
                        'price' => $renewal->orderDetail->price,
                        'quantity' => $renewal->orderDetail->quantity,
                    ],
                ],
                'customer' => [
                    'name' => $renewal->orderDetail->order->user->name,
                    'email' => $renewal->orderDetail->order->user->email,
                ],
            ];
        } else {
            // If it's an initial order
            $type = 'initial';

            // Build array for initial order
            $paymentData = [
                'invoice_number' => $order->invoice_number,
                'amount' => $order->currency_symbol . $order->orderDetails->where('is_free', false)->sum(function ($item) {
                    return $item->price * $item->quantity;
                }),
                'items' => $order->orderDetails->map(function ($item) {
                    return [
                        'product_name' => $item->product->name,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                    ];
                })->toArray(),
                'customer' => [
                    'name' => $order->user->name,
                    'email' => $order->user->email,
                ],
            ];
        }

        // Create Stripe Checkout session
        $session = $stripePaymentService->createCheckoutSession($paymentData, $type);

        // Redirect to Stripe Checkout page
        return redirect($session->url);
    }

    // Success method
    public function success(Request $request)
    {
        // Get the session ID from the query string
        $sessionId = $request->get('session_id');

        // Set the Stripe API key (in your .env file)
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Retrieve the session details from Stripe
            $session = StripeSession::retrieve($sessionId);

            // Retrieve the associated order
            if ($session->metadata->type === 'initial') {
                $order = Order::where('invoice_number', $request->get('invoice_no'))->first();



                // Check if the order is valid
                if (!$order) {
                    return redirect('/')->with('error', 'Invalid order.');
                }

                // Mark the order as paid (you can set more payment-related logic here)
                $order->payment_status = 'paid';
                $order->update();

            } else {
                $renewal = Renewal::where('invoice_number', $request->get('invoice_no'))->first();
                $order = $renewal;


                // Check if the order is valid
                if (!$order) {
                    return redirect('/')->with('error', 'Invalid order.');
                }

                // Mark the order as paid (you can set more payment-related logic here)
                $order->is_renewed = true;
                $order->payment_status = 'paid';
                $order->update();
            }
            // Optionally, you can send a success email, update notification logs, etc.

            // return redirect()->route('admin.orders.invoice.success', $order->invoice_number)
            //     ->with('success', 'Payment successful!');

            // Redirect to a success page
            return redirect('/admin/invoices')
                ->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Payment failed. Please try again.');
        }
    }

    // Cancel method
    public function cancel()
    {
        // Redirect back to the order page or provide a message to the user
        return redirect()->route('admin.orders.index')
            ->with('error', 'Payment was canceled. Please try again.');
    }

    function sendInvoice($invoice_number, $type)
    {
        $email = $order->order->user->email ?? null;

        // $order = Renewal::where('invoice_number', $invoice_number)->first();

        // if ($email) {
        //     try {
        //         // Sending the email
        //         Mail::to($email)->send(new OrderRenewalInvoice($order, $renewal));

        //         // Log notification in the database
        //         Notification::create([
        //             'user_id' => $order->order->user->id,
        //             'invoice_number' => $renewal->invoice_number,
        //             'type' => 'invoice',
        //             'channel' => 'email',
        //             'sent_at' => now(),
        //             'is_successful' => true,
        //             'response_details' => 'Invoice email sent successfully.'
        //         ]);

        //         Log::info("Invoice email sent to {$email} for Renewal Invoice Number: {$renewal->invoice_number}");


        //     } catch (\Exception $e) {
        //         // Log failed notification in the database
        //         Notification::create([
        //             'user_id' => $order->order->user->id,
        //             'invoice_number' => $renewal->invoice_number,
        //             'type' => 'invoice',
        //             'channel' => 'email',
        //             'sent_at' => now(),
        //             'is_successful' => false,
        //             'response_details' => $e->getMessage()
        //         ]);

        //         Log::info("Failed to send email to {$email} for Renewal Invoice Number: {$renewal->invoice_number}. Error: {$e->getMessage()}");
        //     }
        // } else {
        //     Log::info("No email found for user associated with Renewal Invoice Number: {$renewal->invoice_number}");
        // }
    }

    public function togglePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validStatuses = ['paid', 'unpaid', 'cancelled'];
        $requestedStatus = $request->input('status');

        if (!in_array($requestedStatus, $validStatuses)) {
            return response()->json(['success' => false, 'message' => 'Invalid status.']);
        }

        $order->payment_status = $requestedStatus;
        $order->save();

        return response()->json([
            'success' => true,
            'new_status' => $order->payment_status,
        ]);
    }




}
