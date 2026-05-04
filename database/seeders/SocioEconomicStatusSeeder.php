<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SocioEconomicStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('socio_economic_status')->delete();
        \DB::table('socio_economic_status')->insert(array (

            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'socio_economic_status' => 'A first-generation college student',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'socio_economic_status' => 'From a low-income family (e.g. Pell Grant Eligible)',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'socio_economic_status' => 'A member or former member of the U.S. Armed Forces',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'socio_economic_status' => 'LGBTQ+',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'socio_economic_status' => 'A person with a disablilty or disablilties',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
                'socio_economic_status' => 'Prefer not to answer',
                'updated_at' => NULL,
            )
        ));
    }
}
