<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role',
        'is_premium',          // tambah kolom premium
        'premium_expired_at',   // tambah kolom tanggal expired
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

    // Helper untuk cek apakah user premium
    public function isPremium(): bool
    {
        return $this->is_premium && $this->premium_expired_at && $this->premium_expired_at->isFuture();
    }
}
