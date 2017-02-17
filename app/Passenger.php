<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passenger extends Model
{
  use SoftDeletes;

  protected $table = 'passengers';
  protected $dates = ['deleted_at'];
  protected $fillable = ['name', 'lastname', 'country_id', 'dni', 'passport', 'email', 'celphone', 'phone', 'address', 'destination', 'genre'];

  public function country()
  {
    return $this->belongsTo('App\Country');
  }
  public function rentals()
  {
    return $this->hasMany('App\Rental');
  }
}
