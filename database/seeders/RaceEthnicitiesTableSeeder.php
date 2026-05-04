<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RaceEthnicitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('race_ethnicities')->delete();
        
        \DB::table('race_ethnicities')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'name' => ' American Indian or Alaska Native ',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'name' => ' East Asian ',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'name' => ' South Asian ',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'name' => ' Southeast Asian ',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'name' => ' Black or African American ',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
                'name' => ' Hispanic or Latino ',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'id' => 7,
                'name' => ' Middle Eastern or North African ',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'id' => 8,
                'name' => ' Native Hawaiian or Other Pacific Islander ',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'id' => 9,
                'name' => ' White ',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'id' => 10,
                'name' => ' Other ',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}