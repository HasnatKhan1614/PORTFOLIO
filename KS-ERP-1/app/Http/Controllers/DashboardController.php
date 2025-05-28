<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    Sale,
    Purchase,
    ExpensePayable,
    SaleOrderItem
};

class DashboardController extends Controller
{
    public function index()
    {
        $total = 0;
        $sale = Sale::all();
        $sale = count($sale);
        $purchase = Purchase::all();
        $purchase = count($purchase);
        $expense = ExpensePayable::all();
        $expense = count($expense);
        $sales = SaleOrderItem::all();
        foreach($sales as $item){
            $total += $item->price * $item->quantity;
        }
        return Inertia::render("Home",compact('sale','purchase','expense','total'));

    }
}
