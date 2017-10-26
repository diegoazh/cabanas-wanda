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

        $mantenimito = new User();
        $mantenimito->name = "Mantenimiento";
        $mantenimito->lastname = "Interno";
        $mantenimito->dni = 00000001;
        $mantenimito->country_id = 13;
        $mantenimito->email = "mantenimientoInterno@cabaniasdewanda.com.ar";
        $mantenimito->password = \Hash::make('Mantenimiento@Interno');
        $mantenimito->confirmed = true;
        $mantenimito->save();

        $dazh = new User([
            'name' => 'Diego Alberto',
            'lastname' => 'Zapata Häntsch',
            'dni' => 31511811,
            'country_id' =>  13,
            'email' => 'diegoazh2003@gmail.com',
            'password' => \Hash::make('yusuke'),
            'confirmed' => true,
            'type' => 'sysadmin'
        ]);
        $dazh->save();

        for ($i = 0; $i < 60; $i++)
        {
            $user = new User();
            $user->name = $faker->firstName;
            $user->lastname = $faker->lastName;
            $user->dateOfBirth = $faker->date('Y-m-d');
            $user->country_id = $faker->numberBetween(1, 240);
            $user->dni = $faker->unique()->numberBetween(15000000, 45000000);
            $user->email = $faker->unique()->email;
            $user->celphone = $faker->e164PhoneNumber;
            $user->phone = $faker->e164PhoneNumber;
            $user->address = $faker->address;
            $user->destination = $faker->sentence(5);
            $user->password = \Hash::make('123456789');
            $user->type = $type[rand(0, 3)];
            $user->imageProfile = $faker->imageUrl();
            $user->confirmed = true;
            $user->save();
        }
    }
}
