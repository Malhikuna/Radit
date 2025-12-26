<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExpirePremium extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-premium';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
        public function handle()
        {
            User::where('is_premium', true)
                ->where('premium_expired_at', '<', now())
                ->update(['is_premium' => false]);
        }

}
