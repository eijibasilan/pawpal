<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayMongo\PayMongo;

class PaymentController extends Controller
{
    protected $paymongo;

    public function __construct()
    {
        $this->paymongo = new PayMongo(config('services.paymongo.secret_key'));
    }

    public function createPayment(Request $request)
    {
        try {
            $payment = $this->paymongo->payments()->create([
                'amount' => $request->amount * 100,
                'currency' => 'PHP',
                'description' => 'Payment for ' . $request->service,
                'statement_descriptor' => 'PAWPAL',
                'source' => [
                    'id' => $request->source_id,
                    'type' => 'source'
                ]
            ]);

            return response()->json(['success' => true, 'payment' => $payment]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
