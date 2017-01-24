<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Promotion extends Model
{
  use SoftDeletes;
  use Sluggable;

  protected $table = 'promotions';
  protected $dates = ['deleted_at'];
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
