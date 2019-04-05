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


        $airline_data = App\airlines::create(['name' => 'Aegean Airlines']);
        $airline_data = App\airlines::create(['name' => 'Aer Lingus']);
        $airline_data = App\airlines::create(['name' => 'Aeroflot']);
        $airline_data = App\airlines::create(['name' => 'Aerolineas Argentinas']);
        $airline_data = App\airlines::create(['name' => 'Aeromexico']);
        $airline_data = App\airlines::create(['name' => 'Air Austral']);
        $airline_data = App\airlines::create(['name' => 'Air Canada']);
        $airline_data = App\airlines::create(['name' => 'Air Caraibes']);
        $airline_data = App\airlines::create(['name' => 'Air China']);
        $airline_data = App\airlines::create(['name' => 'Air Europa']);
        $airline_data = App\airlines::create(['name' => 'Air France']);
        $airline_data = App\airlines::create(['name' => 'Air India']);
        $airline_data = App\airlines::create(['name' => 'Air India Express']);
        $airline_data = App\airlines::create(['name' => 'Air Italy']);
        $airline_data = App\airlines::create(['name' => 'Air Namibia']);
        $airline_data = App\airlines::create(['name' => 'Air New Zealand']);
        $airline_data = App\airlines::create(['name' => 'Air Serbia']);
        $airline_data = App\airlines::create(['name' => 'Air Tahiti Nui']);
        $airline_data = App\airlines::create(['name' => 'Air Transat']);
        $airline_data = App\airlines::create(['name' => 'Air Vanuatu']);
        $airline_data = App\airlines::create(['name' => 'AirAsia']);
        $airline_data = App\airlines::create(['name' => 'AirAsia X']);
        $airline_data = App\airlines::create(['name' => 'Aircalin']);
        $airline_data = App\airlines::create(['name' => 'Alaska Airlines']);
        $airline_data = App\airlines::create(['name' => 'Alitalia']);
        $airline_data = App\airlines::create(['name' => 'Allegiant']);
        $airline_data = App\airlines::create(['name' => 'American Airlines']);
        $airline_data = App\airlines::create(['name' => 'ANA']);
        $airline_data = App\airlines::create(['name' => 'Asiana']);
        $airline_data = App\airlines::create(['name' => 'AtlasGlobal']);
        $airline_data = App\airlines::create(['name' => 'Austrian']);
        $airline_data = App\airlines::create(['name' => 'Avianca']);
        $airline_data = App\airlines::create(['name' => 'Azerbaijan Hava Yollary']);
        $airline_data = App\airlines::create(['name' => 'Azores Airlines']);
        $airline_data = App\airlines::create(['name' => 'Azul']);

        $airline_data = App\airlines::create(['name' => 'Bangkok Airways']);
        $airline_data = App\airlines::create(['name' => 'British Airways']);
        $airline_data = App\airlines::create(['name' => 'Brussels Airlines']);

        $airline_data = App\airlines::create(['name' => 'Cathay Pacific']);
        $airline_data = App\airlines::create(['name' => 'CEBU Pacific Air']);
        $airline_data = App\airlines::create(['name' => 'China Airlines']);
        $airline_data = App\airlines::create(['name' => 'China Eastern']);
        $airline_data = App\airlines::create(['name' => 'China Southern']);
        $airline_data = App\airlines::create(['name' => 'Condor']);
        $airline_data = App\airlines::create(['name' => 'Copa Airlines']);
        $airline_data = App\airlines::create(['name' => 'Croatia Airlines']);
        $airline_data = App\airlines::create(['name' => 'Czech Airlines']);

        $airline_data = App\airlines::create(['name' => 'Delta']);
        $airline_data = App\airlines::create(['name' => 'Dragonair']);

        $airline_data = App\airlines::create(['name' => 'easyJet']);
        $airline_data = App\airlines::create(['name' => 'Edelweiss Air']);
        $airline_data = App\airlines::create(['name' => 'Egyptair']);
        $airline_data = App\airlines::create(['name' => 'EL AL']);
        $airline_data = App\airlines::create(['name' => 'Emirates']);
        $airline_data = App\airlines::create(['name' => 'Ethiopian Airlines']);
        $airline_data = App\airlines::create(['name' => 'Etihad']);
        $airline_data = App\airlines::create(['name' => 'Eurowings']);
        $airline_data = App\airlines::create(['name' => 'EVA Air']);

        $airline_data = App\airlines::create(['name' => 'Fiji Airways']);
        $airline_data = App\airlines::create(['name' => 'Finnair']);
        $airline_data = App\airlines::create(['name' => 'FlyBE']);
        $airline_data = App\airlines::create(['name' => 'flydubai']);
        $airline_data = App\airlines::create(['name' => 'FlyOne']);
        $airline_data = App\airlines::create(['name' => 'French bee']);
        $airline_data = App\airlines::create(['name' => 'Frontier']);

        $airline_data = App\airlines::create(['name' => 'Garuda Indonesia']);
        $airline_data = App\airlines::create(['name' => 'Germanwings']);
        $airline_data = App\airlines::create(['name' => 'Gol']);
        $airline_data = App\airlines::create(['name' => 'Gulf Air']);

        $airline_data = App\airlines::create(['name' => 'Hainan Airlines']);
        $airline_data = App\airlines::create(['name' => 'Hawaiian Airlines']);
        $airline_data = App\airlines::create(['name' => 'Hong Kong Airlines']);

        $airline_data = App\airlines::create(['name' => 'Iberia']);
        $airline_data = App\airlines::create(['name' => 'Icelandair']);
        $airline_data = App\airlines::create(['name' => 'IndiGo Airlines']);
        $airline_data = App\airlines::create(['name' => 'InterJet']);

        $airline_data = App\airlines::create(['name' => 'Japan Airlines']);
        $airline_data = App\airlines::create(['name' => 'Jeju Air']);
        $airline_data = App\airlines::create(['name' => 'Jet Airways']);
        $airline_data = App\airlines::create(['name' => 'Jet2']);
        $airline_data = App\airlines::create(['name' => 'JetBlue']);
        $airline_data = App\airlines::create(['name' => 'Jetstar']);

        $airline_data = App\airlines::create(['name' => 'Kenya Airways']);
        $airline_data = App\airlines::create(['name' => 'KLM']);
        $airline_data = App\airlines::create(['name' => 'Korean Air']);

        $airline_data = App\airlines::create(['name' => 'La Compagnie']);
        $airline_data = App\airlines::create(['name' => 'LATAM Brasil']);
        $airline_data = App\airlines::create(['name' => 'LATAM Chile']);
        $airline_data = App\airlines::create(['name' => 'Lion Airlines']);
        $airline_data = App\airlines::create(['name' => 'LOT Polish Airlines']);
        $airline_data = App\airlines::create(['name' => 'Lufthansa']);

        $airline_data = App\airlines::create(['name' => 'Malaysia Airlines']);
        $airline_data = App\airlines::create(['name' => 'Middle East Airlines']);

        $airline_data = App\airlines::create(['name' => 'Nok Air']);
        $airline_data = App\airlines::create(['name' => 'Nordwind Airlines']);
        $airline_data = App\airlines::create(['name' => 'Norwegian Air Shuttle']);

        $airline_data = App\airlines::create(['name' => 'Oman Air']);

        $airline_data = App\airlines::create(['name' => 'Pakistan International Airlines']);
        $airline_data = App\airlines::create(['name' => 'Peach']);
        $airline_data = App\airlines::create(['name' => 'Pegasus Airlines']);
        $airline_data = App\airlines::create(['name' => 'Philippine Airlines']);
        $airline_data = App\airlines::create(['name' => 'Porter']);

        $airline_data = App\airlines::create(['name' => 'Qantas']);
        $airline_data = App\airlines::create(['name' => 'Qatar Airways']);

        $airline_data = App\airlines::create(['name' => 'Regional Express']);
        $airline_data = App\airlines::create(['name' => 'Rossiya - Russian Airlines']);
        $airline_data = App\airlines::create(['name' => 'Royal Air Maroc']);
        $airline_data = App\airlines::create(['name' => 'Royal Brunei']);
        $airline_data = App\airlines::create(['name' => 'Royal Jordanian']);
        $airline_data = App\airlines::create(['name' => 'Ryanair']);

        $airline_data = App\airlines::create(['name' => 'S7 Airlines']);
        $airline_data = App\airlines::create(['name' => 'SAS']);
        $airline_data = App\airlines::create(['name' => 'Saudia']);
        $airline_data = App\airlines::create(['name' => 'Scoot Airlines']);
        $airline_data = App\airlines::create(['name' => 'Shanghai Airlines']);
        $airline_data = App\airlines::create(['name' => 'Silkair']);
        $airline_data = App\airlines::create(['name' => 'Singapore Airlines']);
        $airline_data = App\airlines::create(['name' => 'Skylanes']);
        $airline_data = App\airlines::create(['name' => 'South African Airways']);
        $airline_data = App\airlines::create(['name' => 'Southwest']);
        $airline_data = App\airlines::create(['name' => 'SpiceJet']);
        $airline_data = App\airlines::create(['name' => 'Spirit']);
        $airline_data = App\airlines::create(['name' => 'Spring Airlines']);
        $airline_data = App\airlines::create(['name' => 'Spring Japan']);
        $airline_data = App\airlines::create(['name' => 'SriLankan Airlines']);
        $airline_data = App\airlines::create(['name' => 'Sun Country']);
        $airline_data = App\airlines::create(['name' => 'Sunwing']);
        $airline_data = App\airlines::create(['name' => 'SWISS']);
        $airline_data = App\airlines::create(['name' => 'Swoop']);

        $airline_data = App\airlines::create(['name' => 'TAAG']);
        $airline_data = App\airlines::create(['name' => 'TACA']);
        $airline_data = App\airlines::create(['name' => 'TAP Portugal']);
        $airline_data = App\airlines::create(['name' => 'THAI']);
        $airline_data = App\airlines::create(['name' => 'Thomas Cook Airlines']);
        $airline_data = App\airlines::create(['name' => 'Thomson']);
        $airline_data = App\airlines::create(['name' => 'tigerair Australia']);
        $airline_data = App\airlines::create(['name' => 'Transavia Airlines']);
        $airline_data = App\airlines::create(['name' => 'TUIfly']);
        $airline_data = App\airlines::create(['name' => 'Tunis Air']);
        $airline_data = App\airlines::create(['name' => 'Turkish Airlines']);

        $airline_data = App\airlines::create(['name' => 'Ukraine International']);
        $airline_data = App\airlines::create(['name' => 'United']);
        $airline_data = App\airlines::create(['name' => 'UTair Aviation']);

        $airline_data = App\airlines::create(['name' => 'Vanilla Air']);
        $airline_data = App\airlines::create(['name' => 'Vietnam Airlines']);
        $airline_data = App\airlines::create(['name' => 'Virgin Atlantic']);
        $airline_data = App\airlines::create(['name' => 'Virgin Australia']);
        $airline_data = App\airlines::create(['name' => 'Vistara']);
        $airline_data = App\airlines::create(['name' => 'Viva Aerobus']);
        $airline_data = App\airlines::create(['name' => 'Volaris']);
        $airline_data = App\airlines::create(['name' => 'Volotea']);
        $airline_data = App\airlines::create(['name' => 'Vueling Airlines']);

        $airline_data = App\airlines::create(['name' => 'WestJet']);
        $airline_data = App\airlines::create(['name' => 'Wizzair']);

        $airline_data = App\airlines::create(['name' => 'Xiamen Airlines']);

    }
}
