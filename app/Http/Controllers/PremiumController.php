<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PremiumController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        Config::$isProduction = config('midtrans.is_production', false);
    }

    /**
     * CREATE TRANSACTION
     */
    public function buys(Request $request)
    {
        $duration = $request->input('duration'); // monthly | yearly
        $price = $duration === 'monthly' ? 79000 : 799000;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_id' => 'ORDER-' . strtoupper(Str::random(8)),
            'amount' => $price,
            'status' => 'pending',
        ]);

        $transaction = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => $price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => 'premium-' . $duration,
                    'price' => $price,
                    'quantity' => 1,
                    'name' => 'Radit+ ' . ucfirst($duration),
                ]
            ],
            'enabled_payments' => ['credit_card', 'gopay', 'bank_transfer'],
            'finish_redirect_url' => route('checkout.success'),
            'unfinish_redirect_url' => route('checkout.unfinish'),
            'error_redirect_url' => route('checkout.error'),
        ];

        try {
            $snap = Snap::createTransaction($transaction);
            return redirect($snap->redirect_url);
        } catch (\Exception $e) {
            Log::error('MIDTRANS SNAP ERROR', ['error' => $e->getMessage()]);
            return back()->with('error', 'Payment gateway error');
        }
    }

    /**
     * MIDTRANS CALLBACK (PALING PENTING)
     */
    public function callback(Request $request)
    {
        Log::info('MIDTRANS CALLBACK MASUK', $request->all());

        // ===============================
        // VALIDASI SIGNATURE
        // ===============================
        $serverKey = config('midtrans.server_key');

        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature !== $request->signature_key) {
            Log::warning('SIGNATURE INVALID');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // ===============================
        // AMBIL ORDER
        // ===============================
        $order = Order::where('order_id', $request->order_id)->first();

        if (!$order) {
            Log::warning('ORDER NOT FOUND', ['order_id' => $request->order_id]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // ===============================
        // CEGAH DOUBLE CALLBACK
        // ===============================
        if ($order->status === 'success') {
            Log::info('ORDER SUDAH SUCCESS, CALLBACK DIABAIKAN');
            return response()->json(['message' => 'Already processed']);
        }

        // ===============================
        // SIMPAN STATUS TRANSAKSI
        // ===============================
        $order->update([
            'transaction_status' => $request->transaction_status,
            'payment_type' => $request->payment_type,
        ]);

        // ===============================
        // LOGIKA STATUS MIDTRANS
        // ===============================
        if (
            $request->transaction_status === 'settlement' ||
            ($request->transaction_status === 'capture' && $request->fraud_status === 'accept')
        ) {
            $this->activatePremium($order);
        }

        if (in_array($request->transaction_status, ['deny', 'expire', 'cancel'])) {
            $order->update(['status' => 'failed']);
        }

        Log::info('ORDER UPDATED', [
            'order_id' => $order->order_id,
            'status' => $order->status,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * AKTIFKAN PREMIUM
     */
    private function activatePremium(Order $order): void
    {
        if ($order->status === 'success') {
            return;
        }

        $user = $order->user;

        // default monthly
        $expiredAt = now()->addMonth();

        // yearly jika harga besar
        if ($order->amount >= 500000) {
            $expiredAt = now()->addYear();
        }

        $user->update([
            'is_premium' => true,
            'premium_expired_at' => $expiredAt,
        ]);

        $order->update([
            'status' => 'success',
            'paid_at' => now(),
        ]);
    }

    /**
     * REDIRECT PAGE
     */
    public function success()
    {
        return view('checkout.success');
    }

    public function unfinish()
    {
        return view('checkout.unfinish');
    }

    public function error()
    {
        return view('checkout.error');
    }
}
