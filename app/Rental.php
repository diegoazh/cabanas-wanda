<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
  use SoftDeletes;

  protected $table = 'rentals';
  protected $dates = ['deleted_at'];
  protected $fillable = ['cottageId', 'from', 'to', 'own', 'description', 'userId', 'passengerId', 'promotionId', 'totalAmount', 'reservationPayment', 'dateReservationPayment', 'deductions', 'deductionsDescription', 'finalPayment', 'dateFinalPayment', 'state', 'cottageState'];

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
}
