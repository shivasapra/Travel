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
        App\User::create([
        	'name' => 'Shiva Sapra',
        	'email' => 'shivasapra24@gmail.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        App\User::create([
            'name' => 'himsoft',
            'email' => 'info@himsoftsolution.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        App\settings::create([
            'tax' => 0,
            'enable' => 'yes',
        ]);

        App\ClientSettings::create([
            'corporate_percentage' => 0,
            'individual_percentage' => 0,
        ]);
    }
}
