<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'community_id',
        'title',
        'content',
        'status',
        'views',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper / Logic
    |--------------------------------------------------------------------------
    */

    public function increaseViews(): void
    {
        $this->increment('views');
    }
}
