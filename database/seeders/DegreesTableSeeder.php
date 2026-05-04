<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DegreesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('degrees')->delete();
        
        \DB::table('degrees')->insert(array (
            0 => 
            array (
                'Created_Date' => NULL,
                'id' => 1,
                'Modified_Date' => NULL,
            'name' => 'Associate of Arts (AA)',
            'Slug' => 'Associate of Arts (AA)',
                'UserID' => '2',
            ),
            1 => 
            array (
                'Created_Date' => NULL,
                'id' => 2,
                'Modified_Date' => NULL,
            'name' => 'Associate of Science (AS)',
            'Slug' => 'Associate of Science (AS)',
                'UserID' => '2',
            ),
            2 => 
            array (
                'Created_Date' => NULL,
                'id' => 3,
                'Modified_Date' => NULL,
            'name' => 'Associate of Applied Science (AAS)',
            'Slug' => 'Associate of Applied Science (AAS)',
                'UserID' => '2',
            ),
            3 => 
            array (
                'Created_Date' => NULL,
                'id' => 4,
                'Modified_Date' => NULL,
            'name' => 'Associate of Applied Arts (AAA)',
            'Slug' => 'Associate of Applied Arts (AAA)',
                'UserID' => '2',
            ),
            4 => 
            array (
                'Created_Date' => NULL,
                'id' => 5,
                'Modified_Date' => NULL,
            'name' => 'Associate of Occupational Students (AOS)',
            'Slug' => 'Associate of Occupational Students (AOS)',
                'UserID' => '2',
            ),
            5 => 
            array (
                'Created_Date' => NULL,
                'id' => 6,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Arts (BA)',
            'Slug' => 'Bachelor of Arts (BA)',
                'UserID' => '2',
            ),
            6 => 
            array (
                'Created_Date' => NULL,
                'id' => 7,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Science (BS)',
            'Slug' => 'Bachelor of Science (BS)',
                'UserID' => '2',
            ),
            7 => 
            array (
                'Created_Date' => NULL,
                'id' => 8,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Fine Arts (BFA)',
            'Slug' => 'Bachelor of Fine Arts (BFA)',
                'UserID' => '2',
            ),
            8 => 
            array (
                'Created_Date' => NULL,
                'id' => 9,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Applied Science (BASc)',
            'Slug' => 'Bachelor of Applied Science (BASc)',
                'UserID' => '2',
            ),
            9 => 
            array (
                'Created_Date' => NULL,
                'id' => 10,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Engineering (BEng)',
            'Slug' => 'Bachelor of Engineering (BEng)',
                'UserID' => '2',
            ),
            10 => 
            array (
                'Created_Date' => NULL,
                'id' => 11,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Business Administration (BBA)',
            'Slug' => 'Bachelor of Business Administration (BBA)',
                'UserID' => '2',
            ),
            11 => 
            array (
                'Created_Date' => NULL,
                'id' => 12,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Laws (LLB)',
            'Slug' => 'Bachelor of Laws (LLB)',
                'UserID' => '2',
            ),
            12 => 
            array (
                'Created_Date' => NULL,
                'id' => 13,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Architecture (BArch)',
            'Slug' => 'Bachelor of Architecture (BArch)',
                'UserID' => '2',
            ),
            13 => 
            array (
                'Created_Date' => NULL,
                'id' => 14,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Commerce (BCom)',
            'Slug' => 'Bachelor of Commerce (BCom)',
                'UserID' => '2',
            ),
            14 => 
            array (
                'Created_Date' => NULL,
                'id' => 15,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Education (BEd)',
            'Slug' => 'Bachelor of Education (BEd)',
                'UserID' => '2',
            ),
            15 => 
            array (
                'Created_Date' => NULL,
                'id' => 16,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Medicine, Bachelor of Surgery (MBBS)',
            'Slug' => 'Bachelor of Medicine, Bachelor of Surgery (MBBS)',
                'UserID' => '2',
            ),
            16 => 
            array (
                'Created_Date' => NULL,
                'id' => 17,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Pharmacy (BPharm)',
            'Slug' => 'Bachelor of Pharmacy (BPharm)',
                'UserID' => '2',
            ),
            17 => 
            array (
                'Created_Date' => NULL,
                'id' => 18,
                'Modified_Date' => NULL,
            'name' => 'Bachelor of Technology (BTech)',
            'Slug' => 'Bachelor of Technology (BTech)',
                'UserID' => '2',
            ),
            18 => 
            array (
                'Created_Date' => NULL,
                'id' => 19,
                'Modified_Date' => NULL,
            'name' => 'Master of Architecture (MArch)',
            'Slug' => 'Master of Architecture (MArch)',
                'UserID' => '2',
            ),
            19 => 
            array (
                'Created_Date' => NULL,
                'id' => 20,
                'Modified_Date' => NULL,
            'name' => 'Master of Arts (MA)',
            'Slug' => 'Master of Arts (MA)',
                'UserID' => '2',
            ),
            20 => 
            array (
                'Created_Date' => NULL,
                'id' => 21,
                'Modified_Date' => NULL,
            'name' => 'Master of Business Administration (MBA)',
            'Slug' => 'Master of Business Administration (MBA)',
                'UserID' => '2',
            ),
            21 => 
            array (
                'Created_Date' => NULL,
                'id' => 22,
                'Modified_Date' => NULL,
            'name' => 'Master of Computer Applications (MCA)',
            'Slug' => 'Master of Computer Applications (MCA)',
                'UserID' => '2',
            ),
            22 => 
            array (
                'Created_Date' => NULL,
                'id' => 23,
                'Modified_Date' => NULL,
            'name' => 'Master of Divinity (MDiv)',
            'Slug' => 'Master of Divinity (MDiv)',
                'UserID' => '2',
            ),
            23 => 
            array (
                'Created_Date' => NULL,
                'id' => 24,
                'Modified_Date' => NULL,
            'name' => 'Master of Education (MEd)',
            'Slug' => 'Master of Education (MEd)',
                'UserID' => '2',
            ),
            24 => 
            array (
                'Created_Date' => NULL,
                'id' => 25,
                'Modified_Date' => NULL,
            'name' => 'Master of Engineering (MEng)',
            'Slug' => 'Master of Engineering (MEng)',
                'UserID' => '2',
            ),
            25 => 
            array (
                'Created_Date' => NULL,
                'id' => 26,
                'Modified_Date' => NULL,
            'name' => 'Master of Fine Arts (MFA)',
            'Slug' => 'Master of Fine Arts (MFA)',
                'UserID' => '2',
            ),
            26 => 
            array (
                'Created_Date' => NULL,
                'id' => 27,
                'Modified_Date' => NULL,
            'name' => 'Master of Laws (LLM)',
            'Slug' => 'Master of Laws (LLM)',
                'UserID' => '2',
            ),
            27 => 
            array (
                'Created_Date' => NULL,
                'id' => 28,
                'Modified_Date' => NULL,
            'name' => 'Master of Library & Information Science (MLIS)',
            'Slug' => 'Master of Library & Information Science (MLIS)',
                'UserID' => '2',
            ),
            28 => 
            array (
                'Created_Date' => NULL,
                'id' => 29,
                'Modified_Date' => NULL,
            'name' => 'Master of Philosophy (MPhil)',
            'Slug' => 'Master of Philosophy (MPhil)',
                'UserID' => '2',
            ),
            29 => 
            array (
                'Created_Date' => NULL,
                'id' => 30,
                'Modified_Date' => NULL,
            'name' => 'Master of Public Administration (MPA)',
            'Slug' => 'Master of Public Administration (MPA)',
                'UserID' => '2',
            ),
            30 => 
            array (
                'Created_Date' => NULL,
                'id' => 31,
                'Modified_Date' => NULL,
            'name' => 'Master of Public Health (MPH)',
            'Slug' => 'Master of Public Health (MPH)',
                'UserID' => '2',
            ),
            31 => 
            array (
                'Created_Date' => NULL,
                'id' => 32,
                'Modified_Date' => NULL,
            'name' => 'Master of Science (MS)',
            'Slug' => 'Master of Science (MS)',
                'UserID' => '2',
            ),
            32 => 
            array (
                'Created_Date' => NULL,
                'id' => 33,
                'Modified_Date' => NULL,
            'name' => 'Master of Social Work (MSW)',
            'Slug' => 'Master of Social Work (MSW)',
                'UserID' => '2',
            ),
            33 => 
            array (
                'Created_Date' => NULL,
                'id' => 34,
                'Modified_Date' => NULL,
            'name' => 'Master of Technology (MTech)',
            'Slug' => 'Master of Technology (MTech)',
                'UserID' => '2',
            ),
            34 => 
            array (
                'Created_Date' => NULL,
                'id' => 35,
                'Modified_Date' => NULL,
            'name' => 'Doctor of Education (EdD)',
            'Slug' => 'Doctor of Education (EdD)',
                'UserID' => '2',
            ),
            35 => 
            array (
                'Created_Date' => NULL,
                'id' => 36,
                'Modified_Date' => NULL,
            'name' => 'Doctor of Law (JD)',
            'Slug' => 'Doctor of Law (JD)',
                'UserID' => '2',
            ),
            36 => 
            array (
                'Created_Date' => NULL,
                'id' => 37,
                'Modified_Date' => NULL,
            'name' => 'Doctor of Medicine (JD)',
            'Slug' => 'Doctor of Medicine (JD)',
                'UserID' => '2',
            ),
            37 => 
            array (
                'Created_Date' => NULL,
                'id' => 38,
                'Modified_Date' => NULL,
            'name' => 'Doctor of Pharmacy (PharmD)',
            'Slug' => 'Doctor of Pharmacy (PharmD)',
                'UserID' => '2',
            ),
            38 => 
            array (
                'Created_Date' => NULL,
                'id' => 39,
                'Modified_Date' => NULL,
            'name' => 'Doctor of Philsopophy (PhD)',
            'Slug' => 'Doctor of Philsopophy (PhD)',
                'UserID' => '2',
            ),
            39 => 
            array (
                'Created_Date' => NULL,
                'id' => 40,
                'Modified_Date' => NULL,
            'name' => 'Doctor of Dental Surgery Degree (DDS)',
            'Slug' => 'Doctor of Dental Surgery Degree (DDS)',
                'UserID' => '2',
            ),
            40 => 
            array (
                'Created_Date' => NULL,
                'id' => 41,
                'Modified_Date' => NULL,
                'name' => 'Other',
                'Slug' => 'Other',
                'UserID' => '2',
            ),
        ));
        
        
    }
}