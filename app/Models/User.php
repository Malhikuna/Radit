<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

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

    public function hasPremium(): bool
    {
        return cache()->remember(
            "user:{$this->id}:premium",
            now()->addMinutes(5),
            function () {
                if (!$this->is_premium || !$this->premium_expired_at) {
                    return false;
                }

                if ($this->premium_expired_at->isPast()) {
                    $this->updateQuietly(['is_premium' => false]);
                    $this->refreshPremiumCache();
                    return false;
                }

                return true;
            }
        );
    }

    public function refreshPremiumCache(): void
    {
        cache()->forget("user:{$this->id}:premium");
    }

    public function getIsPremiumActiveAttribute(): bool
    {
        return $this->hasPremium();
    }
}
