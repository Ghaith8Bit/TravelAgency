<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Reservation;
use App\Models\Trip;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function checkout(Reservation $reservation)
    {
        $secretKey = env('STRIPE_SECRET');
        $signature = hash_hmac('sha256', $reservation->id, $secretKey);

        $product = null;
        if ($reservation->reservationable_type === 'App\\Models\\Trip') {
            $product = Trip::find($reservation->reservationable_id);
        } elseif ($reservation->reservationable_type === 'App\\Models\\Package') {
            $product = Package::find($reservation->reservationable_id);
        }
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $price = ((float) $product->price / 14000) * 100;

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product instanceof Package ? $product->trip->name : $product->name,
                    ],
                    'unit_amount' => (int) $price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['reservation' => $reservation, 'signature' => $signature]),
            'cancel_url' => route('payment.fail'),
        ]);

        return redirect($checkout_session->url);
    }

    public function success(Reservation $reservation, $receivedSignature)
    {
        if (auth()->id() !== $reservation->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $secretKey = env('STRIPE_SECRET');
        $expectedSignature = hash_hmac('sha256', $reservation->id, $secretKey);

        if ($receivedSignature !== $expectedSignature) {
            abort(403, 'Unauthorized action.');
        }

        $reservation->update([
            'is_paid' => 1,
        ]);

        return redirect()->route('dashboard.home')->with('toastify', [
            'text' => 'Trip payment has been done successfully.',
            'className' => 'success',
        ]);
    }
    public function fail()
    {
        return redirect()->route('dashboard.home')->with('toastify', [
            'text' => 'There\'s an error in the payment please try again',
            'className' => 'error',
        ]);
    }
}
