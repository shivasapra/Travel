<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(AirlinesTableSeeder::class);
        // $this->call(AirportsTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(PermissionsSeeder::class);
    }
}
