<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'file_path',
        'created_at'
    ];

    //protected $fillable = ['post_id', 'file_path'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
