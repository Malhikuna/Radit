<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

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
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'premium_expired_at' => 'datetime',
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

}