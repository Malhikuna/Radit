<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'community_id',
        'title',
        'content',
        'status',
        'views'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
        return $this->hasMany(Vote::class, 'post_id');
    }

    // HELPER
    public function increaseViews()
    {
        $this->views++;
        $this->save();
    }

    public function score()
    {
        return $this->votes()->sum('value');
    }
}
