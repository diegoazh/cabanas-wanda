<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User as User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $type = ['frecuente', 'empleado', 'administrador', 'sysadmin'];

        for ($i = 0; $i < 60; $i++)
        {
            $user = new User();
            $user->name = $faker->firstName;
            $user->lastname = $faker->lastName;
            $user->dateOfBirth = $faker->date('Y-m-d');
            $user->country_id = $faker->numberBetween(0, 240);
            $user->dni = $faker->numberBetween(15000000, 45000000);
            $user->email = $faker->email;
            $user->celphone = $faker->e164PhoneNumber;
            $user->phone = $faker->e164PhoneNumber;
            $user->address = $faker->address;
            $user->destination = $faker->sentence(5);
            $user->password = \Hash::make('123456789');
            $user->type = $type[rand(0, 3)];
            $user->imageProfile = $faker->imageUrl();
            $user->save();
        }
    }
}
