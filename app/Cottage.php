<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rental;

class Cottage extends Model
{
  protected $table = 'cottages';
  protected $fillable = ['number', 'type', 'accommodation', 'description', 'images'];
  public function rentals()
  {
    return $this->hasMany('Rental');
  }
}
