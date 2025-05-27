<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Luigel\Paymongo\Facades\Paymongo;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $payment = Paymongo::payment()
            ->create([
                'amount' => $request->amount * 100,
                'currency' => 'PHP',
                'description' => 'Payment for ' . $request->service,
                'statement_descriptor' => 'PAWPAL SERVICES',
                'source' => [
                    'id' => $request->source_id,
                    'type' => 'source'
                ]
            ]);

        return response()->json([
            'success' => true,
            'payment' => $payment
        ]);
    }

    public function createSource(Request $request)
    {
        $source = Paymongo::source()->create([
            'type' => 'gcash',
            'amount' => $request->amount * 100,
            'currency' => 'PHP',
            'redirect' => [
                'success' => route('payment.success'),
                'failed' => route('payment.failed')
            ]
        ]);

        return response()->json([
            'success' => true,
            'source' => $source
        ]);
    }

    public function success()
    {
        return redirect()->route('home')->with('success', 'Payment successful!');
    }

    public function failed()
    {
        return redirect()->route('home')->with('error', 'Payment failed. Please try again.');
    }
}