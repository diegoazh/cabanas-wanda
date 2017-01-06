<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Passenger;

class Country extends Model
{
    protected $table = 'conuntries';
    protected $fillable = ['country'];
    public function users()
    {
      return $this->hasMany('User');
    }
    public function passengers()
    {
      return $this->hasMany('Passenger');
    }
}
