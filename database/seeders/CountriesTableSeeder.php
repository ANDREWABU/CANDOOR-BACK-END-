<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'name' => 'United States',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'name' => 'Afghanistan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'name' => 'Aland Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'name' => 'Albania',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'name' => 'Algeria',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
                'name' => 'American Samoa',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'id' => 7,
                'name' => 'Andorra',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'id' => 8,
                'name' => 'Angola',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'id' => 9,
                'name' => 'Anguilla',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'id' => 10,
                'name' => 'Antarctica',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => NULL,
                'id' => 11,
                'name' => 'Antigua and Barbuda',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => NULL,
                'id' => 12,
                'name' => 'Argentina',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'created_at' => NULL,
                'id' => 13,
                'name' => 'Armenia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'created_at' => NULL,
                'id' => 14,
                'name' => 'Aruba',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'created_at' => NULL,
                'id' => 15,
                'name' => 'Australia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'created_at' => NULL,
                'id' => 16,
                'name' => 'Austria',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'created_at' => NULL,
                'id' => 17,
                'name' => 'Azerbaijan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'created_at' => NULL,
                'id' => 18,
                'name' => 'Bahamas',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'created_at' => NULL,
                'id' => 19,
                'name' => 'Bahrain',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'created_at' => NULL,
                'id' => 20,
                'name' => 'Bangladesh',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'created_at' => NULL,
                'id' => 21,
                'name' => 'Barbados',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'created_at' => NULL,
                'id' => 22,
                'name' => 'Belarus',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'created_at' => NULL,
                'id' => 23,
                'name' => 'Belgium',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'created_at' => NULL,
                'id' => 24,
                'name' => 'Belize',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'created_at' => NULL,
                'id' => 25,
                'name' => 'Benin',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'created_at' => NULL,
                'id' => 26,
                'name' => 'Bermuda',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'created_at' => NULL,
                'id' => 27,
                'name' => 'Bhutan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'created_at' => NULL,
                'id' => 28,
            'name' => 'Bolivia (Plurinational State of)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'created_at' => NULL,
                'id' => 29,
                'name' => 'Bonaire, Sint Eustatius and Saba',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'created_at' => NULL,
                'id' => 30,
                'name' => 'Bosnia and Herzegovina',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'created_at' => NULL,
                'id' => 31,
                'name' => 'Botswana',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'created_at' => NULL,
                'id' => 32,
                'name' => 'Bouvet Island',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'created_at' => NULL,
                'id' => 33,
                'name' => 'Brazil',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'created_at' => NULL,
                'id' => 34,
                'name' => 'British Indian Ocean Territory',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'created_at' => NULL,
                'id' => 35,
                'name' => 'Brunei Darussalam',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'created_at' => NULL,
                'id' => 36,
                'name' => 'Bulgaria',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'created_at' => NULL,
                'id' => 37,
                'name' => 'Burkina Faso',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'created_at' => NULL,
                'id' => 38,
                'name' => 'Burundi',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'created_at' => NULL,
                'id' => 39,
                'name' => 'Cabo Verde',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'created_at' => NULL,
                'id' => 40,
                'name' => 'Cambodia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'created_at' => NULL,
                'id' => 41,
                'name' => 'Cameroon',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'created_at' => NULL,
                'id' => 42,
                'name' => 'Canada',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'created_at' => NULL,
                'id' => 43,
                'name' => 'Cayman Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'created_at' => NULL,
                'id' => 44,
                'name' => 'Central African Republic',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'created_at' => NULL,
                'id' => 45,
                'name' => 'Chad',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'created_at' => NULL,
                'id' => 46,
                'name' => 'Chile',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'created_at' => NULL,
                'id' => 47,
                'name' => 'China',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'created_at' => NULL,
                'id' => 48,
                'name' => 'Christmas Island',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'created_at' => NULL,
                'id' => 49,
            'name' => 'Cocos (Keeling) Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'created_at' => NULL,
                'id' => 50,
                'name' => 'Colombia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'created_at' => NULL,
                'id' => 51,
                'name' => 'Comoros',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'created_at' => NULL,
                'id' => 52,
                'name' => 'Congo',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'created_at' => NULL,
                'id' => 53,
                'name' => 'Congo, Democratic Republic of the',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'created_at' => NULL,
                'id' => 54,
                'name' => 'Cook Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'created_at' => NULL,
                'id' => 55,
                'name' => 'Costa Rica',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'created_at' => NULL,
                'id' => 56,
                'name' => 'C√¥te dIvoire',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'created_at' => NULL,
                'id' => 57,
                'name' => 'Croatia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'created_at' => NULL,
                'id' => 58,
                'name' => 'Cuba',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'created_at' => NULL,
                'id' => 59,
                'name' => 'Cura√ßao',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'created_at' => NULL,
                'id' => 60,
                'name' => 'Cyprus',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'created_at' => NULL,
                'id' => 61,
                'name' => 'Czechia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'created_at' => NULL,
                'id' => 62,
                'name' => 'Denmark',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'created_at' => NULL,
                'id' => 63,
                'name' => 'Djibouti',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'created_at' => NULL,
                'id' => 64,
                'name' => 'Dominica',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'created_at' => NULL,
                'id' => 65,
                'name' => 'Dominican Republic',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'created_at' => NULL,
                'id' => 66,
                'name' => 'Ecuador',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'created_at' => NULL,
                'id' => 67,
                'name' => 'Egypt',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'created_at' => NULL,
                'id' => 68,
                'name' => 'El Salvador',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'created_at' => NULL,
                'id' => 69,
                'name' => 'Equatorial Guinea',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'created_at' => NULL,
                'id' => 70,
                'name' => 'Eritrea',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'created_at' => NULL,
                'id' => 71,
                'name' => 'Estonia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'created_at' => NULL,
                'id' => 72,
                'name' => 'Eswatini',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'created_at' => NULL,
                'id' => 73,
                'name' => 'Ethiopia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'created_at' => NULL,
                'id' => 74,
            'name' => 'Falkland Islands (Malvinas)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'created_at' => NULL,
                'id' => 75,
                'name' => 'Faroe Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'created_at' => NULL,
                'id' => 76,
                'name' => 'Fiji',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'created_at' => NULL,
                'id' => 77,
                'name' => 'Finland',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'created_at' => NULL,
                'id' => 78,
                'name' => 'France',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'created_at' => NULL,
                'id' => 79,
                'name' => 'French Guiana',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'created_at' => NULL,
                'id' => 80,
                'name' => 'French Polynesia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'created_at' => NULL,
                'id' => 81,
                'name' => 'French Southern Territories',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'created_at' => NULL,
                'id' => 82,
                'name' => 'Gabon',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'created_at' => NULL,
                'id' => 83,
                'name' => 'Gambia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'created_at' => NULL,
                'id' => 84,
                'name' => 'Georgia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'created_at' => NULL,
                'id' => 85,
                'name' => 'Germany',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'created_at' => NULL,
                'id' => 86,
                'name' => 'Ghana',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'created_at' => NULL,
                'id' => 87,
                'name' => 'Gibraltar',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'created_at' => NULL,
                'id' => 88,
                'name' => 'Greece',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'created_at' => NULL,
                'id' => 89,
                'name' => 'Greenland',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'created_at' => NULL,
                'id' => 90,
                'name' => 'Grenada',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'created_at' => NULL,
                'id' => 91,
                'name' => 'Guadeloupe',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'created_at' => NULL,
                'id' => 92,
                'name' => 'Guam',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'created_at' => NULL,
                'id' => 93,
                'name' => 'Guatemala',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'created_at' => NULL,
                'id' => 94,
                'name' => 'Guernsey',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'created_at' => NULL,
                'id' => 95,
                'name' => 'Guinea',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'created_at' => NULL,
                'id' => 96,
                'name' => 'Guinea-Bissau',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'created_at' => NULL,
                'id' => 97,
                'name' => 'Guyana',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'created_at' => NULL,
                'id' => 98,
                'name' => 'Haiti',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'created_at' => NULL,
                'id' => 99,
                'name' => 'Heard Island and McDonald Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'created_at' => NULL,
                'id' => 100,
                'name' => 'Holy See',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'created_at' => NULL,
                'id' => 101,
                'name' => 'Honduras',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'created_at' => NULL,
                'id' => 102,
                'name' => 'Hong Kong',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'created_at' => NULL,
                'id' => 103,
                'name' => 'Hungary',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'created_at' => NULL,
                'id' => 104,
                'name' => 'Iceland',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'created_at' => NULL,
                'id' => 105,
                'name' => 'India',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'created_at' => NULL,
                'id' => 106,
                'name' => 'Indonesia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'created_at' => NULL,
                'id' => 107,
            'name' => 'Iran (Islamic Republic of)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'created_at' => NULL,
                'id' => 108,
                'name' => 'Iraq',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'created_at' => NULL,
                'id' => 109,
                'name' => 'Ireland',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'created_at' => NULL,
                'id' => 110,
                'name' => 'Isle of Man',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'created_at' => NULL,
                'id' => 111,
                'name' => 'Israel',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'created_at' => NULL,
                'id' => 112,
                'name' => 'Italy',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'created_at' => NULL,
                'id' => 113,
                'name' => 'Jamaica',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'created_at' => NULL,
                'id' => 114,
                'name' => 'Japan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'created_at' => NULL,
                'id' => 115,
                'name' => 'Jersey',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'created_at' => NULL,
                'id' => 116,
                'name' => 'Jordan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'created_at' => NULL,
                'id' => 117,
                'name' => 'Kazakhstan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'created_at' => NULL,
                'id' => 118,
                'name' => 'Kenya',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'created_at' => NULL,
                'id' => 119,
                'name' => 'Kiribati',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'created_at' => NULL,
                'id' => 120,
            'name' => 'Korea (Democratic Peoples Republic of)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'created_at' => NULL,
                'id' => 121,
                'name' => 'Korea, Republic of',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'created_at' => NULL,
                'id' => 122,
                'name' => 'Kuwait',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'created_at' => NULL,
                'id' => 123,
                'name' => 'Kyrgyzstan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            123 => 
            array (
                'created_at' => NULL,
                'id' => 124,
                'name' => 'Lao Peoples Democratic Republic',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            124 => 
            array (
                'created_at' => NULL,
                'id' => 125,
                'name' => 'Latvia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'created_at' => NULL,
                'id' => 126,
                'name' => 'Lebanon',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'created_at' => NULL,
                'id' => 127,
                'name' => 'Lesotho',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'created_at' => NULL,
                'id' => 128,
                'name' => 'Liberia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'created_at' => NULL,
                'id' => 129,
                'name' => 'Libya',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'created_at' => NULL,
                'id' => 130,
                'name' => 'Liechtenstein',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'created_at' => NULL,
                'id' => 131,
                'name' => 'Lithuania',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'created_at' => NULL,
                'id' => 132,
                'name' => 'Luxembourg',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'created_at' => NULL,
                'id' => 133,
                'name' => 'Macao',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            133 => 
            array (
                'created_at' => NULL,
                'id' => 134,
                'name' => 'Madagascar',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            134 => 
            array (
                'created_at' => NULL,
                'id' => 135,
                'name' => 'Malawi',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'created_at' => NULL,
                'id' => 136,
                'name' => 'Malaysia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'created_at' => NULL,
                'id' => 137,
                'name' => 'Maldives',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'created_at' => NULL,
                'id' => 138,
                'name' => 'Mali',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'created_at' => NULL,
                'id' => 139,
                'name' => 'Malta',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            139 => 
            array (
                'created_at' => NULL,
                'id' => 140,
                'name' => 'Marshall Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            140 => 
            array (
                'created_at' => NULL,
                'id' => 141,
                'name' => 'Martinique',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            141 => 
            array (
                'created_at' => NULL,
                'id' => 142,
                'name' => 'Mauritania',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            142 => 
            array (
                'created_at' => NULL,
                'id' => 143,
                'name' => 'Mauritius',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            143 => 
            array (
                'created_at' => NULL,
                'id' => 144,
                'name' => 'Mayotte',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            144 => 
            array (
                'created_at' => NULL,
                'id' => 145,
                'name' => 'Mexico',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            145 => 
            array (
                'created_at' => NULL,
                'id' => 146,
            'name' => 'Micronesia (Federated States of)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            146 => 
            array (
                'created_at' => NULL,
                'id' => 147,
                'name' => 'Moldova, Republic of',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            147 => 
            array (
                'created_at' => NULL,
                'id' => 148,
                'name' => 'Monaco',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            148 => 
            array (
                'created_at' => NULL,
                'id' => 149,
                'name' => 'Mongolia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            149 => 
            array (
                'created_at' => NULL,
                'id' => 150,
                'name' => 'Montenegro',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            150 => 
            array (
                'created_at' => NULL,
                'id' => 151,
                'name' => 'Montserrat',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            151 => 
            array (
                'created_at' => NULL,
                'id' => 152,
                'name' => 'Morocco',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            152 => 
            array (
                'created_at' => NULL,
                'id' => 153,
                'name' => 'Mozambique',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            153 => 
            array (
                'created_at' => NULL,
                'id' => 154,
                'name' => 'Myanmar',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            154 => 
            array (
                'created_at' => NULL,
                'id' => 155,
                'name' => 'Namibia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            155 => 
            array (
                'created_at' => NULL,
                'id' => 156,
                'name' => 'Nauru',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            156 => 
            array (
                'created_at' => NULL,
                'id' => 157,
                'name' => 'Nepal',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            157 => 
            array (
                'created_at' => NULL,
                'id' => 158,
                'name' => 'Netherlands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            158 => 
            array (
                'created_at' => NULL,
                'id' => 159,
                'name' => 'New Caledonia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            159 => 
            array (
                'created_at' => NULL,
                'id' => 160,
                'name' => 'New Zealand',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            160 => 
            array (
                'created_at' => NULL,
                'id' => 161,
                'name' => 'Nicaragua',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            161 => 
            array (
                'created_at' => NULL,
                'id' => 162,
                'name' => 'Niger',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            162 => 
            array (
                'created_at' => NULL,
                'id' => 163,
                'name' => 'Nigeria',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            163 => 
            array (
                'created_at' => NULL,
                'id' => 164,
                'name' => 'Niue',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            164 => 
            array (
                'created_at' => NULL,
                'id' => 165,
                'name' => 'Norfolk Island',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            165 => 
            array (
                'created_at' => NULL,
                'id' => 166,
                'name' => 'North Macedonia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            166 => 
            array (
                'created_at' => NULL,
                'id' => 167,
                'name' => 'Northern Mariana Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            167 => 
            array (
                'created_at' => NULL,
                'id' => 168,
                'name' => 'Norway',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            168 => 
            array (
                'created_at' => NULL,
                'id' => 169,
                'name' => 'Oman',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            169 => 
            array (
                'created_at' => NULL,
                'id' => 170,
                'name' => 'Pakistan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            170 => 
            array (
                'created_at' => NULL,
                'id' => 171,
                'name' => 'Palau',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            171 => 
            array (
                'created_at' => NULL,
                'id' => 172,
                'name' => 'Palestine, State of',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            172 => 
            array (
                'created_at' => NULL,
                'id' => 173,
                'name' => 'Panama',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            173 => 
            array (
                'created_at' => NULL,
                'id' => 174,
                'name' => 'Papua New Guinea',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            174 => 
            array (
                'created_at' => NULL,
                'id' => 175,
                'name' => 'Paraguay',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            175 => 
            array (
                'created_at' => NULL,
                'id' => 176,
                'name' => 'Peru',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            176 => 
            array (
                'created_at' => NULL,
                'id' => 177,
                'name' => 'Philippines',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            177 => 
            array (
                'created_at' => NULL,
                'id' => 178,
                'name' => 'Pitcairn',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            178 => 
            array (
                'created_at' => NULL,
                'id' => 179,
                'name' => 'Poland',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            179 => 
            array (
                'created_at' => NULL,
                'id' => 180,
                'name' => 'Portugal',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            180 => 
            array (
                'created_at' => NULL,
                'id' => 181,
                'name' => 'Puerto Rico',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            181 => 
            array (
                'created_at' => NULL,
                'id' => 182,
                'name' => 'Qatar',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            182 => 
            array (
                'created_at' => NULL,
                'id' => 183,
                'name' => 'R√©union',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            183 => 
            array (
                'created_at' => NULL,
                'id' => 184,
                'name' => 'Romania',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            184 => 
            array (
                'created_at' => NULL,
                'id' => 185,
                'name' => 'Russian Federation',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            185 => 
            array (
                'created_at' => NULL,
                'id' => 186,
                'name' => 'Rwanda',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            186 => 
            array (
                'created_at' => NULL,
                'id' => 187,
                'name' => 'Saint Barth√©lemy',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            187 => 
            array (
                'created_at' => NULL,
                'id' => 188,
                'name' => 'Saint Helena, Ascension and Tristan da Cunha',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            188 => 
            array (
                'created_at' => NULL,
                'id' => 189,
                'name' => 'Saint Kitts and Nevis',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            189 => 
            array (
                'created_at' => NULL,
                'id' => 190,
                'name' => 'Saint Lucia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            190 => 
            array (
                'created_at' => NULL,
                'id' => 191,
            'name' => 'Saint Martin (French part)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            191 => 
            array (
                'created_at' => NULL,
                'id' => 192,
                'name' => 'Saint Pierre and Miquelon',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            192 => 
            array (
                'created_at' => NULL,
                'id' => 193,
                'name' => 'Saint Vincent and the Grenadines',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            193 => 
            array (
                'created_at' => NULL,
                'id' => 194,
                'name' => 'Samoa',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            194 => 
            array (
                'created_at' => NULL,
                'id' => 195,
                'name' => 'San Marino',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            195 => 
            array (
                'created_at' => NULL,
                'id' => 196,
                'name' => 'Sao Tome and Principe',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            196 => 
            array (
                'created_at' => NULL,
                'id' => 197,
                'name' => 'Saudi Arabia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            197 => 
            array (
                'created_at' => NULL,
                'id' => 198,
                'name' => 'Senegal',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            198 => 
            array (
                'created_at' => NULL,
                'id' => 199,
                'name' => 'Serbia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            199 => 
            array (
                'created_at' => NULL,
                'id' => 200,
                'name' => 'Seychelles',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            200 => 
            array (
                'created_at' => NULL,
                'id' => 201,
                'name' => 'Sierra Leone',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            201 => 
            array (
                'created_at' => NULL,
                'id' => 202,
                'name' => 'Singapore',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            202 => 
            array (
                'created_at' => NULL,
                'id' => 203,
            'name' => 'Sint Maarten (Dutch part)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            203 => 
            array (
                'created_at' => NULL,
                'id' => 204,
                'name' => 'Slovakia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            204 => 
            array (
                'created_at' => NULL,
                'id' => 205,
                'name' => 'Slovenia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            205 => 
            array (
                'created_at' => NULL,
                'id' => 206,
                'name' => 'Solomon Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            206 => 
            array (
                'created_at' => NULL,
                'id' => 207,
                'name' => 'Somalia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            207 => 
            array (
                'created_at' => NULL,
                'id' => 208,
                'name' => 'South Africa',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            208 => 
            array (
                'created_at' => NULL,
                'id' => 209,
                'name' => 'South Georgia and the South Sandwich Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            209 => 
            array (
                'created_at' => NULL,
                'id' => 210,
                'name' => 'South Sudan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            210 => 
            array (
                'created_at' => NULL,
                'id' => 211,
                'name' => 'Spain',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            211 => 
            array (
                'created_at' => NULL,
                'id' => 212,
                'name' => 'Sri Lanka',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            212 => 
            array (
                'created_at' => NULL,
                'id' => 213,
                'name' => 'Sudan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            213 => 
            array (
                'created_at' => NULL,
                'id' => 214,
                'name' => 'Suriname',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            214 => 
            array (
                'created_at' => NULL,
                'id' => 215,
                'name' => 'Svalbard and Jan Mayen',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            215 => 
            array (
                'created_at' => NULL,
                'id' => 216,
                'name' => 'Sweden',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            216 => 
            array (
                'created_at' => NULL,
                'id' => 217,
                'name' => 'Switzerland',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            217 => 
            array (
                'created_at' => NULL,
                'id' => 218,
                'name' => 'Syrian Arab Republic',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            218 => 
            array (
                'created_at' => NULL,
                'id' => 219,
                'name' => 'Taiwan, Province of China',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            219 => 
            array (
                'created_at' => NULL,
                'id' => 220,
                'name' => 'Tajikistan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            220 => 
            array (
                'created_at' => NULL,
                'id' => 221,
                'name' => 'Tanzania, United Republic of',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            221 => 
            array (
                'created_at' => NULL,
                'id' => 222,
                'name' => 'Thailand',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            222 => 
            array (
                'created_at' => NULL,
                'id' => 223,
                'name' => 'Timor-Leste',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            223 => 
            array (
                'created_at' => NULL,
                'id' => 224,
                'name' => 'Togo',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            224 => 
            array (
                'created_at' => NULL,
                'id' => 225,
                'name' => 'Tokelau',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            225 => 
            array (
                'created_at' => NULL,
                'id' => 226,
                'name' => 'Tonga',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            226 => 
            array (
                'created_at' => NULL,
                'id' => 227,
                'name' => 'Trinidad and Tobago',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            227 => 
            array (
                'created_at' => NULL,
                'id' => 228,
                'name' => 'Tunisia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            228 => 
            array (
                'created_at' => NULL,
                'id' => 229,
                'name' => 'Turkey',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            229 => 
            array (
                'created_at' => NULL,
                'id' => 230,
                'name' => 'Turkmenistan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            230 => 
            array (
                'created_at' => NULL,
                'id' => 231,
                'name' => 'Turks and Caicos Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            231 => 
            array (
                'created_at' => NULL,
                'id' => 232,
                'name' => 'Tuvalu',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            232 => 
            array (
                'created_at' => NULL,
                'id' => 233,
                'name' => 'Uganda',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            233 => 
            array (
                'created_at' => NULL,
                'id' => 234,
                'name' => 'Ukraine',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            234 => 
            array (
                'created_at' => NULL,
                'id' => 235,
                'name' => 'United Arab Emirates',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            235 => 
            array (
                'created_at' => NULL,
                'id' => 236,
                'name' => 'United Kingdom of Great Britain and Northern Ireland',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            236 => 
            array (
                'created_at' => NULL,
                'id' => 237,
                'name' => 'United States Minor Outlying Islands',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            237 => 
            array (
                'created_at' => NULL,
                'id' => 238,
                'name' => 'Uruguay',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            238 => 
            array (
                'created_at' => NULL,
                'id' => 239,
                'name' => 'Uzbekistan',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            239 => 
            array (
                'created_at' => NULL,
                'id' => 240,
                'name' => 'Vanuatu',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            240 => 
            array (
                'created_at' => NULL,
                'id' => 241,
            'name' => 'Venezuela (Bolivarian Republic of)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            241 => 
            array (
                'created_at' => NULL,
                'id' => 242,
                'name' => 'Viet Nam',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            242 => 
            array (
                'created_at' => NULL,
                'id' => 243,
            'name' => 'Virgin Islands (British)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            243 => 
            array (
                'created_at' => NULL,
                'id' => 244,
            'name' => 'Virgin Islands (U.S.)',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            244 => 
            array (
                'created_at' => NULL,
                'id' => 245,
                'name' => 'Wallis and Futuna',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            245 => 
            array (
                'created_at' => NULL,
                'id' => 246,
                'name' => 'Western Sahara',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            246 => 
            array (
                'created_at' => NULL,
                'id' => 247,
                'name' => 'Yemen',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            247 => 
            array (
                'created_at' => NULL,
                'id' => 248,
                'name' => 'Zambia',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
            248 => 
            array (
                'created_at' => NULL,
                'id' => 249,
                'name' => 'Zimbabwe',
                'phone_code' => NULL,
                'sort_name' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}