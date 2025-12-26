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
    // user memiliki banyak post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    // user memiliki banyak komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // user memiliki banyak vote
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    // komunitas yang diikuti user
    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_members');
    }
    // Conversation yang dikirim user
    public function sentConversations()
    {
        return $this->hasMany(Conversation::class, 'sender_id');
    }
    // Conversation yang diterima user
    public function receivedConversations()
    {
        return $this->hasMany(Conversation::class, 'receiver_id');
    }
    // Pesan yang dikirim user
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Helper untuk cek apakah user premium
    public function isPremium(): bool
    {
        return $this->is_premium && $this->premium_expired_at && $this->premium_expired_at->isFuture();
    }
}
