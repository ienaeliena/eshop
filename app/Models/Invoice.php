<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\OrderItem;


class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');

    }

}
