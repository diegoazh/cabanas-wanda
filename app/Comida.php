<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comida extends Model
{
    use SoftDeletes;

    protected $table = 'comidas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'type', 'description', 'price'];

    public function detallesPedidos()
    {
        $this->belongsTo('App\DetallePedidos', 'comida_id', 'id');
    }
}
