<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Payment;
use App\Models\Gateway;
use App\Models\Brand;
use App\Models\Customer;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Services\PayPalService;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Setting;

// use Barryvdh\DomPDF\Facade\Pdf;


class PaymentController extends Controller
{

    protected $payPalService;

    public function __construct(PayPalService $payPalService)
    {
        $this->payPalService = $payPalService;
    }

    public function index()
    {
        // Check if the authenticated user is an admin
        if (auth()->user()->is_admin) {
            // Admin can view all payments
            $payments = Payment::with('gateway', 'customer', 'brand', 'user')
                ->orderBy('created_at', 'DESC')
                ->get();

        } else {
            // Regular user can only view their own payments
            $payments = Payment::with('gateway', 'customer', 'brand', 'user')
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        return view('payment.index', ['payments' => $payments]);
    }


    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), Payment::$rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $validator->validated();

            // If customer is new
            if ((int) $request->customer_type === 1) {
                $customer = Customer::create([
                    'uid' => mt_rand(10000000, 99999999),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                ]);

                $data['customer_id'] = $customer->id;
            }

            $data['user_id'] = auth()->id();
            $data['status'] = 'unpaid';
            $data['invoice_number'] = 'INV' . time();

            // Create payment
            $payment = Payment::create($data);

            if (!$payment) {
                return response()->json([
                    'message' => 'Failed to create payment'
                ], 500);
            }

            $link = url("/proceed/{$payment->invoice_number}");

            try {
                $setting = Setting::first();

                Mail::to($payment->customer->email)
                    ->cc($setting?->primary_email)
                    ->send(new InvoiceMail($payment));

            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());

                return response()->json([
                    'message' => 'Payment created, but failed to send email',
                    'link' => $link,
                    'email_error' => $e->getMessage()
                ], 202);
            }

            return response()->json([
                'message' => 'Payment created successfully',
                'link' => $link
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Payment creation failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred during payment processing',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function create()
    {
        $customers = Customer::all();
        $gateways = Gateway::all();
        $brands = Brand::all();
        return view('payment.create', [
            'customers' => $customers,
            'gateways' => $gateways,
            'brands' => $brands,
        ]);
    }

    public function edit($id)
    {
        $payment = Payment::find($id);
        $customers = Customer::all();
        $gateways = Gateway::all();
        $brands = Brand::all();

        return view('payment.edit', [
            'customers' => $customers,
            'gateways' => $gateways,
            'brands' => $brands,
            'payment' => $payment,
        ]);
    }

    public function show(Payment $payment)
    {
        return $payment;
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), Payment::$rules);

        // If validation fails, return validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the existing payment record
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Check if the customer needs to be updated or if a new customer is being created
        if ($request->customer_type == 1) {
            // Create a new customer
            $uid = mt_rand(10000000, 99999999);
            $customer = Customer::create([
                'uid' => $uid,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            // Update the payment with the new customer ID
            $payment->customer_id = $customer->id;
        }

        // Update the payment details
        $payment->update(array_merge($request->all(), [
            'user_id' => auth()->user()->id,
        ]));

        // Generate the link for customers to proceed
        $link = url("/proceed/{$payment->invoice_number}");

        $setting = Setting::first();

        try {
            // Send the email with CC
            Mail::to($payment->customer->email)
                ->cc($setting->primary_email)  // Add CC email here
                ->send(new InvoiceMail($payment));
        } catch (Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            // Optionally, you can add an error flag or message to the response
        }

        // Return success response with the payment link
        return response()->json(['message' => 'Payment updated successfully', 'link' => $link], 200);
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return back()->with('message', 'Payment deleted successfully');
    }

    public function proceed($invoice_number)
    {
        $payment = Payment::with('customer', 'gateway', 'brand')->where('invoice_number', $invoice_number)->first();

        return view('proceed', compact('payment'));
    }

    public function pay($invoice_number)
    {
        $payment = Payment::with('customer', 'gateway', 'brand')->where('invoice_number', $invoice_number)->first();
        // Calculate the total amount including tax
        $taxAmount = ($payment->price * $payment->tax) / 100;
        $totalAmount = $payment->price + $taxAmount;


        $expirationTime = now()->addDays(7);

        // Set the secret key for Stripe API
        Stripe::setApiKey($payment->gateway->key2);
        // Create a Stripe Checkout session
        $productData = [
            'name' => $payment->package_name,
            'description' => $payment->description,
        ];
        // Only add the image if it exists
        if (!empty($payment->brand->logo_path)) {
            $productData['images'] = [asset('storage/' . $payment->brand->logo_path)];
        }

        $response = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $payment->currency,
                        'product_data' => $productData,
                        'unit_amount' => $totalAmount * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'customer_email' => $payment->customer->email,
            'metadata' => [
                'expires_at' => $expirationTime->toDateTimeString(),
                'invoice_number' => $payment->invoice_number,
                'customer_name' => $payment->customer->first_name . ' ' . $payment->customer->last_name,
                'package_description' => $payment->description,
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . "?session_id={CHECKOUT_SESSION_ID}&invoice_number=" . $payment->invoice_number,
            'cancel_url' => route('stripe.cancel'),
        ]);



        $payment = Payment::where('invoice_number', $payment->invoice_number)->first();

        $payment->update(['session_id' => $response->id]);

        return redirect()->away($response->url);
    }

    public function success(Request $request)
    {
        $payment = Payment::with('gateway', 'brand')->where('invoice_number', $request->invoice_number)->first();

        Stripe::setApiKey($payment->gateway->key2);

        if ($payment) {
            $payment->status = 'paid'; // or some other status
            $payment->update();
        }

        $redirect_url = url('/invoice/' . $payment->invoice_number);

        $setting = Setting::first();


        try {
            // Send the email
            Mail::to($payment->customer->email)
                ->cc($setting->primary_email)  // Add CC email here
                ->send(new InvoiceMail($payment));

        } catch (Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            // Optionally, you can add an error flag or message to the response
        }


        // $redirect_url = $payment->brand->redirect_url;

        return redirect()->away($redirect_url);
    }

    public function invoice($invoice)
    {
        $payment = Payment::with('gateway', 'customer', 'brand')->where('invoice_number', $invoice)->first();

        return view('invoice', compact('payment'));

    }

    public function paypal_success(Request $request)
    {


        if (isset($request->status) && $request->status == 'COMPLETED') {
            // Retrieve the unique ID and invoice ID from the request or response
            $invoice_number = $request->invoice_number;

            // Retrieve payment with invoice number stored in session metadata
            $payment = Payment::where('invoice_number', $invoice_number)->first();
            $setting = Setting::first();

            if ($payment) {
                // Update the payment record with PayPal details
                $payment->status = 'paid'; // or some other status
                $payment->save();



                try {
                    // Send payment success email
                    Mail::to($payment->customer->email)
                        ->cc($setting->primary_email)  // Add CC email here
                        ->send(new InvoiceMail($payment));

                } catch (Exception $e) {
                    \Log::error('Email sending failed: ' . $e->getMessage());
                    // Optionally, you can add an error flag or message to the response
                }

            }

            return response()->json(['status' => 'ok']);

        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    // public function generateInvoicePdf($invoice)
    // {
    //     // Fetch payment record along with relations
    //     $payment = Payment::with('gateway', 'customer', 'brand')
    //         ->where('invoice_number', $invoice)
    //         ->first();

    //     if (!$payment) {
    //         return response()->json(['message' => 'Invoice not found'], 404);
    //     }

    //     // Convert payment data into an array for the view
    //     $data = [
    //         'payment' => $payment,
    //     ];

    //     // Load the view and generate PDF
    //     $pdf = Pdf::loadView('invoice', $data);

    //     // Download the generated PDF
    //     return $pdf->download("Invoice_{$invoice}.pdf");
    // }


    public function createInvoiceAndRedirect(Request $request)
    {
        $invoiceData = [
            "detail" => [
                "invoice_number" => "#123",
                "reference" => "deal-ref",
                "invoice_date" => "2018-11-12",
                "currency_code" => "USD",
                "note" => "Thank you for your business.",
                "term" => "No refunds after 30 days.",
                "memo" => "This is a long contract",
                "payment_term" => [
                    "term_type" => "NET_10",
                    "due_date" => "2018-11-22"
                ]
            ],
            "invoicer" => [
                "name" => [
                    "given_name" => "David",
                    "surname" => "Larusso"
                ],
                "address" => [
                    "address_line_1" => "1234 First Street",
                    "address_line_2" => "337673 Hillside Court",
                    "admin_area_2" => "Anytown",
                    "admin_area_1" => "CA",
                    "postal_code" => "98765",
                    "country_code" => "US"
                ],
                "email_address" => "merchant@example.com",
                "phones" => [
                    [
                        "country_code" => "001",
                        "national_number" => "4085551234",
                        "phone_type" => "MOBILE"
                    ]
                ],
                "website" => "www.test.com",
                "tax_id" => "ABcNkWSfb5ICTt73nD3QON1fnnpgNKBy- Jb5SeuGj185MNNw6g",
                "logo_url" => "https://example.com/logo.PNG",
                "additional_notes" => "2-4"
            ],
            "primary_recipients" => [
                [
                    "billing_info" => [
                        "name" => [
                            "given_name" => "Stephanie",
                            "surname" => "Meyers"
                        ],
                        "address" => [
                            "address_line_1" => "1234 Main Street",
                            "admin_area_2" => "Anytown",
                            "admin_area_1" => "CA",
                            "postal_code" => "98765",
                            "country_code" => "US"
                        ],
                        "email_address" => "bill-me@example.com",
                        "phones" => [
                            [
                                "country_code" => "001",
                                "national_number" => "4884551234",
                                "phone_type" => "HOME"
                            ]
                        ],
                        "additional_info_value" => "add-info"
                    ],
                    "shipping_info" => [
                        "name" => [
                            "given_name" => "Stephanie",
                            "surname" => "Meyers"
                        ],
                        "address" => [
                            "address_line_1" => "1234 Main Street",
                            "admin_area_2" => "Anytown",
                            "admin_area_1" => "CA",
                            "postal_code" => "98765",
                            "country_code" => "US"
                        ]
                    ]
                ]
            ],
            "items" => [
                [
                    "name" => "Yoga Mat",
                    "description" => "Elastic mat to practice yoga.",
                    "quantity" => "1",
                    "unit_amount" => [
                        "currency_code" => "USD",
                        "value" => "50.00"
                    ],
                    "tax" => [
                        "name" => "Sales Tax",
                        "percent" => "7.25"
                    ],
                    "discount" => [
                        "percent" => "5"
                    ],
                    "unit_of_measure" => "QUANTITY"
                ],
                [
                    "name" => "Yoga t-shirt",
                    "quantity" => "1",
                    "unit_amount" => [
                        "currency_code" => "USD",
                        "value" => "10.00"
                    ],
                    "tax" => [
                        "name" => "Sales Tax",
                        "percent" => "7.25",
                        "tax_note" => "Reduced tax rate"
                    ],
                    "discount" => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => "5.00"
                        ]
                    ],
                    "unit_of_measure" => "QUANTITY"
                ]
            ],
            "configuration" => [
                "partial_payment" => [
                    "allow_partial_payment" => true,
                    "minimum_amount_due" => [
                        "currency_code" => "USD",
                        "value" => "20.00"
                    ]
                ],
                "allow_tip" => true,
                "tax_calculated_after_discount" => true,
                "tax_inclusive" => false,
                "template_id" => "TEMP-19V05281TU309413B"
            ],
            "amount" => [
                "breakdown" => [
                    "custom" => [
                        "label" => "Packing Charges",
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => "10.00"
                        ]
                    ],
                    "shipping" => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => "10.00"
                        ],
                        "tax" => [
                            "name" => "Sales Tax",
                            "percent" => "7.25"
                        ]
                    ],
                    "discount" => [
                        "invoice_discount" => [
                            "percent" => "5"
                        ]
                    ]
                ]
            ]
        ];


        // Create the invoice
        $invoice = $this->payPalService->createInvoice($invoiceData);

        // Check if the invoice ID is present
        if (!isset($invoice['id'])) {
            return response()->json([
                'error' => 'Invoice ID not found in the response.',
                'response' => $invoice,
            ], 500);
        }

        // Generate the checkout link
        $checkoutLink = $this->payPalService->generateCheckoutLink($invoice['id']);

        // Redirect the user to the PayPal checkout page
        return redirect()->away($checkoutLink);
    }



}

