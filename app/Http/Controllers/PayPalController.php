<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;

class PaypalController extends Controller
{
    public function paypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ],
                    "items" => [
                        [
                            "name" => $request->product_name,
                            "quantity" => $request->quantity,
                            "unit_amount" => [
                                "currency_code" => "USD",
                                "value" => $request->price
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            $payment = new Payment;
            $payment->payment_id = $response['id'];
            $payment->product_name = $request->product_name;
            $payment->quantity = $request->quantity;
            $payment->amount = $request->price;
            $payment->currency = "USD";
            $payment->payment_method = "PayPal";
            $payment->save();

            // Lưu token vào session
            session()->put('paypal_token', $response['id']);

            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return response()->json([
                        'success' => true,
                        'approval_url' => $link['href']
                    ]);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create PayPal order.'
            ]);
        }
    }
}
