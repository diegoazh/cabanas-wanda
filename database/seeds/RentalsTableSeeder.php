<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Rental;

class RentalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 30; $i >= 0; $i--) {
            $rental = new Rental();
            $rental->cottage_id = $faker->randomElement([1,3,4,5,6,7,8,9]);
            $rental->total_days = $faker->numberBetween(1, 30);
            $rental->dateFrom = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $faker->unique()->dateTimeBetween(\Carbon\Carbon::now()->toDateTimeString(), \Carbon\Carbon::now()->addYear()->toDateTimeString(), date_default_timezone_get())->date)->toDateString();
            $rental->dateTo = \Carbon\Carbon::createFromFormat('Y-m-d', $rental->dateFrom)->addDays($rental->total_days)->toDateString();
            $user = $faker->randomElement(\App\User::where('type', 'frecuente')->get()->toArray());
            $rental->user_id = $user['id'];
            $rental->cottage_price = \App\Cottage::find($rental->cottage_id)->price;
            $rental->dateReservationPayment = \Carbon\Carbon::createFromFormat('Y-m-d', $rental->dateFrom)->subDay()->toDateString();
            $rental->code_reservation = $rental->createCodeReservation();
            $rental->save();
        }
    }
}
