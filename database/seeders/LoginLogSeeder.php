<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoginLog;

class LoginLogSeeder extends Seeder
{
    public function run(): void
    {
        LoginLog::factory(10)->create();
    }
}
