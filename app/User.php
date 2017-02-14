<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\MyTraits\TranslateDates;

class User extends Authenticatable
{
  use SoftDeletes, Notifiable, Sluggable, TranslateDates;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $table = 'users';
  protected $dates = ['deleted_at'];
  protected $fillable = ['name', 'lastname', 'date_of_birth', 'country_id', 'dni', 'passport', 'email', 'address', 'destination', 'password', 'type', 'image_profile', 'slug'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function Sluggable()
  {
    return [
        'slug' => [
            'source' => ['lastname', 'name']
        ]
    ];
  }

  public function country()
  {
    return $this->belongsTo('App\Country');
  }
  public function rentals()
  {
    return $this->hasMany('App\Rental');
  }

  public function isAdmin()
  {
    return ($this->type === 'administrador' || $this->type === 'sysadmin');
  }

  public function isEmployed()
  {
      return ($this->type === 'empleado');
  }

  public function displayName()
  {
      return $this->lastname . ', ' . $this->name;
  }
}
