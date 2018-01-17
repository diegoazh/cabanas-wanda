<?php

use App\User;
use App\Cottage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Rental;
use Illuminate\Support\Facades\DB;

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
        $state = '';

        $tz = Carbon::now()->tzName;
        $initDate = Carbon::createFromDate('2014', '01', '01');
        $maxDate = Carbon::now()->addYear();



        for ($i = 720; $i >= 0; $i--) {

            $user = $faker->randomElement(User::all()->toArray());
            $totalDays = $faker->numberBetween(1, 30);
            $dFrom = Carbon::createFromFormat('Y-m-d H:i:s.u', $faker->unique()->dateTimeBetween($initDate->toDateTimeString(), $maxDate->toDateTimeString(), $tz)->date);
            $dTo = Carbon::createFromFormat('Y-m-d', $dFrom->toDateString())->addDays($totalDays);

            if($dFrom->between($initDate, Carbon::now()->subDays(31))) {

                $state = $faker->randomElement(['finalizada', 'cancelada']);

            } else if($dFrom->between(Carbon::now()->subDays(30), Carbon::now())) {

                if ($dFrom->lte(Carbon::now()->subDays(2)) && $dTo->lte(Carbon::now()->subDay())) {

                    $state = $faker->randomElement(['finalizada', 'cancelada']);

                } else if($dFrom->lte(Carbon::now()) && $dTo->lte(Carbon::now())) {

                    $state = $faker->randomElement(['en_curso', 'finalizada', 'cancelada']);

                } else if ($dFrom->lte(Carbon::now()) && $dTo->gt(Carbon::now())) {

                    $state = $faker->randomElement(['en_curso', 'cancelada']);

                }

            } else if($dFrom->gt(Carbon::now())) {

                $state = $faker->randomElement(['pendiente', 'confirmada', 'cancelada']);

            }

            $rental = new Rental();
            $rental->cottage_id = $faker->randomElement([1,3,4,5,6,7,8,9]);
            $rental->total_days = $totalDays;
            $rental->dateFrom = $dFrom->toDateString();
            $rental->dateTo = $dTo->toDateString();
            $rental->user_id = $user['id'];
            $rental->cottage_price = Cottage::find($rental->cottage_id)->price;
            $rental->dateReservationPayment = Carbon::createFromFormat('Y-m-d', $rental->dateFrom)->subDay()->addHours(10)->toDateString();
            $code = $rental->createCodeReservation($rental->cottage_id, $rental->user_id);
            $rental->code_reservation = $code;
            $rental->state = $state;
            $rental->save();

            DB::table('test_code_reservation')->insert([
                'code' => $code,
                'date_from' => $rental->dateFrom
            ]);
        }
    }
}
