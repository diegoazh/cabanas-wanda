<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use SoftDeletes;

    protected $table = 'foods';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'type', 'description', 'price', 'available'];

    public function ordersDetail()
    {
        return $this->hasMany('App\OrdersDetail', 'food_id', 'id');
    }
}
