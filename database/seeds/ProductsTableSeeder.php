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
