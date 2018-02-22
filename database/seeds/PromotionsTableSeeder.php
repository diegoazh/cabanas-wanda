<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Promotion;
use Carbon\Carbon;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 15; $i > 0; $i--) {
          $monto = null;
          $percent = null;

          $faker->numberBetween(0,1) > 0 ? $monto = $faker->numberBetween(100, 300) : $percent = $faker->numberBetween(10, 40);
          $startDate = Carbon::createFromFormat('Y-m-d', $faker->date('Y-m-d', Carbon::now()->addMonths(8)->toDateString()));

          Promotion::create([
            'name' => $faker->words(3, true),
            'amount' => $monto,
            'percentage' => $percent,
            'description' => $faker->text(500),
            'startDate' => $startDate,
            'endDate' => $startDate->addMonth()->toDateString(),
            'state' => Carbon::now()->gt($startDate) ? 'disabled' : $faker->randomElement(['paused', 'enabled', 'disabled']),
            'descriptionState' => $faker->text(500),
            'termsAndConditions' => $faker->text(800)
          ]);
        }
    }
}
