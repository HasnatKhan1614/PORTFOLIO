<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripePaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * Create a Stripe Checkout Session
     *
     * @param array $data
     * @param string $type
     * @return Session
     */
    public function createCheckoutSession(array $data, string $type)
    {
        try {
            $lineItems = array_map(function ($item) {
                return [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['product_name'],
                        ],
                        'unit_amount' => $item['price'] * 100, // Stripe uses cents
                    ],
                    'quantity' => $item['quantity'],
                ];
            }, $data['items']);

            // Create Stripe Checkout session
            return Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'customer_email' => $data['customer']['email'],
                'mode' => 'payment',
                'success_url' => route('stripe.success') . "?session_id={CHECKOUT_SESSION_ID}&invoice_no={$data['invoice_number']}",
                'cancel_url' => route('stripe.cancel') . "?invoice_no={$data['invoice_number']}",
            ]);
        } catch (\Exception $e) {
            throw new \RuntimeException('Stripe Checkout Session could not be created: ' . $e->getMessage());
        }
    }
}
