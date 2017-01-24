<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $table = 'countries';
    protected $dates = ['deleted_at'];
    protected $fillable = ['abbreviation', 'country'];

    public function users()
    {
      return $this->hasMany('App\User');
    }
    public function passengers()
    {
      return $this->hasMany('App\Passenger');
    }
}
