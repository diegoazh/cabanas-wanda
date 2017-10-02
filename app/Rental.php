<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use SoftDeletes;

    protected $table = 'rentals';
    protected $dates = ['deleted_at'];
    protected $fillable = ['codeReservation', 'cottage_id', 'from', 'to', 'own', 'description', 'user_id', 'passenger_id', 'promotion_id', 'cottage_price', 'total_days', 'dateReservationPayment', 'deductions', 'deductionsDescription', 'finalPayment', 'dateFinalPayment', 'state', 'wasRated'];

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
    public static function cottageForCapacity($capacity, $simple, $dateFrom, $dateTo)
    {
        $cottagesFive = Cottage::where('state', 'enabled')->where('accommodation', 5)->where('type', $simple ? '=' : 'like', $simple ? 'simple' : '%')->count(); // verificamos cuantas cabañas de 5 hay
        $cottagesFour = Cottage::where('state', 'enabled')->where('accommodation', '<', 5)->where('type', $simple ? '=' : 'like', $simple ? 'simple' : '%')->count(); // verificamos cuantas cabañas de 4 hay

        $necesariasFive = (int)($capacity / 5); // obtenemos la cantidad de cabañas necesarias para 5 personas
        $restante = ($capacity > 5) ? $capacity % 5 : 0; // obtenemos los ocupantes que faltan para una cabaña de 4 personas
        $necesariasFour = 0;

        if ($necesariasFive > $cottagesFive || !empty($restante)) {
            $restante += ($necesariasFive - $cottagesFive > 0) ? ($necesariasFive - $cottagesFive) * 5 : 0; // determinamos las personas que faltan si no hay cabañas de cinco disponibles para todos
            $necesariasFour = floor($restante / 4); // determinamos cauntas cabañas de 4 se necesitan
            if ($restante % 4) $necesariasFour++; // determinamos si aun quedan personas y sumamos una cabaña más
        }

        if ($capacity < 5) $necesariasFour++;

        $cottages = null;
        $cottages2 = null;

        if ($cottagesFive) {

            $cottages = Cottage::whereNotIn('id', function ($query) use ($simple, $dateFrom, $dateTo) { // pedimos ids que no esten dentro de la subconsulta.
                $query->select('cottage_id')// subconsulta: pedimos ids de cabañas que han sido reservadas entre las fechas elegidas por el usuario
                ->from(with(new Rental)->getTable())
                    ->whereBetween('from', [$dateFrom, $dateTo])
                    ->whereBetween('to', [$dateFrom, $dateTo]);
            })->where('accommodation', '=', 5) // deben ser de 5 personas
                ->where('state', 'enabled') // deben estar habilitadas
                ->where('type', $simple ? '=' : 'like', $simple ? 'simple' : '%')
                ->limit($necesariasFive > $cottagesFive ? $cottagesFive : $necesariasFive)// limitamos los resultados a la cantidad de cabañas necesaria
                ->get()->toArray();

        }

        if ($necesariasFour) {

            $cottages2 = Cottage::whereNotIn('id', function ($query) use ($simple, $dateFrom, $dateTo) { // pedimos ids que no esten dentro de la subconsulta.
                $query->select('cottage_id')// subconsulta: pedimos ids de cabañas que han sido reservadas entre las fechas elegidas por el usuario
                ->from(with(new Rental)->getTable())
                    ->whereBetween('from', [$dateFrom, $dateTo])
                    ->whereBetween('to', [$dateFrom, $dateTo]);
            })->where('accommodation', '<', 5)// deben ser de 4 personas
                ->where('state', 'enabled') // deben estar habilitadas
                ->where('type', $simple ? '=' : 'like', $simple ? 'simple' : '%')
                ->limit($necesariasFour > $cottagesFour ? $cottagesFour : $necesariasFour)// limitamos los resultados a la cantidad de cabañas necesaria
                ->get()->toArray();

        }

        if (!empty($cottages)) {

            if (!empty($cottages2)) {
                return array_merge($cottages, $cottages2);
            }

            return $cottages;

        } else if (!empty($cottages2)) {
            return $cottages2;
        } else {
            return [];
        }
    }

    public static function cottageForNumber($number, $simple, $dateFrom, $dateTo)
    {
        $rentals = Rental::whereIn('cottage_id', function ($query) use ($number, $simple, $dateFrom, $dateTo) {
            $query->select('id')->from(with(new Cottage)->getTable())
                ->where('number', $number);
        })->whereBetween('from', [$dateFrom, $dateTo])->where('to', 'between', [$dateFrom, $dateTo])->get()->toArray();

        $cottage = Cottage::where('number', $number)->where('state', 'enabled')->where('type', $simple ? '=' : 'like', $simple ? 'simple' : '%')->first();

        return empty($rentals) ? (empty($cottage) ? [] : $cottage->toArray()) : [];
    }
}
