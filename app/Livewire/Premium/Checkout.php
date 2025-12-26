<?php

namespace App\Livewire\Premium;

use Livewire\Component;
use Midtrans\Snap;
use Midtrans\Config;
use Livewire\Attributes\Layout;

class Checkout extends Component
{
    public function pay()
    {
        // Setup Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Buat Params Transaksi
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 10000,
            ],
        ];

        // Get Snap Token
        try {
            $snapToken = Snap::getSnapToken($params);
            
            $this->dispatch('start-payment', token: $snapToken);
            
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    #[Layout('layouts.app', ['hideNavbar' => true, 'hideSidebar' => true])]
    public function render()
    {
        return view('livewire.premium.checkout');
    }
}