<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_premium',
        'premium_expired_at',
        'profile_photo_path',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'premium_expired_at' => 'datetime',
        'banned_at' => 'datetime',
    ];


    /* ================= PREMIUM ================= */

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isPremiumActive(): bool
    {
        return $this->is_premium &&
            $this->premium_expired_at &&
            $this->premium_expired_at->isFuture();
    }

    /* ================= Banned ================= */

    public function ban(string $duration): void
    {
        $this->banned_at = match ($duration) {
            '3_days'   => now()->addDays(3),
            '7_days'   => now()->addDays(7),
            '30_days'  => now()->addDays(30),
            '3_months' => now()->addMonths(3),
            '1_year'   => now()->addYear(),
            default    => null,
        };

        $this->save();
    }

    public function isBanned(): bool
    {
        return $this->banned_at !== null && $this->banned_at->isFuture();
    }

    public function unban(): void
    {
        $this->banned_at = null;
        $this->save();
    }
}
