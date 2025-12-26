<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Midtrans\Snap;
use Midtrans\Config;


public function pay()
{
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => 'PREMIUM-' . uniqid(),
            'gross_amount' => 25000,
        ],
        'customer_details' => [
            'first_name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ],
        'custom_field1' => auth()->id(), // PENTING
    ];

    return response()->json([
        'snap_token' => Snap::getSnapToken($params),
    ]);
}

public function callback(Request $request)
{
    $signature = hash(
        'sha512',
        $request->order_id .
        $request->status_code .
        $request->gross_amount .
        config('midtrans.server_key')
    );

    if ($signature !== $request->signature_key) {
        abort(403);
    }

    if (in_array($request->transaction_status, ['capture', 'settlement'])) {
        $user = User::findOrFail($request->custom_field1);

        $user->update([
            'is_premium' => true,
            'premium_expired_at' => now()->addDays(30),
        ]);
    }

    return response()->json(['status' => 'ok']);
}

