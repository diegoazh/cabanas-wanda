<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "orders";
    protected $dates = ['deleted_at'];
    protected $fillable = ['order_date', 'rental_id', 'state', 'paid'];

    public function rental()
    {
        $this->belongsTo('App\Rental', 'rental_id', 'id');
    }

    public function detallePedidos()
    {
        $this->hasMany('App\OrdersDetail', 'order_id', 'id');
    }
}
