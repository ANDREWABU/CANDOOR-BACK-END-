<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HighestDegreeCompletedsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('highest_degree_completeds')->delete();
        
        \DB::table('highest_degree_completeds')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'name' => 'Grades 1 through 11',
                'Slug' => 'Grades 1 through 11',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'name' => '12th grade - no diploma',
                'Slug' => '12th grade - no diploma',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'name' => 'Regular high school diploma',
                'Slug' => 'Regular high school diploma',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'name' => 'GED or alternative credential',
                'Slug' => 'GED or alternative credential',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'name' => 'Some college credit, no degree',
                'Slug' => 'Some college credit, no degree',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
            'name' => 'Associates degree, occupational (e.g., AAS, AAA, AOS)',
            'Slug' => 'Associate’s degree, occupational (e.g., AAS, AAA, AOS)',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            6 => 
            array (
                'created_at' => NULL,
                'id' => 7,
            'name' => 'Associates degree, academic (e.g., AA, AS)',
            'Slug' => 'Associate’s degree, academic (e.g., AA, AS)',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            7 => 
            array (
                'created_at' => NULL,
                'id' => 8,
            'name' => 'Bachelors degree (e.g., BA, BS)',
            'Slug' => 'Bachelor’s degree (e.g., BA, BS)',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            8 => 
            array (
                'created_at' => NULL,
                'id' => 9,
            'name' => 'Master’s degree (e.g., MA, MS, MBA)',
            'Slug' => 'Master’s degree (e.g., MA, MS, MBA)',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            9 => 
            array (
                'created_at' => NULL,
                'id' => 10,
            'name' => 'Professional degree (e.g., MD, JD)',
            'Slug' => 'Professional degree (e.g., MD, JD)',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
            10 => 
            array (
                'created_at' => NULL,
                'id' => 11,
            'name' => 'Doctorate degree (e.g., PhD, EdD)',
            'Slug' => 'Doctorate degree (e.g., PhD, EdD)',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
        ));
        
        
    }
}