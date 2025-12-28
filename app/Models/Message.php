<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'conversation_id', 
        'user_id', 
        'body', 
        'is_read',
        'deleted_by_sender',
        'deleted_by_receiver'
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    /* public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    } */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}