<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'profile_image',
        'banner_image',
    ];

    // Relasi
    public function members()
    {
        return $this->belongsToMany(User::class, 'community_members')
                    ->withPivot('role', 'joined_at');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
