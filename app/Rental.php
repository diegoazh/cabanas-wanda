<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cottage;
use App\User;
use App\Passenger;
use App\Promotion;
use App\Claim;

class Rental extends Model
{
  protected $table = 'rentals';
  protected $fillable = ['cottage_id', 'from', 'to', 'own', 'description', 'user_id', 'passenger_id', 'promotion_id', 'total_amount', 'reservation_payment', 'date_reservation_payment', 'deductions', 'deductions_description', 'final_payment', 'date_final_payment', 'state', 'cottage_state'];

  public function cottage()
  {
    return $this->belongsTo('Cottage');
  }
  public function user()
  {
    return $this->belongsTo('User');
  }
  public function passenger()
  {
    return $this->belongsTo('Passenger');
  }
  public function promotion()
  {
    return $this->belongsTo('Promotion');
  }
  public function claims()
  {
    return $this->hasMany('Claim');
  }
}
