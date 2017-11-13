<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PassengerTableSeeder::class);
        $this->call(CottagesTableSeeder::class);
        $this->call(RentalsTableSeeder::class);
        $this->call(FoodsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
