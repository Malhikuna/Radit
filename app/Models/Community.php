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
        'profile_image', // gambar profil komunitas
        'banner_image',  // banner komunitas
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, 'community_members');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
