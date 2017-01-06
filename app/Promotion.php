<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rental;

class Promotion extends Model
{
  protected $table = 'promotions';
  protected $fillable = ['name', 'amount', 'percentage', 'description', 'start_date', 'end_date', 'state', 'description_state', 'terms_and_conditions'];

  public function rentals()
  {
    return $this->hasMany('Rental');
  }
}
