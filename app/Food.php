<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use SoftDeletes;

    protected $table = 'foods';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'type', 'description', 'price'];

    public function detallesPedidos()
    {
        $this->belongsTo('App\OrdersDetail', 'comida_id', 'id');
    }
}
