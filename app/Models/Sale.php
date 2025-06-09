<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'order_number',
        'order_type',
        'discount_code',
        'discount',
        'total_amount',
        'payment_status',
        'payment_method',
        'amount_paid',
        'user_id',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    static public function getOrders()
    {
        return self::select('sales.*')
        ->where('order_type', 1)
        ->orderBy('id','desc')
        ->get();
    }
}
