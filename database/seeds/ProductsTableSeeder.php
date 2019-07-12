<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\products::create([
            'service' => 'Flight',
        ]);
        App\products::create([
            'service' => 'Visa Services',
        ]);
        App\products::create([
            'service' => 'Hotel',
        ]);
        App\products::create([
            'service' => 'Insurance',
        ]);
        App\products::create([
            'service' => 'Local Sight Sceen',
        ]);
        App\products::create([
            'service' => 'Local Transport',
        ]);
        App\products::create([
            'service' => 'Other Facilities',
        ]);
        App\products::create([
            'service' => 'Car Rental',
        ]);
    }
}
