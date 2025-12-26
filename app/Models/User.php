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

    protected $hidden = ['password'];

    protected $casts = [
        'is_premium' => 'boolean',
        'premium_expired_at' => 'datetime',
    ];

    // RELATIONS
    public function posts() { return $this->hasMany(Post::class); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function votes() { return $this->hasMany(Vote::class); }
    public function communities() { return $this->belongsToMany(Community::class, 'community_members'); }

    // CEK PREMIUM
    public function hasPremium(): bool
    {
        if (!$this->is_premium || !$this->premium_expired_at) {
            return false;
        }

        if ($this->premium_expired_at->isPast()) {
            $this->updateQuietly(['is_premium' => false]);
            return false;
        }

        return true;
    }
}
