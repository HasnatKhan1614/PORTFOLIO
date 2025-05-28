<?php
      
namespace App\Http\Controllers;
       
use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
       
class PaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(): View
    {
        return view('payment');
    }
      
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): JsonResponse
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
            Stripe\Charge::create([
                "amount" => $request->subtotal * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);
    
            return response()->json(['success' => 'Payment successful!']);
        } catch (Exception $e) {
            // Handle exceptions and return error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}