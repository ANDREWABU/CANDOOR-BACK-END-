<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferralCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('referral_codes')->delete();
        
        \DB::table('referral_codes')->insert(array (
            0 => 
            array (
                'code' => 'THEORG',
                'comments' => 'Code for Employees from the ORG',
                'creation_date' => NULL,
                'id' => 1,
            ),
            1 => 
            array (
                'code' => 'PL1',
                'comments' => 'Code for first wave of users',
                'creation_date' => NULL,
                'id' => 2,
            ),
            2 => 
            array (
                'code' => 'PL2',
                'comments' => 'Code for second wave of users',
                'creation_date' => NULL,
                'id' => 3,
            ),
            3 => 
            array (
                'code' => 'PL3',
                'comments' => 'Code for third wave of users',
                'creation_date' => NULL,
                'id' => 4,
            ),
            4 => 
            array (
                'code' => 'PL3R',
                'comments' => 'Code for referrals for third wave of users',
                'creation_date' => NULL,
                'id' => 5,
            ),
            5 => 
            array (
                'code' => 'blacksis',
                'comments' => 'Code for third wave of users',
                'creation_date' => NULL,
                'id' => 6,
            ),
            6 => 
            array (
                'code' => 'Accessibe',
                'comments' => 'Code for accessibility vendor Accessibe',
                'creation_date' => NULL,
                'id' => 7,
            ),
            7 => 
            array (
                'code' => 'Accessibe',
                'comments' => 'Code for other accessibility vendors',
                'creation_date' => NULL,
                'id' => 8,
            ),
            8 => 
            array (
                'code' => 'ASUTest',
                'comments' => 'Code for ASU admin testers',
                'creation_date' => NULL,
                'id' => 9,
            )
        ));
    }
}