<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TimeZonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('time_zones')->delete();
        
        \DB::table('time_zones')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
            'key' => 'Greenwich Mean Time (GMT)',
            'name' => 'Greenwich Mean Time (GMT)',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
            'key' => 'Universal Coordinated Time	(UTC)',
            'name' => 'Universal Coordinated Time	(UTC) GMT+0',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'key' => 'Europe/Berlin',
            'name' => 'Central European Summer Time (CEST)',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'key' => 'Europe/Riga',
            'name' => 'Eastern European Time (EET) GMT+2:00',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'key' => 'Egypt',
            'name' => 'Eastern European Time (EET)',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
                'key' => 'Africa/Djibouti',
            'name' => 'Eastern African Time (EAT)',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'id' => 7,
                'key' => 'Iran',
            'name' => 'Middle East Time (MET)',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'id' => 8,
                'key' => 'Europe/Astrakhan',
            'name' => 'Near East Time (NET) GMT+4:00',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'id' => 9,
                'key' => 'Asia/Samarkand',
            'name' => 'Pakistan Lahore Time (PLT) GMT+5:00',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'id' => 10,
                'key' => 'Asia/Kolkata',
            'name' => 'India Standard Time (NET)',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => NULL,
                'id' => 11,
                'key' => 'Asia/Dhaka',
            'name' => 'Bangladesh Standard Time (BST) GMT+6:00',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => NULL,
                'id' => 12,
                'key' => 'Asia/Bangkok',
            'name' => 'Vietnam Standard Time (VST) GMT+7:00',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'created_at' => NULL,
                'id' => 13,
                'key' => 'Asia/Taipei',
            'name' => 'China Taiwan Time (CTT) GMT+8:00',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'created_at' => NULL,
                'id' => 14,
                'key' => 'Japan',
            'name' => 'Japan Standard Time (JST) GMT+9:00',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'created_at' => NULL,
                'id' => 15,
                'key' => 'Australia/Yancowinna',
            'name' => 'Australia Central Time (ACT) GMT+9:30',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'created_at' => NULL,
                'id' => 16,
                'key' => 'Australia/Darwin',
            'name' => 'Australia Eastern Time (AET) GMT+10:00',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'created_at' => NULL,
                'id' => 17,
                'key' => 'Pacific/Kosrae',
            'name' => 'Solomon Standard Time (SST) GMT+11:00',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'created_at' => NULL,
                'id' => 18,
                'key' => 'Pacific/Majuro',
            'name' => 'New Zealand Standard Time (NST) GMT+12:00',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'created_at' => NULL,
                'id' => 19,
                'key' => 'Pacific/Midway',
            'name' => 'Midway Islands Time (MIT) GMT-11:00',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'created_at' => NULL,
                'id' => 20,
                'key' => 'US/Hawaii',
            'name' => 'Hawaii Standard Time (HST) GMT-10:00',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'created_at' => NULL,
                'id' => 21,
                'key' => 'US/Alaska',
            'name' => 'Alaska Standard Time (AST) GMT-9:00',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'created_at' => NULL,
                'id' => 22,
                'key' => 'US/Pacific',
            'name' => 'Pacific Time (PT)',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'created_at' => NULL,
                'id' => 23,
                'key' => 'America/Mazatlan',
            'name' => 'Phoenix Standard Time (PNT)',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'created_at' => NULL,
                'id' => 24,
                'key' => 'US/Mountain',
            'name' => 'Mountain Time (MT)',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'created_at' => NULL,
                'id' => 25,
                'key' => 'US/Central',
            'name' => 'Central Time (CT)',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'created_at' => NULL,
                'id' => 26,
                'key' => 'US/Eastern',
            'name' => 'Eastern Time (ET)',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'created_at' => NULL,
                'id' => 27,
                'key' => 'America/Indiana/Indianapolis',
            'name' => 'Indiana Eastern Standard Time (IET) GMT-5:00',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'created_at' => NULL,
                'id' => 28,
                'key' => 'America/Puerto_Rico',
            'name' => 'Puerto Rico and US Virgin Islands Time (PRT)',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'created_at' => NULL,
                'id' => 29,
                'key' => 'Canada/Newfoundland',
            'name' => 'Canada Newfoundland Time (CNT) GMT-3:30',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'created_at' => NULL,
                'id' => 30,
                'key' => 'America/Argentina/Buenos_Aires',
            'name' => 'Argentina Standard Time (AGT) GMT-3:00',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'created_at' => NULL,
                'id' => 31,
                'key' => 'Brazil/East',
            'name' => 'Brazil Eastern Time (BET)',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'created_at' => NULL,
                'id' => 32,
                'key' => 'Europe/Riga',
            'name' => 'Central African Time (CAT)',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}