<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
  use SoftDeletes;

  protected $table = 'rentals';
  protected $dates = ['deleted_at'];
  protected $fillable = ['cottage_id', 'from', 'to', 'own', 'description', 'user_id', 'passenger_id', 'promotion_id', 'total_amount', 'reservation_payment', 'date_reservation_payment', 'deductions', 'deductions_description', 'final_payment', 'date_final_payment', 'state', 'cottage_state'];

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
