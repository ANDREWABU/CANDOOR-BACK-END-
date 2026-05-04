<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SignUpJoiningReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::table('signup_joining_reasons')->insert(array (
            0 => 
            array (
                'id' => 1,
            'name' => 'Figuring out out which roles, industries, or companies would be a good start for my caree',
                'tool_tip' => 'Figuring out out which roles, industries, or companies would be a good start for my caree',
            ),
            1 => 
            array (
                'id' => 2,
            'name' => 'Landing my first full time role or internship',
                'tool_tip' => 'Landing my first full time role or internship',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Determining a fulfilling, long-term career plan',
                'tool_tip' => 'Determining a fulfilling, long-term career plan',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Pivoting into a new career',
                'tool_tip' => 'Pivoting into a new career.',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Excelling in my current role',
                'tool_tip' => 'Excelling in my current role',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Starting a company or business',
                'tool_tip' => 'Starting a company or business',
            ),
            6 => 
            array (
                'id' => 7,
            'name' => 'Applying to graduate school',
                'tool_tip' => 'Applying to graduate school',
            ),
            7 => 
            array (
                'id' => 8,
            'name' => 'Finding mentors to support me throughout my career',
                'tool_tip' => 'Finding mentors to support me throughout my career',
            ),
            8 => 
            array (
                'id' => 9,
            'name' => 'Developing personally and professionally',
                'tool_tip' => 'Developing personally and professionally',
            ),
        ));
        
    }
}
