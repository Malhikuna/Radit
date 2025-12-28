<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Order;
use Illuminate\Support\Str;

class PremiumController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        Config::$isProduction = false; // Sandbox
    }

    public function buys(Request $request)
    {
        $duration = $request->input('duration'); // monthly/yearly
        $price = $duration === 'monthly' ? 79000 : 799000;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_id' => Str::upper(Str::random(10)),
            'duration' => $duration,
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
                    'id' => 'premium-'.$duration,
                    'price' => $price,
                    'quantity' => 1,
                    'name' => 'Radit+ '.ucfirst($duration)
                ]
            ],
            'enabled_payments' => ['credit_card','gopay','bank_transfer'],
        ];

        try {
            $url = Snap::createTransaction($transaction)->redirect_url;
            return redirect($url);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $notification = new Notification();

        $order = Order::where('order_id', $notification->order_id)->first();
        if (!$order) return response('Order not found', 404);

        switch($notification->transaction_status){
            case 'capture':
            case 'settlement':
                $order->update(['status'=>'success']);
                $user = $order->user;
                $user->update([
                    'is_premium' => true,
                    'premium_expired_at' => $order->duration === 'monthly' ? now()->addMonth() : now()->addYear(),
                ]);
                break;

            case 'pending':
                $order->update(['status'=>'pending']);
                break;

            default:
                $order->update(['status'=>'failed']);
        }

        return response()->json(['success'=>true]);
    }

    public function success() { return view('checkout.success'); }
    public function unfinish() { return view('checkout.unfinish'); }
    public function error() { return view('checkout.error'); }
}
