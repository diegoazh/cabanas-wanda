<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersDetail extends Model
{
    use SoftDeletes;

    protected $table = 'orders_detail';
    protected $dates = ['deleted_at'];
    protected $fillable = ['order_id', 'food_id', 'delivery', 'quantity', 'state'];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    public function food()
    {
        return $this->belongsTo('App\Food', 'food_id', 'id');
    }
}
