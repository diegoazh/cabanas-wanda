<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class Rental extends Model
{
    use SoftDeletes;

    protected $table = 'rentals';
    protected $dates = ['deleted_at'];
    protected $fillable = ['code_reservation', 'cottage_id', 'dateFrom', 'dateTo', 'own', 'description', 'user_id', 'promotion_id', 'cottage_price', 'total_days', 'dateReservationPayment', 'deductions', 'deductionsDescription', 'finalPayment', 'dateFinalPayment', 'state', 'wasRated'];

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

    public function promotion()
    {
        return $this->belongsTo('App\Promotion');
    }

    public function claims()
    {
        return $this->hasMany('App\Claim');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function devolution()
    {
        return $this->hasOne('App\Devolution');
    }

    /**
     * Mutators
     **/
    public function setCodeReservationAttribute($value)
    {
        $this->attributes['code_reservation'] = sha1($value);
    }

    /**
     * Metodos del modelo
     **/
    public function createCodeReservation()
    {
        $faker = Faker::create();
        $idUser = $this->attributes['user_id'];
        return strtoupper($faker->lexify('??')) . $this->attributes['cottage_id'] . $idUser . strtoupper($faker->lexify('???')) . time();
    }

    /**
     * Metodos estaticos de consultas a la db
     **/
    public static function availables($dateFrom, $dateTo)
    {
        $cottages = Cottage::whereNotIn('id', function ($query) use ($dateFrom, $dateTo) { // pedimos ids que no esten dentro de la subconsulta.
            $query->select('cottage_id')// subconsulta: pedimos ids de cabañas que han sido reservadas entre las fechas elegidas por el usuario
            ->from(with(new Rental)->getTable())
                ->whereBetween('dateFrom', [$dateFrom, $dateTo])
                ->orWhere(function ($query) use ($dateFrom, $dateTo) {
                    $query->whereBetween('dateTo', [$dateFrom, $dateTo]);
                });
        })->where('state', 'enabled')->get();

        if (!$cottages->count()) return [];

        return $cottages->toArray();
    }

    public static function notAvailable($number, $dateFrom, $dateTo)
    {
        $cottages = Cottage::where('number', $number)->whereIn('id', function ($query) use ($dateFrom, $dateTo) { // pedimos ids que no esten dentro de la subconsulta.
            $query->select('cottage_id')// subconsulta: pedimos ids de cabañas que han sido reservadas entre las fechas elegidas por el usuario
            ->from(with(new Rental)->getTable())
                ->whereBetween('dateFrom', [$dateFrom, $dateTo])
                ->orWhere(function ($query) use ($dateFrom, $dateTo) {
                    $query->whereBetween('dateTo', [$dateFrom, $dateTo]);
                });
        })->where('state', 'enabled')->first();

        return $cottages;
    }
}
