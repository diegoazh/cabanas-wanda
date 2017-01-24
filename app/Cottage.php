<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Cottage extends Model
{
  use SoftDeletes;
  use Sluggable;

  protected $table = 'cottages';
  protected $dates = ['deleted_at'];
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
    return $this->hasMany('App\Rental');
  }
}
