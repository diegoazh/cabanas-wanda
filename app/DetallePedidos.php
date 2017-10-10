<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetallePedidos extends Model
{
    use SoftDeletes;

    protected $table = 'detalle_pedidos';
    protected $dates = ['deleted_at'];
    protected $fillable = ['pedido_id', 'comida_id', 'fecha_entrega', 'cantidad', 'precio_unidad'];

    public function pedido()
    {
        $this->belongsTo('App\Pedido', 'pedido_id', 'id');
    }

    public function comida()
    {
        $this->hasOne('App\Comida', 'comida_id', 'id');
    }
}
