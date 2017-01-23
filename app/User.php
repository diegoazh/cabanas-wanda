<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Country;
use App\Rental;


class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $table = 'users';
  protected $fillable = ['name', 'lastname', 'date_of_birth', 'country_id', 'dni', 'passport', 'email', 'address', 'destination', 'password', 'type'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function country()
  {
    return $this->belongsTo('Country');
  }
  public function rentals()
  {
    return $this->hasMany('Rental');
  }

  public function isAdmin()
  {
    return ($this->type === 'administrador' || $this->type === 'sysadmin');
  }

  public function displayName()
  {
      return $this->lastname . ', ' . $this->name;
  }
}
