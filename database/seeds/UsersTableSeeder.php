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


        $airline_data = App\AirlineData::create(['name' => 'Aegean Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Aer Lingus']);
        $airline_data = App\AirlineData::create(['name' => 'Aeroflot']);
        $airline_data = App\AirlineData::create(['name' => 'Aerolineas Argentinas']);
        $airline_data = App\AirlineData::create(['name' => 'Aeromexico']);
        $airline_data = App\AirlineData::create(['name' => 'Air Austral']);
        $airline_data = App\AirlineData::create(['name' => 'Air Canada']);
        $airline_data = App\AirlineData::create(['name' => 'Air Caraibes']);
        $airline_data = App\AirlineData::create(['name' => 'Air China']);
        $airline_data = App\AirlineData::create(['name' => 'Air Europa']);
        $airline_data = App\AirlineData::create(['name' => 'Air France']);
        $airline_data = App\AirlineData::create(['name' => 'Air India']);
        $airline_data = App\AirlineData::create(['name' => 'Air India Express']);
        $airline_data = App\AirlineData::create(['name' => 'Air Italy']);
        $airline_data = App\AirlineData::create(['name' => 'Air Namibia']);
        $airline_data = App\AirlineData::create(['name' => 'Air New Zealand']);
        $airline_data = App\AirlineData::create(['name' => 'Air Serbia']);
        $airline_data = App\AirlineData::create(['name' => 'Air Tahiti Nui']);
        $airline_data = App\AirlineData::create(['name' => 'Air Transat']);
        $airline_data = App\AirlineData::create(['name' => 'Air Vanuatu']);
        $airline_data = App\AirlineData::create(['name' => 'AirAsia']);
        $airline_data = App\AirlineData::create(['name' => 'AirAsia X']);
        $airline_data = App\AirlineData::create(['name' => 'Aircalin']);
        $airline_data = App\AirlineData::create(['name' => 'Alaska Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Alitalia']);
        $airline_data = App\AirlineData::create(['name' => 'Allegiant']);
        $airline_data = App\AirlineData::create(['name' => 'American Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'ANA']);
        $airline_data = App\AirlineData::create(['name' => 'Asiana']);
        $airline_data = App\AirlineData::create(['name' => 'AtlasGlobal']);
        $airline_data = App\AirlineData::create(['name' => 'Austrian']);
        $airline_data = App\AirlineData::create(['name' => 'Avianca']);
        $airline_data = App\AirlineData::create(['name' => 'Azerbaijan Hava Yollary']);
        $airline_data = App\AirlineData::create(['name' => 'Azores Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Azul']);

        $airline_data = App\AirlineData::create(['name' => 'Bangkok Airways']);
        $airline_data = App\AirlineData::create(['name' => 'British Airways']);
        $airline_data = App\AirlineData::create(['name' => 'Brussels Airlines']);

        $airline_data = App\AirlineData::create(['name' => 'Cathay Pacific']);
        $airline_data = App\AirlineData::create(['name' => 'CEBU Pacific Air']);
        $airline_data = App\AirlineData::create(['name' => 'China Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'China Eastern']);
        $airline_data = App\AirlineData::create(['name' => 'China Southern']);
        $airline_data = App\AirlineData::create(['name' => 'Condor']);
        $airline_data = App\AirlineData::create(['name' => 'Copa Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Croatia Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Czech Airlines']);

        $airline_data = App\AirlineData::create(['name' => 'Delta']);
        $airline_data = App\AirlineData::create(['name' => 'Dragonair']);

        $airline_data = App\AirlineData::create(['name' => 'easyJet']);
        $airline_data = App\AirlineData::create(['name' => 'Edelweiss Air']);
        $airline_data = App\AirlineData::create(['name' => 'Egyptair']);
        $airline_data = App\AirlineData::create(['name' => 'EL AL']);
        $airline_data = App\AirlineData::create(['name' => 'Emirates']);
        $airline_data = App\AirlineData::create(['name' => 'Ethiopian Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Etihad']);
        $airline_data = App\AirlineData::create(['name' => 'Eurowings']);
        $airline_data = App\AirlineData::create(['name' => 'EVA Air']);

        $airline_data = App\AirlineData::create(['name' => 'Fiji Airways']);
        $airline_data = App\AirlineData::create(['name' => 'Finnair']);
        $airline_data = App\AirlineData::create(['name' => 'FlyBE']);
        $airline_data = App\AirlineData::create(['name' => 'flydubai']);
        $airline_data = App\AirlineData::create(['name' => 'FlyOne']);
        $airline_data = App\AirlineData::create(['name' => 'French bee']);
        $airline_data = App\AirlineData::create(['name' => 'Frontier']);

        $airline_data = App\AirlineData::create(['name' => 'Garuda Indonesia']);
        $airline_data = App\AirlineData::create(['name' => 'Germanwings']);
        $airline_data = App\AirlineData::create(['name' => 'Gol']);
        $airline_data = App\AirlineData::create(['name' => 'Gulf Air']);

        $airline_data = App\AirlineData::create(['name' => 'Hainan Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Hawaiian Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Hong Kong Airlines']);

        $airline_data = App\AirlineData::create(['name' => 'Iberia']);
        $airline_data = App\AirlineData::create(['name' => 'Icelandair']);
        $airline_data = App\AirlineData::create(['name' => 'IndiGo Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'InterJet']);

        $airline_data = App\AirlineData::create(['name' => 'Japan Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Jeju Air']);
        $airline_data = App\AirlineData::create(['name' => 'Jet Airways']);
        $airline_data = App\AirlineData::create(['name' => 'Jet2']);
        $airline_data = App\AirlineData::create(['name' => 'JetBlue']);
        $airline_data = App\AirlineData::create(['name' => 'Jetstar']);

        $airline_data = App\AirlineData::create(['name' => 'Kenya Airways']);
        $airline_data = App\AirlineData::create(['name' => 'KLM']);
        $airline_data = App\AirlineData::create(['name' => 'Korean Air']);

        $airline_data = App\AirlineData::create(['name' => 'La Compagnie']);
        $airline_data = App\AirlineData::create(['name' => 'LATAM Brasil']);
        $airline_data = App\AirlineData::create(['name' => 'LATAM Chile']);
        $airline_data = App\AirlineData::create(['name' => 'Lion Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'LOT Polish Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Lufthansa']);

        $airline_data = App\AirlineData::create(['name' => 'Malaysia Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Middle East Airlines']);

        $airline_data = App\AirlineData::create(['name' => 'Nok Air']);
        $airline_data = App\AirlineData::create(['name' => 'Nordwind Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Norwegian Air Shuttle']);

        $airline_data = App\AirlineData::create(['name' => 'Oman Air']);

        $airline_data = App\AirlineData::create(['name' => 'Pakistan International Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Peach']);
        $airline_data = App\AirlineData::create(['name' => 'Pegasus Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Philippine Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Porter']);

        $airline_data = App\AirlineData::create(['name' => 'Qantas']);
        $airline_data = App\AirlineData::create(['name' => 'Qatar Airways']);

        $airline_data = App\AirlineData::create(['name' => 'Regional Express']);
        $airline_data = App\AirlineData::create(['name' => 'Rossiya - Russian Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Royal Air Maroc']);
        $airline_data = App\AirlineData::create(['name' => 'Royal Brunei']);
        $airline_data = App\AirlineData::create(['name' => 'Royal Jordanian']);
        $airline_data = App\AirlineData::create(['name' => 'Ryanair']);

        $airline_data = App\AirlineData::create(['name' => 'S7 Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'SAS']);
        $airline_data = App\AirlineData::create(['name' => 'Saudia']);
        $airline_data = App\AirlineData::create(['name' => 'Scoot Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Shanghai Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Silkair']);
        $airline_data = App\AirlineData::create(['name' => 'Singapore Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Skylanes']);
        $airline_data = App\AirlineData::create(['name' => 'South African Airways']);
        $airline_data = App\AirlineData::create(['name' => 'Southwest']);
        $airline_data = App\AirlineData::create(['name' => 'SpiceJet']);
        $airline_data = App\AirlineData::create(['name' => 'Spirit']);
        $airline_data = App\AirlineData::create(['name' => 'Spring Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Spring Japan']);
        $airline_data = App\AirlineData::create(['name' => 'SriLankan Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Sun Country']);
        $airline_data = App\AirlineData::create(['name' => 'Sunwing']);
        $airline_data = App\AirlineData::create(['name' => 'SWISS']);
        $airline_data = App\AirlineData::create(['name' => 'Swoop']);

        $airline_data = App\AirlineData::create(['name' => 'TAAG']);
        $airline_data = App\AirlineData::create(['name' => 'TACA']);
        $airline_data = App\AirlineData::create(['name' => 'TAP Portugal']);
        $airline_data = App\AirlineData::create(['name' => 'THAI']);
        $airline_data = App\AirlineData::create(['name' => 'Thomas Cook Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Thomson']);
        $airline_data = App\AirlineData::create(['name' => 'tigerair Australia']);
        $airline_data = App\AirlineData::create(['name' => 'Transavia Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'TUIfly']);
        $airline_data = App\AirlineData::create(['name' => 'Tunis Air']);
        $airline_data = App\AirlineData::create(['name' => 'Turkish Airlines']);

        $airline_data = App\AirlineData::create(['name' => 'Ukraine International']);
        $airline_data = App\AirlineData::create(['name' => 'United']);
        $airline_data = App\AirlineData::create(['name' => 'UTair Aviation']);

        $airline_data = App\AirlineData::create(['name' => 'Vanilla Air']);
        $airline_data = App\AirlineData::create(['name' => 'Vietnam Airlines']);
        $airline_data = App\AirlineData::create(['name' => 'Virgin Atlantic']);
        $airline_data = App\AirlineData::create(['name' => 'Virgin Australia']);
        $airline_data = App\AirlineData::create(['name' => 'Vistara']);
        $airline_data = App\AirlineData::create(['name' => 'Viva Aerobus']);
        $airline_data = App\AirlineData::create(['name' => 'Volaris']);
        $airline_data = App\AirlineData::create(['name' => 'Volotea']);
        $airline_data = App\AirlineData::create(['name' => 'Vueling Airlines']);

        $airline_data = App\AirlineData::create(['name' => 'WestJet']);
        $airline_data = App\AirlineData::create(['name' => 'Wizzair']);

        $airline_data = App\AirlineData::create(['name' => 'Xiamen Airlines']);

    }
}
