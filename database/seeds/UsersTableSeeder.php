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
            'email' => 'info@himsoftsolution.',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        $tax = App\settings::create([
            'tax' => 0,
            'enable' => 'yes',
        ]);


        $user = App\products::create([
            'service' => 'Flight',
        ]);
        $user = App\products::create([
            'service' => 'Visa Services',
        ]);

    }
}
