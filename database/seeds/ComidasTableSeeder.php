<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ComidasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 150; $i++) {
            $plato = new \App\Comida();
            $plato->name = $faker->name;
            $plato->type = $faker->randomElement(['desayuno', 'almuerzo', 'merienda', 'cena']);
            $plato->price = $faker->numberBetween(30, 250);
            $plato->description = $faker->text(150);
            $plato->save();
        }
    }
}
