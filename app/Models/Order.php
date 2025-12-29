<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'amount', 'status', 
        'transaction_status', 'payment_type', 'paid_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
