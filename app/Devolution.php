<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devolution extends Model
{
    use SoftDeletes;

    protected $table = 'devolutions';
    protected $dates = ['deleted_at'];
    protected $fillable = ['rental_id', 'from_admin', 'description', 'state'];

    public function rental()
    {
        return $this->belongsTo('App\Rental');
    }
}
