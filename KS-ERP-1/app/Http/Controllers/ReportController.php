<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use \Carbon\Carbon;
use App\Models\{
    VendorPayable,
    Vendor,
    Purchase,
    Inventory,
    Product,
    SaleOrderItem,
    PurchaseOrderItem,
    ExpensePayableHead,
    ExpensePayable,
    Staff,
    StaffPayroll
};

class ReportController extends Controller
{
    public function vendorLedger()
    {
        $vendors = Vendor::all();
        $data = collect();

        
        foreach($vendors as $vendor){
            $balance = 0; 

            $balance += $vendor->opening_balance;
        
            $purchases = Purchase::where('vendor_id', $vendor->id)->get(); 
            $payable_amount = VendorPayable::where('vendor_id', $vendor->id)->sum('amount'); 
        
            foreach ($purchases as $purchase) {
                foreach ($purchase->purchaseOrderItems as $item) {
                    $balance += $item->price * $item->quantity; // Accumulate the balance correctly
                }
            }
    
            $balance = $balance - $payable_amount;

            $assocArray = [
                "id" => $vendor->id,
                "balance" => $balance,
                "name" => $vendor->name,
            ];
            $data->push($assocArray);

        }
    
        return Inertia::render("Report/VendorLedger", compact('data'));

    }

    public function vendorLedgerDetail($vendor_id)
    {
        $vendor = Vendor::find($vendor_id);
        $data = collect();

        $balance = 0; 

        $balance += $vendor->opening_balance;
    
        $purchases = Purchase::where('vendor_id', $vendor->id)->get(); 
        
        foreach ($purchases as $purchase) {
            foreach ($purchase->purchaseOrderItems as $item) {
                $balance += $item->price * $item->quantity; 
            }
        }

        $vendor_payables = VendorPayable::where('vendor_id', $vendor->id)->get(); 

        foreach($vendor_payables as $item){

            $balance = $balance - $item->amount;

            $assocArray = [
                "date" => $item->date,
                "amount" => $item->amount,
                "payment_type" => $item->payment_type,
                "remarks" => $item->remarks,
                "balance" => $balance,
            ];
            $data->push($assocArray);
        }
        


        return Inertia::render("Report/VendorLedgerDetail", compact('data'));

    }

    public function InventoryReport()
    {
        $products = Product::get();
        
        $inventories = collect();
        $stock_out = 0;
        $stock_in = 0;
        $stock = 0;
        $inventory = 0;
    
        foreach($products as $item){
            $stock_in = PurchaseOrderItem::where('product_id',$item->id)->sum('quantity');
            $stock_out = SaleOrderItem::where('product_id',$item->id)->sum('quantity');
            $stock = $stock_in - $stock_out;

            $stock += $item->quantity - 0;
            $stock_in += $item->quantity - 0;

            $assocArray  = [
                'id' => $item->id,
                'name' => $item->name,
                'barcode' => $item->barcode,
                'stock_in' => $stock_in,
                'stock_out' => $stock_out,
                'stock' => $stock,
            ];
            $inventories->push($assocArray);
        }
        return Inertia::render("Report/Inventory",compact('inventories'));
    }

    public function InventoryReportDetail($product_id)
    {
        // Get the product and related purchase and sale items
        $product = Product::findOrFail($product_id);
        $purchaseItems = PurchaseOrderItem::where('product_id', $product_id)->get();
        $saleItems = SaleOrderItem::where('product_id', $product_id)->get();
    
        // Initialize variables
        $inventories = [];
        $stock = $product->quantity;
    
        // Calculate stock changes and build the inventory array
        foreach ($purchaseItems as $purchaseItem) {
            $stock_in = $purchaseItem->quantity;
            $stock = $stock_in;
            $inventories[] = [
                'date' => $purchaseItem->purchase->date,
                'stock_in' => $stock_in,
                'stock_out' => 0,
                'stock' => $stock,
            ];
        }
    
        foreach ($saleItems as $saleItem) {
            $stock_out = $saleItem->quantity;
            $stock -= $stock_out;
            $inventories[] = [
                'date' => $saleItem->sale->date,
                'stock_in' => 0,
                'stock_out' => $stock_out,
                'stock' => $stock,
            ];
        }
    
        // Calculate the total stock in and stock out
        $total_stock_in = array_sum(array_column($inventories, 'stock_in'));
        $total_stock_out = array_sum(array_column($inventories, 'stock_out'));
    
        // Add a total row to the inventory array
        $inventories[] = [
            'date' => '',
            'stock_in' => 'Total ' . $total_stock_in,
            'stock_out' => 'Total ' . $total_stock_out,
            'stock' => 'Total ' . ($total_stock_in - $total_stock_out),
        ];
    
        // Sort the inventory array by date in descending order
        usort($inventories, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
    
        return Inertia::render("Report/InventoryDetail", compact('inventories'));
    }

    public function PurchaseReport()
    {
        // Get vendors along with their purchases and purchase items
        $vendors = Vendor::with('purchase.purchaseOrderItems')->get();
        
        $reportData = [];
    
        foreach ($vendors as $vendor) {
            $totalPurchase = 0;
    
            foreach ($vendor->purchase as $purchase) {
                foreach ($purchase->purchaseOrderItems as $purchaseItem) {
                    $totalPurchase += $purchaseItem->price * $purchaseItem->quantity;
                }
            }
    
            // Add vendor name and total_purchase to the report data
            $reportData[] = [
                'id' => $vendor->id,
                'vendor' => $vendor->name,
                'total_purchase' => $totalPurchase,
            ];
        }
    
        // You can also sort the reportData by total_purchase in descending order if needed.
        usort($reportData, function ($a, $b) {
            return $b['total_purchase'] - $a['total_purchase'];
        });
    
        return Inertia::render("Report/Purchase", compact('reportData'));
    }
    

    public function PurchaseReportDetail($vendor_id)
    {
        // Get purchases with their purchase order items for the specified vendor
        $purchases = Purchase::with('purchaseOrderItems.product')
            ->where('vendor_id', $vendor_id)
            ->get();
        
        $reportData = [];
    
        foreach ($purchases as $purchase) {
            foreach ($purchase->purchaseOrderItems as $item) {
                $reportData[] = [
                    'vendor' => $purchase->vendor->name,
                    'date' => $purchase->date,
                    'product' => $item->product->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'total' => $item->price * $item->quantity,
                ];
            }
        }
    
        return Inertia::render("Report/PurchaseDetail", compact('reportData'));
    }

    public function ExpenseReport()
    {
        // Get vendors along with their purchases and purchase items
        $expense_payable_heads = ExpensePayableHead::with('expense_payable')->get();
        
        $reportData = [];
    
        foreach ($expense_payable_heads as $expense_payable_head) {
            $total_amount = 0;
    
            foreach ($expense_payable_head->expense_payable as $expense_payable) {
                    $total_amount += $expense_payable->amount;
            }
    
            // Add vendor name and total_purchase to the report data
            $reportData[] = [
                'id' => $expense_payable_head->id,
                'title' => $expense_payable_head->name,
                'total_amount' => $total_amount,
            ];
        }
            
        return Inertia::render("Report/Expense", compact('reportData'));
    }

    public function ExpenseReportDetail($expense_payable_head_id)
    {
        // Get purchases with their purchase order items for the specified vendor
        $expense_payables = ExpensePayable::with('expense_payable_head')
            ->where('expense_payable_head_id', $expense_payable_head_id)
            ->get();

        
        $reportData = [];
    
            foreach ($expense_payables as $expense_payables) {
                $reportData[] = [
                    'name' => $expense_payables->expense_payable_head->name,
                    'date' => $expense_payables->date,
                    'amount' => $expense_payables->amount,
                    'remarks' => $expense_payables->remarks,
                ];
            }
    
        return Inertia::render("Report/ExpenseDetail", compact('reportData'));
    }

    public function StaffPayrollReport()
    {
        // Get vendors along with their purchases and purchase items
        $staffs = Staff::get();
        
        $reportData = [];
    
        foreach ($staffs as $staff) {
    
            // Add vendor name and total_purchase to the report data
            $reportData[] = [
                'id' => $staff->id,
                'name' => $staff->name.' <'.$staff->identity_number.'>',
            ];
        }
            
        return Inertia::render("Report/StaffPayroll", compact('reportData'));
    }

    public function StaffPayrollReportDetail($staff_id)
    {
        // Get purchases with their purchase order items for the specified vendor
        $staff_payrolls = StaffPayroll::with('staff')
            ->where('staff_id', $staff_id)
            ->get();

        
        $reportData = [];
    
            foreach ($staff_payrolls as $staff_payroll) {
                $reportData[] = [
                    'name' => $staff_payroll->staff->name,
                    'month' => $staff_payroll->month,
                    'year' => $staff_payroll->year,
                ];
            }
    
        return Inertia::render("Report/StaffPayrollDetail", compact('reportData'));
    }

    public function SaleReport()
    {
            $products = Product::all();

            $sale_items = SaleOrderItem::with('product')
            ->with('sale')
            ->get();
        
        $reportData = [];
    
        foreach ($sale_items as $item) {
            $discountAmount = $item->sale->discount_amount;
            $discountPercent = $item->sale->discount_percent / 100; // Convert percent to a decimal
    
            // Calculate the total price for the item without discounts
            $totalWithoutDiscount = $item->price * $item->quantity;
    
            // Apply the discount to the total without discounts
            $discountedTotal = $totalWithoutDiscount - $discountAmount;
            $discountedTotal = $discountedTotal - ($discountedTotal * $discountPercent);
    
            $reportData[] = [
                'date' => $item->sale->date,
                'product' => $item->product->name,
                'discount_amount' => $discountAmount,
                'discount_percent' => $discountPercent * 100, // Convert back to percent
                'payment_type' => $item->sale->payment_type,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $discountedTotal,
            ];

        }
    
        return Inertia::render("Report/Sale",compact('reportData','products'));
    }


    public function SaleReportDetail()
    {

        $from = request()->input('from');
        $to = request()->input('to');
        $product_id = request()->input('product_id');

        if(request()->input('from') || request()->input('to') || request()->input('product_id')){

            $sale_items = SaleOrderItem::with('product')
            ->with('sale')
            ->orWhere('product_id', $product_id)
            ->whereHas('sale', function ($query) use ($from, $to) {
                $query->orWhere('date', '=>', $from)
                    ->orWhere('date', '=<', $to);
            })
            ->get();
        }else{
            $sale_items = SaleOrderItem::with('product')
            ->with('sale')
            ->get();
        }
        
        $reportData = [];
    
        foreach ($sale_items as $item) {
            $discountAmount = $item->sale->discount_amount;
            $discountPercent = $item->sale->discount_percent / 100; // Convert percent to a decimal
    
            // Calculate the total price for the item without discounts
            $totalWithoutDiscount = $item->price * $item->quantity;
    
            // Apply the discount to the total without discounts
            $discountedTotal = $totalWithoutDiscount - $discountAmount;
            $discountedTotal = $discountedTotal - ($discountedTotal * $discountPercent);
    
            $reportData[] = [
                'date' => $item->sale->date,
                'product' => $item->product->name,
                'discount_amount' => $discountAmount,
                'discount_percent' => $discountPercent * 100, // Convert back to percent
                'payment_type' => $item->sale->payment_type,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $discountedTotal,
            ];

        }
    
        return response()->json($reportData);
    }
    
    

    
    
    
}
