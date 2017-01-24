<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Claim extends Model
{
  use SoftDeletes;
  use Sluggable;

  protected $table = 'claims';
  protected $dates = ['deleted_at'];
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
