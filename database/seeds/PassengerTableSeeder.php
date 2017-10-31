<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PassengerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 60; $i++)
        {
            $passenger = new \App\Passenger();
            $passenger->name = $faker->firstName;
            $passenger->lastname = $faker->lastName;
            $passenger->country_id = $faker->numberBetween(1, 240);
            $passenger->dni = $faker->unique()->numberBetween(15000000, 45000000);
            $passenger->email = $faker->unique()->email;
            $passenger->celphone = $faker->e164PhoneNumber;
            $passenger->phone = $faker->e164PhoneNumber;
            $passenger->address = $faker->address;
            $passenger->destination = $faker->sentence(5);
            $passenger->save();
        }
    }
}
