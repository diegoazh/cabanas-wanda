<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rental;

class Cottage extends Model
{
  protected $table = 'cottages';
  protected $fillable = ['number', 'letter', 'type', 'accommodation', 'description', 'images', 'price'];
  public function rentals()
  {
    return $this->hasMany('Rental');
  }
}
