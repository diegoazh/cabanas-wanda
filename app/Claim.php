<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Claim extends Model
{
  use Sluggable;

  protected $table = 'claims';
  protected $fillable = ['rental_id', 'type', 'title', 'description', 'state'];

  public function Sluggable()
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }
  public function rental()
  {
    return $this->belongsTo('App\Rental');
  }
}
