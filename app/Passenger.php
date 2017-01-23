<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
  protected $table = 'passengers';
  protected $fillable = ['name', 'lastname', 'country_id', 'dni', 'passport', 'email', 'address', 'destination'];

  public function country()
  {
    return $this->belongsTo('App\Country');
  }
  public function rentals()
  {
    return $this->hasMany('App\Rental');
  }
}
