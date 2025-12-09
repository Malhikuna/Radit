<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'content',
    ];

    /**
     * Relasi ke Post (comment milik 1 post)
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Relasi ke User (comment dibuat oleh 1 user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke parent comment (komentar balasan)
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Relasi ke child comments (komentar memiliki banyak balasan)
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
