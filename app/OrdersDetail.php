<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersDetail extends Model
{
    use SoftDeletes;

    protected $table = 'orders_detail';
    protected $dates = ['deleted_at'];
    protected $fillable = ['order_id', 'food_id', 'return_date', 'quantity'];

    public function pedido()
    {
        $this->belongsTo('App\Order', 'pedido_id', 'id');
    }

    public function comida()
    {
        $this->hasOne('App\Food', 'comida_id', 'id');
    }
}
