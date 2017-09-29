<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use SoftDeletes;

    protected $table = 'rentals';
    protected $dates = ['deleted_at'];
    protected $fillable = ['codeReservation', 'cottage_id', 'from', 'to', 'own', 'description', 'user_id', 'passenger_id', 'promotion_id', 'totalAmount', 'reservationPayment', 'dateReservationPayment', 'deductions', 'deductionsDescription', 'finalPayment', 'dateFinalPayment', 'state', 'wasRated'];

    /**
     * Relaciones del modelo
     **/
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

    /**
     * Mutators
     **/
    public function setCodeReservationAttribute($value)
    {
        $this->attributes['codeReservation'] = sha1($value);
    }

    /**
     * Metodos del modelo
     **/
    public function createCodeReservation()
    {
        $idUser = (!empty($this->attributes['user_id'])) ? $this->attributes['user_id'] : $this->attributes['passenger_id'];
        $this->attributes['codeReservation'] = $this->attributes['cottage_id'] . $idUser . time();
    }

    /**
     * Metodos estaticos de consultas a la db
     **/
    public static function cottageForCapacity($capacity, $dateFrom, $dateTo)
    {
        $necesarias = $capacity / 5; // obtenemos la cantidad de cabañas necesarias para 5 personas
        $restante = $capacity % 5; // obtenemos los ocupantes que faltan para una cabaña de 4 personas o menos
        $cottages = null;
        $otherCottage = null;

        if ($capacity >= 5) {

            $cottages = Cottage::whereNotIn('id', function ($query) use ($dateFrom, $dateTo) { // pedimos ids que no esten dentro de la subconsulta.
                $query->select('cottage_id')// subconsulta: pedimos ids de cabañas que han sido reservadas entre las fechas elegidas por el usuario
                ->from(with(new Rental)->getTable())
                    ->whereBetween('from', [$dateFrom, $dateTo])
                    ->whereBetween('to', [$dateFrom, $dateTo]);
            })->where('accommodation', '=', 5)// deben ser de 5 personas
            ->limit($necesarias)// limitamos los resultados a la cantidad de cabañas necesaria
            ->get()->toArray();
        }

        if ($capacity < 5 || $restante > 0) { // si es menor a 5 o el resto es mayor a uno necesitamos una cabaña más

            $otherCottage = Cottage::whereNotIn('id', function ($query) use ($dateFrom, $dateTo) {
                $query->select('cottage_id')
                    ->from(with(new Rental)->getTable())
                    ->whereBetween('from', [$dateFrom, $dateTo])
                    ->whereBetween('to', [$dateFrom, $dateTo]);
            })->where('accommodation', '<', 5)->first()->toArray();

        }

        if (!empty($cottages)) {
            return !empty($otherCottage) ? array_push($cottages, $otherCottage) : $cottages;
        } else {
            return $otherCottage;
        }
    }

    public static function cottageForNumber($number, $dateFrom, $dateTo)
    {
        $cottage = Cottage::where('number', $number)->first();

        $rentals = Rental::whereIn('cottage_id', function ($query) use ($dateFrom, $dateTo, $cottage) {
            $query->select('id')->from(with(new Cottage)->getTable())
                ->where('number', $cottage->number);
        })->whereBetween('from', [$dateFrom, $dateTo])
            ->whereBetween('to', [$dateFrom, $dateTo])
            ->get()->toArray();

        return empty($rentals) ? $cottage : [];
    }
}
