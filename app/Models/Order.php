<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'vnpay_order_id',
        'amount',
        'order_info',
        'transaction_no',
        'bank_code',
        'payment_time',
        'status'
    ];

    protected $casts = [
        'payment_time' => 'datetime'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
