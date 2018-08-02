<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $rentals = \App\Rental::all();

        foreach ($rentals as $rental) {

            for ($i = 4; $i >= 0; $i--) {

                $order = new \App\Order([
                    'senia' => $faker->numberBetween(5, 25),
                    'senia_date' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $faker->dateTimeBetween(\Carbon\Carbon::createFromFormat('Y-m-d', $rental->dateFrom)->toDateTimeString(), \Carbon\Carbon::createFromFormat('Y-m-d', $rental->dateTo)->toDateTimeString())->format('Y-m-d H:i:s'))->toDateString()
                ]);

                $rental->orders()->save($order);

                for ($j = 7; $j >= 0; $j--) {

                    $detail = new \App\OrdersDetail([
                        'delivery' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $faker->dateTimeBetween(\Carbon\Carbon::createFromFormat('Y-m-d', $rental->dateFrom)->toDateTimeString(), \Carbon\Carbon::createFromFormat('Y-m-d', $rental->dateTo)->toDateTimeString())->format('Y-m-d H:i:s'))->toDateString(),
                        'quantity' => $faker->numberBetween(1, 10),
                        'food_id' => $faker->numberBetween(1, \App\Food::all()->count())
                    ]);

                    $order->ordersDetail()->save($detail);

                }

            }

        }
    }
}
