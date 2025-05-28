<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Renewal;
use App\Models\BankInformation;

class UserController extends Controller
{
    public function orderIndex(Request $request)
    {
        if ($request->ajax()) {
            // Fetch orders with related order details and user
            $orders = Order::where('user_id',Auth::user()->id)->latest()->get();

            return datatables()->of($orders)
                ->addColumn('action', function ($row) {
                    $invoiceUrl = route('user.orders.invoice', ['id' => $row->id, 'type' => 'initial']);
                    // Define the route for generating the invoice


                    // Invoice Button
                    $btn = ' <a href="' . $invoiceUrl . '" class="invoice btn btn-success btn-sm">';
                    $btn .= '<i class="fas fa-file"></i>'; // Invoice icon
                    $btn .= '</a>';

                    return $btn;
                })

                ->addColumn('user_name', function ($row) {
                    // Add user name column
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->addColumn('products', function ($row) {
                    // Add a column to display the products in the order
                    return $row->orderDetails->pluck('product.name')->implode(', ');
                })
                ->addIndexColumn() // Adds DT_RowIndex

                ->rawColumns(['action']) // Ensure the HTML for action buttons is not escaped
                ->make(true);
        }

        return view('user.orders.index');
    }

    public function invoice($id, $type)
    {
        $order = Order::with('orderDetails.product', 'user')->findOrFail($id);
        $bankInfos = BankInformation::whereIn('id', $order->bank_information_ids ?? [])->get();
        if ($type === 'initial') {

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
                'bank_infos' => $bankInfos->map(function ($bank) {
                    return [
                        'bank_name' => $bank->bank_name,
                        'account_name' => $bank->account_name,
                        'account_number' => $bank->account_number,
                        'swift_code' => $bank->swift_code,
                        'iban' => $bank->iban,
                    ];
                }),
                'notes' => $renewal->notes,
            ];
        } else {
            abort(404, 'Invalid Invoice Type');
        }

        return view('user.invoice.invoice', compact('data', 'type'));
    }

    public function invoice_index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch orders
            $orders = Order::where('user_id', Auth::user()->id)->with('user', 'orderDetails.product')->get();

            // Fetch renewals
            $renewals = Renewal::whereHas('orderDetail.order.user', function ($query) {
                $query->where('id', Auth::user()->id);
            })->with('orderDetail.product', 'orderDetail.order.user')->get();


            // Map orders to unified structure
            $ordersData = $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'invoice_number' => $order->invoice_number,
                    'user_name' => $order->user ? $order->user->name : 'N/A',
                    'products' => $order->orderDetails->pluck('product.name')->implode(', '),
                    'amount' => $order->currency_symbol . $order->orderDetails->sum('price'),
                    'type' => 'initial', // Mark as initial order
                    'date' => $order->created_at->format('Y-m-d'),
                    'payment_status' => $order->payment_status,
                ];
            });

            // Map renewals to unified structure
            $renewalsData = $renewals->map(function ($renewal) {
                $order = $renewal->orderDetail->order; // Get the related order
                return [
                    'id' => $renewal->id,
                    'invoice_number' => $renewal->invoice_number,
                    'user_name' => $order->user ? $order->user->name : 'N/A',
                    'products' => $renewal->orderDetail->product ? $renewal->orderDetail->product->name : 'N/A',
                    'amount' => $order->currency_symbol . $renewal->renewal_price,
                    'type' => 'renewal', // Mark as renewal
                    'date' => $renewal->created_at->format('Y-m-d'),
                    'payment_status' => $renewal->payment_status,

                ];
            });

            // Combine orders and renewals data
            $allInvoices = $ordersData->merge($renewalsData);

            // Return for DataTable
            return datatables()->of($allInvoices)
                ->addColumn('action', function ($row) {

                    $invoiceUrl = route('user.orders.invoice', ['id' => $row['id'], 'type' => $row['type']]);

                    $btn = '<a href="' . $invoiceUrl . '" class="invoice btn btn-success btn-sm">';
                    $btn .= '<i class="fas fa-file"></i>'; // Invoice icon
                    $btn .= '</a>';

    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn() // Adds DT_RowIndex

                ->make(true);
        }

        return view('user.invoice.invoices');
    }
}
