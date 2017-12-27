<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Cottage as Cottage;

class CottagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = array('simple', 'matrimonial');
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++)
        {
            $cottage = new Cottage();
            $cottage->number = $faker->unique()->numberBetween(1,10);
            $cottage->name = $faker->unique()->word;
            $cottage->type = $cottage->number % 2 === 0 ? $type[1] : $type[0];
            $cottage->accommodation = $cottage->number === 5 || $cottage->number === 6 ? 5 : 4;
            $cottage->description = $faker->paragraph(3);
            $cottage->price = $faker->randomFloat(2, 0, 900);
            $cottage->images = $faker->imageUrl();
            $cottage->state = $cottage->number === 1 || $cottage->number === 2 ? 'disabled' : 'enabled';
            $cottage->save();
        }
    }
}
