<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\User;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');

        // VALIDASI SIGNATURE
        $signatureKey = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            config('midtrans.server_key')
        );

        if ($signatureKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // CARI ORDER
        $order = Order::where('order_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // ANTI DOUBLE CALLBACK
        if ($order->status === 'paid') {
            return response()->json(['message' => 'Already processed']);
        }

        // PEMBAYARAN SAH
        if (in_array($request->transaction_status, ['settlement', 'capture'])) {

            // Update status order
            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            // Jadikan user premium / extend premium
            $user = User::find($order->user_id);

            if ($user) {
                // Jika premium_expired_at sudah ada dan masih aktif, extend
                $current = $user->premium_expired_at && $user->premium_expired_at->isFuture()
                    ? Carbon::parse($user->premium_expired_at)
                    : Carbon::now();

                $user->update([
                    'is_premium' => true,
                    'premium_expired_at' => $current->addDays(30),
                ]);

                // Bersihkan cache
                $user->refreshPremiumCache();
            }
        }

        return response()->json(['status' => 'ok']);
    }
}