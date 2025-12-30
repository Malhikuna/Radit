<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ExpirePremium extends Command
{
    protected $signature = 'app:expire-premium';
    protected $description = 'Expire premium users whose subscription has ended';

    public function handle()
    {
        $expiredCount = User::where('is_premium', true)
            ->where('premium_expired_at', '<', now())
            ->update([
                'is_premium' => false,
                'premium_expired_at' => null,
            ]);

        Log::info("ExpirePremium: $expiredCount user expired");
        $this->info("ExpirePremium: $expiredCount user expired");
    }
}
