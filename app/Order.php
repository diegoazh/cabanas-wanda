<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "orders";
    protected $dates = ['deleted_at'];
    protected $fillable = ['rental_id', 'state', 'senia', 'senia_date', 'closed_for'];

    public function rental()
    {
        return $this->belongsTo('App\Rental', 'rental_id', 'id');
    }

    public function ordersDetail()
    {
        return $this->hasMany('App\OrdersDetail', 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'closed_for', 'id');
    }
}
