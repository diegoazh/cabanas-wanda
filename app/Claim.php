<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rental;

class Claim extends Model
{
  protected $table = 'claims';
  protected $fillable = ['rental_id', 'type', 'description', 'state'];
  public function rental()
  {
    return $this->belongsTo('Rental');
  }
}
