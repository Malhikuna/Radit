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
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'premium_expired_at' => 'datetime',
        'banned_at' => 'datetime',
    ];

    // Relasi
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_members')
                    ->withPivot('role', 'joined_at');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
