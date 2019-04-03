<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
        	'name' => 'Shiva Sapra',
        	'email' => 'shivasapra24@gmail.com',
        	'password' => bcrypt('password'),
            'admin' => 1
        ]);

        $user = App\User::create([
            'name' => 'himsoft',
            'email' => 'info@himsoftsolution.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        $tax = App\settings::create([
            'tax' => 0,
            'enable' => 'yes',
        ]);


        $product = App\products::create([
            'service' => 'Flight',
        ]);
        $product = App\products::create([
            'service' => 'Visa Services',
        ]);
        $product = App\products::create([
            'service' => 'Hotel',
        ]);
        $product = App\products::create([
            'service' => 'Insurance',
        ]);
        $product = App\products::create([
            'service' => 'Local Sight Sceen',
        ]);
        $product = App\products::create([
            'service' => 'Local Transport',
        ]);
        $product = App\products::create([
            'service' => 'Other Facilities',
        ]);
        $product = App\products::create([
            'service' => 'Car Rental',
        ]);

    }
}
