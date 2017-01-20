<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Rental;

class Cottage extends Model
{
  use Sluggable;

  protected $table = 'cottages';
  protected $fillable = ['number', 'name', 'type', 'accommodation', 'description', 'images', 'price', 'slug'];

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
    return $this->hasMany('Rental');
  }
}
