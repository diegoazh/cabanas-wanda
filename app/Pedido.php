<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = "pedidos";
    protected $dates = ['deleted_at'];
    protected $fillable = ['fecha_pedido', 'rental_id'];

    public function rental()
    {
        $this->belongsTo('App\Rental', 'rental_id', 'id');
    }

    public function detallePedidos()
    {
        $this->hasMany('App\DetallePedidos', 'pedido_id', 'id');
    }
}
