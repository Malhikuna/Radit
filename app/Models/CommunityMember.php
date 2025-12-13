<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CommunityMember extends Pivot
{

    protected $table = 'community_members';

    public $timestamps = false;

    protected $fillable = [
        'community_id',
        'user_id',
        'role',
        'joined_at'
    ];
}
