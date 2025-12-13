<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{

    /** @use HasFactory<\Database\Factories\CommunityFactory> */
    use HasFactory;

    protected $table = 'communities';

    protected $fillable = [
        'name',
        'description',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function members()
    {
        //return $this->belongsToMany(user::class, 'community_members', 'community_id', 'user_id')-> withPivots('role', 'joined_at');
        return $this->belongsToMany(User::class, 'community_members', 'community_id', 'user_id')->withPivot('role', 'joined_at');
    }
}
