<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GenderIdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('gender_identity')->delete();
        \DB::table('gender_identity')->insert(array (

            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'gender_identity' => 'Woman',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'gender_identity' => 'Man',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'gender_identity' => 'Non-binary',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'gender_identity' => 'Transgender/Trans woman',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'gender_identity' => 'Transgender/Trans man',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
                'gender_identity' => 'Other',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'id' => 7,
                'gender_identity' => 'Prefer not to answer',
                'updated_at' => NULL,
            ),
        ));
    }
}
