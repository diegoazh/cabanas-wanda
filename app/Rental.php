<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
  use SoftDeletes;

  protected $table = 'rentals';
  protected $dates = ['deleted_at'];
  protected $fillable = ['codeReservation', 'cottage_id', 'from', 'to', 'own', 'description', 'user_id', 'passenger_id', 'promotion_id', 'totalAmount', 'reservationPayment', 'dateReservationPayment', 'deductions', 'deductionsDescription', 'finalPayment', 'dateFinalPayment', 'state', 'cottageState', 'wasRated'];

  public function cottage()
  {
    return $this->belongsTo('App\Cottage');
  }
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function passenger()
  {
    return $this->belongsTo('App\Passenger');
  }
  public function promotion()
  {
    return $this->belongsTo('App\Promotion');
  }
  public function claims()
  {
    return $this->hasMany('App\Claim');
  }

  public function setCodeReservationAttribute($value)
  {
      $this->attributes['codeReservation'] = sha1($value);
  }

  public function createCodeReservation()
  {
      $idUser = (!empty($this->attributes['user_id'])) ? $this->attributes['user_id'] : $this->attributes['passenger_id'];
      $this->attributes['codeReservation'] = $this->attributes['cottage_id'] . $idUser . time();
  }
}
