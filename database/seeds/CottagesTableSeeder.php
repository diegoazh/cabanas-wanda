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
            $cottage->type = $type[$faker->numberBetween(0,1)];
            $cottage->accommodation = $faker->numberBetween(1,5);
            $cottage->description = $faker->paragraph(3);
            $cottage->price = $faker->randomFloat(2, 0, 900);
            $cottage->images = $faker->imageUrl();
            $cottage->save();
        }
    }
}
