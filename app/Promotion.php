<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Promotion extends Model
{
  use Sluggable;

  protected $table = 'promotions';
  protected $fillable = ['name', 'amount', 'percentage', 'description', 'start_date', 'end_date', 'state', 'description_state', 'terms_and_conditions'];

  public function Sluggable()
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }
  public function rentals()
  {
    return $this->hasMany('App\Rental');
  }
}
