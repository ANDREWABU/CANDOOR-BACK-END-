<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FieldOfStudiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('field_of_studies')->delete();
        
        \DB::table('field_of_studies')->insert(array (
            0 => 
            array (
                'Created_Date' => NULL,
                'id' => 1,
                'Modified_Date' => NULL,
                'name' => 'Accounting',
                'Slug' => 'Accounting',
                'UserID' => '2',
            ),
            1 => 
            array (
                'Created_Date' => NULL,
                'id' => 2,
                'Modified_Date' => NULL,
                'name' => 'Architecture',
                'Slug' => 'Architecture',
                'UserID' => '2',
            ),
            2 => 
            array (
                'Created_Date' => NULL,
                'id' => 3,
                'Modified_Date' => NULL,
                'name' => 'Accounting and Finance',
                'Slug' => 'Accounting and Finance',
                'UserID' => '2',
            ),
            3 => 
            array (
                'Created_Date' => NULL,
                'id' => 4,
                'Modified_Date' => NULL,
                'name' => 'Art/Art Studies, General',
                'Slug' => 'Art/Art Studies, General',
                'UserID' => '2',
            ),
            4 => 
            array (
                'Created_Date' => NULL,
                'id' => 5,
                'Modified_Date' => NULL,
                'name' => 'Advertising',
                'Slug' => 'Advertising',
                'UserID' => '2',
            ),
            5 => 
            array (
                'Created_Date' => NULL,
                'id' => 6,
                'Modified_Date' => NULL,
                'name' => 'Business Administration and Management, General',
                'Slug' => 'Business Administration and Management, General',
                'UserID' => '2',
            ),
            6 => 
            array (
                'Created_Date' => NULL,
                'id' => 7,
                'Modified_Date' => NULL,
                'name' => 'Business/Commerce, General',
                'Slug' => 'Business/Commerce, General',
                'UserID' => '2',
            ),
            7 => 
            array (
                'Created_Date' => NULL,
                'id' => 8,
                'Modified_Date' => NULL,
                'name' => 'Biology, General',
                'Slug' => 'Biology, General',
                'UserID' => '2',
            ),
            8 => 
            array (
                'Created_Date' => NULL,
                'id' => 9,
                'Modified_Date' => NULL,
                'name' => 'Business, Management, Marketing, and Related Support Services',
                'Slug' => 'Business, Management, Marketing, and Related Support Services',
                'UserID' => '2',
            ),
            9 => 
            array (
                'Created_Date' => NULL,
                'id' => 10,
                'Modified_Date' => NULL,
                'name' => 'Business/Managerial Economics',
                'Slug' => 'Business/Managerial Economics',
                'UserID' => '2',
            ),
            10 => 
            array (
                'Created_Date' => NULL,
                'id' => 11,
                'Modified_Date' => NULL,
                'name' => 'Biochemistry',
                'Slug' => 'Biochemistry',
                'UserID' => '2',
            ),
            11 => 
            array (
                'Created_Date' => NULL,
                'id' => 12,
                'Modified_Date' => NULL,
                'name' => 'Accounting and Business/Management',
                'Slug' => 'Accounting and Business/Management',
                'UserID' => '2',
            ),
            12 => 
            array (
                'Created_Date' => NULL,
                'id' => 13,
                'Modified_Date' => NULL,
                'name' => 'Biotechnology',
                'Slug' => 'Biotechnology',
                'UserID' => '2',
            ),
            13 => 
            array (
                'Created_Date' => NULL,
                'id' => 14,
                'Modified_Date' => NULL,
                'name' => 'Biomedical/Medical Engineering',
                'Slug' => 'Biomedical/Medical Engineering',
                'UserID' => '2',
            ),
            14 => 
            array (
                'Created_Date' => NULL,
                'id' => 15,
                'Modified_Date' => NULL,
                'name' => 'Business/Corporate Communications',
                'Slug' => 'Business/Corporate Communications',
                'UserID' => '2',
            ),
            15 => 
            array (
                'Created_Date' => NULL,
                'id' => 16,
                'Modified_Date' => NULL,
                'name' => 'Banking and Financial Support Services',
                'Slug' => 'Banking and Financial Support Services',
                'UserID' => '2',
            ),
            16 => 
            array (
                'Created_Date' => NULL,
                'id' => 17,
                'Modified_Date' => NULL,
                'name' => 'Biology/Biological Sciences, General',
                'Slug' => 'Biology/Biological Sciences, General',
                'UserID' => '2',
            ),
            17 => 
            array (
                'Created_Date' => NULL,
                'id' => 18,
                'Modified_Date' => NULL,
                'name' => 'Banking, Corporate, Finance, and Securities Law',
                'Slug' => 'Banking, Corporate, Finance, and Securities Law',
                'UserID' => '2',
            ),
            18 => 
            array (
                'Created_Date' => NULL,
                'id' => 19,
                'Modified_Date' => NULL,
                'name' => 'Zoology/Animal Biology',
                'Slug' => 'Zoology/Animal Biology',
                'UserID' => '2',
            ),
            19 => 
            array (
                'Created_Date' => NULL,
                'id' => 20,
                'Modified_Date' => NULL,
                'name' => 'Molecular Biology',
                'Slug' => 'Molecular Biology',
                'UserID' => '2',
            ),
            20 => 
            array (
                'Created_Date' => NULL,
                'id' => 21,
                'Modified_Date' => NULL,
                'name' => 'Business Administration, Management and Operations',
                'Slug' => 'Business Administration, Management and Operations',
                'UserID' => '2',
            ),
            21 => 
            array (
                'Created_Date' => NULL,
                'id' => 22,
                'Modified_Date' => NULL,
                'name' => 'Broadcast Journalism',
                'Slug' => 'Broadcast Journalism',
                'UserID' => '2',
            ),
            22 => 
            array (
                'Created_Date' => NULL,
                'id' => 23,
                'Modified_Date' => NULL,
                'name' => 'Computer Science',
                'Slug' => 'Computer Science',
                'UserID' => '2',
            ),
            23 => 
            array (
                'Created_Date' => NULL,
                'id' => 24,
                'Modified_Date' => NULL,
                'name' => 'Computer and Information Sciences and Support Services',
                'Slug' => 'Computer and Information Sciences and Support Services',
                'UserID' => '2',
            ),
            24 => 
            array (
                'Created_Date' => NULL,
                'id' => 25,
                'Modified_Date' => NULL,
                'name' => 'Communication and Media Studies',
                'Slug' => 'Communication and Media Studies',
                'UserID' => '2',
            ),
            25 => 
            array (
                'Created_Date' => NULL,
                'id' => 26,
                'Modified_Date' => NULL,
                'name' => 'Chemistry',
                'Slug' => 'Chemistry',
                'UserID' => '2',
            ),
            26 => 
            array (
                'Created_Date' => NULL,
                'id' => 27,
                'Modified_Date' => NULL,
                'name' => 'Computer Engineering',
                'Slug' => 'Computer Engineering',
                'UserID' => '2',
            ),
            27 => 
            array (
                'Created_Date' => NULL,
                'id' => 28,
                'Modified_Date' => NULL,
                'name' => 'Civil Engineering',
                'Slug' => 'Civil Engineering',
                'UserID' => '2',
            ),
            28 => 
            array (
                'Created_Date' => NULL,
                'id' => 29,
                'Modified_Date' => NULL,
                'name' => 'Chemical Engineering',
                'Slug' => 'Chemical Engineering',
                'UserID' => '2',
            ),
            29 => 
            array (
                'Created_Date' => NULL,
                'id' => 30,
                'Modified_Date' => NULL,
                'name' => 'Computer Systems Networking and Telecommunications',
                'Slug' => 'Computer Systems Networking and Telecommunications',
                'UserID' => '2',
            ),
            30 => 
            array (
                'Created_Date' => NULL,
                'id' => 31,
                'Modified_Date' => NULL,
                'name' => 'Criminal Justic and Corrections',
                'Slug' => 'Criminal Justic and Corrections',
                'UserID' => '2',
            ),
            31 => 
            array (
                'Created_Date' => NULL,
                'id' => 32,
                'Modified_Date' => NULL,
                'name' => 'Computer Software Engineering',
                'Slug' => 'Computer Software Engineering',
                'UserID' => '2',
            ),
            32 => 
            array (
                'Created_Date' => NULL,
                'id' => 33,
                'Modified_Date' => NULL,
                'name' => 'Computer Programming, Specific Applications',
                'Slug' => 'Computer Programming, Specific Applications',
                'UserID' => '2',
            ),
            33 => 
            array (
                'Created_Date' => NULL,
                'id' => 34,
                'Modified_Date' => NULL,
                'name' => 'Counseling Psychology',
                'Slug' => 'Counseling Psychology',
                'UserID' => '2',
            ),
            34 => 
            array (
                'Created_Date' => NULL,
                'id' => 35,
                'Modified_Date' => NULL,
                'name' => 'Design and Applied Arts',
                'Slug' => 'Design and Applied Arts',
                'UserID' => '2',
            ),
            35 => 
            array (
                'Created_Date' => NULL,
                'id' => 36,
                'Modified_Date' => NULL,
                'name' => 'Design and Visual Communications, General',
                'Slug' => 'Design and Visual Communications, General',
                'UserID' => '2',
            ),
            36 => 
            array (
                'Created_Date' => NULL,
                'id' => 37,
                'Modified_Date' => NULL,
                'name' => 'Dentistry',
                'Slug' => 'Dentistry',
                'UserID' => '2',
            ),
            37 => 
            array (
                'Created_Date' => NULL,
                'id' => 38,
                'Modified_Date' => NULL,
                'name' => 'Communication Sciences and Disorders, General',
                'Slug' => 'Communication Sciences and Disorders, General',
                'UserID' => '2',
            ),
            38 => 
            array (
                'Created_Date' => NULL,
                'id' => 39,
                'Modified_Date' => NULL,
                'name' => 'Drama and Dramatics / Theatre Arts, General',
                'Slug' => 'Drama and Dramatics / Theatre Arts, General',
                'UserID' => '2',
            ),
            39 => 
            array (
                'Created_Date' => NULL,
                'id' => 40,
                'Modified_Date' => NULL,
                'name' => 'Development Economics and International Development',
                'Slug' => 'Development Economics and International Development',
                'UserID' => '2',
            ),
            40 => 
            array (
                'Created_Date' => NULL,
                'id' => 41,
                'Modified_Date' => NULL,
                'name' => 'Pharmaceutics and Drug Design',
                'Slug' => 'Pharmaceutics and Drug Design',
                'UserID' => '2',
            ),
            41 => 
            array (
                'Created_Date' => NULL,
                'id' => 42,
                'Modified_Date' => NULL,
                'name' => 'Data Processing',
                'Slug' => 'Data Processing',
                'UserID' => '2',
            ),
            42 => 
            array (
                'Created_Date' => NULL,
                'id' => 43,
                'Modified_Date' => NULL,
                'name' => 'Digital Communication and Media/Multimedia',
                'Slug' => 'Digital Communication and Media/Multimedia',
                'UserID' => '2',
            ),
            43 => 
            array (
                'Created_Date' => NULL,
                'id' => 44,
                'Modified_Date' => NULL,
                'name' => 'Dance',
                'Slug' => 'Dance',
                'UserID' => '2',
            ),
            44 => 
            array (
                'Created_Date' => NULL,
                'id' => 45,
                'Modified_Date' => NULL,
                'name' => 'Dietetics/Dietician',
                'Slug' => 'Dietetics/Dietician',
                'UserID' => '2',
            ),
            45 => 
            array (
                'Created_Date' => NULL,
                'id' => 46,
                'Modified_Date' => NULL,
                'name' => 'Business/Office Automation/Technology/Data Entry',
                'Slug' => 'Business/Office Automation/Technology/Data Entry',
                'UserID' => '2',
            ),
            46 => 
            array (
                'Created_Date' => NULL,
                'id' => 47,
                'Modified_Date' => NULL,
                'name' => 'Dental Hygiene/Hygienist',
                'Slug' => 'Dental Hygiene/Hygienist',
                'UserID' => '2',
            ),
            47 => 
            array (
                'Created_Date' => NULL,
                'id' => 48,
                'Modified_Date' => NULL,
                'name' => 'Divinity/Ministry',
                'Slug' => 'Divinity/Ministry',
                'UserID' => '2',
            ),
            48 => 
            array (
                'Created_Date' => NULL,
                'id' => 49,
                'Modified_Date' => NULL,
                'name' => 'Economics',
                'Slug' => 'Economics',
                'UserID' => '2',
            ),
            49 => 
            array (
                'Created_Date' => NULL,
                'id' => 50,
                'Modified_Date' => NULL,
                'name' => 'Electrical and Electronics Engineering',
                'Slug' => 'Electrical and Electronics Engineering',
                'UserID' => '2',
            ),
            50 => 
            array (
                'Created_Date' => NULL,
                'id' => 51,
                'Modified_Date' => NULL,
                'name' => 'English Language and Literature/Letters',
                'Slug' => 'English Language and Literature/Letters',
                'UserID' => '2',
            ),
            51 => 
            array (
                'Created_Date' => NULL,
                'id' => 52,
                'Modified_Date' => NULL,
                'name' => 'Engineering',
                'Slug' => 'Engineering',
                'UserID' => '2',
            ),
            52 => 
            array (
                'Created_Date' => NULL,
                'id' => 53,
                'Modified_Date' => NULL,
                'name' => 'Electrical, Electronics and Communications Engineering',
                'Slug' => 'Electrical, Electronics and Communications Engineering',
                'UserID' => '2',
            ),
            53 => 
            array (
                'Created_Date' => NULL,
                'id' => 54,
                'Modified_Date' => NULL,
                'name' => 'Engineering/Industrial Management',
                'Slug' => 'Engineering/Industrial Management',
                'UserID' => '2',
            ),
            54 => 
            array (
                'Created_Date' => NULL,
                'id' => 55,
                'Modified_Date' => NULL,
            'name' => 'English Literature (British and Commonwealth)',
            'Slug' => 'English Literature (British and Commonwealth)',
                'UserID' => '2',
            ),
            55 => 
            array (
                'Created_Date' => NULL,
                'id' => 56,
                'Modified_Date' => NULL,
                'name' => 'Elementary Education and Teaching',
                'Slug' => 'Elementary Education and Teaching',
                'UserID' => '2',
            ),
            56 => 
            array (
                'Created_Date' => NULL,
                'id' => 57,
                'Modified_Date' => NULL,
                'name' => 'Aerospace, Aeronautical and Astronautical Engineering',
                'Slug' => 'Aerospace, Aeronautical and Astronautical Engineering',
                'UserID' => '2',
            ),
            57 => 
            array (
                'Created_Date' => NULL,
                'id' => 58,
                'Modified_Date' => NULL,
                'name' => 'English Lanaguage and Literature, General',
                'Slug' => 'English Lanaguage and Literature, General',
                'UserID' => '2',
            ),
            58 => 
            array (
                'Created_Date' => NULL,
                'id' => 59,
                'Modified_Date' => NULL,
                'name' => 'Finance, General',
                'Slug' => 'Finance, General',
                'UserID' => '2',
            ),
            59 => 
            array (
                'Created_Date' => NULL,
                'id' => 60,
                'Modified_Date' => NULL,
                'name' => 'Fine/Studio Arts, General',
                'Slug' => 'Fine/Studio Arts, General',
                'UserID' => '2',
            ),
            60 => 
            array (
                'Created_Date' => NULL,
                'id' => 61,
                'Modified_Date' => NULL,
                'name' => 'Finance and Financial Management Services',
                'Slug' => 'Finance and Financial Management Services',
                'UserID' => '2',
            ),
            61 => 
            array (
                'Created_Date' => NULL,
                'id' => 62,
                'Modified_Date' => NULL,
                'name' => 'French Studies',
                'Slug' => 'French Studies',
                'UserID' => '2',
            ),
            62 => 
            array (
                'Created_Date' => NULL,
                'id' => 63,
                'Modified_Date' => NULL,
                'name' => 'Sport and Fitness Administration/Management',
                'Slug' => 'Sport and Fitness Administration/Management',
                'UserID' => '2',
            ),
            63 => 
            array (
                'Created_Date' => NULL,
                'id' => 64,
                'Modified_Date' => NULL,
                'name' => 'Fashion/Apparel Design',
                'Slug' => 'Fashion/Apparel Design',
                'UserID' => '2',
            ),
            64 => 
            array (
                'Created_Date' => NULL,
                'id' => 65,
                'Modified_Date' => NULL,
                'name' => 'Film/Cinema/Video Studies',
                'Slug' => 'Film/Cinema/Video Studies',
                'UserID' => '2',
            ),
            65 => 
            array (
                'Created_Date' => NULL,
                'id' => 66,
                'Modified_Date' => NULL,
                'name' => 'Financial Planning and Services',
                'Slug' => 'Financial Planning and Services',
                'UserID' => '2',
            ),
            66 => 
            array (
                'Created_Date' => NULL,
                'id' => 67,
                'Modified_Date' => NULL,
                'name' => 'Foods, Nutrition, and Wellness Studies, General',
                'Slug' => 'Foods, Nutrition, and Wellness Studies, General',
                'UserID' => '2',
            ),
            67 => 
            array (
                'Created_Date' => NULL,
                'id' => 68,
                'Modified_Date' => NULL,
                'name' => 'Fashion Merchandising',
                'Slug' => 'Fashion Merchandising',
                'UserID' => '2',
            ),
            68 => 
            array (
                'Created_Date' => NULL,
                'id' => 69,
                'Modified_Date' => NULL,
                'name' => 'Cinematography and Film/Video Production',
                'Slug' => 'Cinematography and Film/Video Production',
                'UserID' => '2',
            ),
            69 => 
            array (
                'Created_Date' => NULL,
                'id' => 70,
                'Modified_Date' => NULL,
                'name' => 'Facilities Planning and Management',
                'Slug' => 'Facilities Planning and Management',
                'UserID' => '2',
            ),
            70 => 
            array (
                'Created_Date' => NULL,
                'id' => 71,
                'Modified_Date' => NULL,
                'name' => 'Food Studies',
                'Slug' => 'Food Studies',
                'UserID' => '2',
            ),
            71 => 
            array (
                'Created_Date' => NULL,
                'id' => 72,
                'Modified_Date' => NULL,
                'name' => 'International Finance',
                'Slug' => 'International Finance',
                'UserID' => '2',
            ),
            72 => 
            array (
                'Created_Date' => NULL,
                'id' => 73,
                'Modified_Date' => NULL,
                'name' => 'French Language and Literature',
                'Slug' => 'French Language and Literature',
                'UserID' => '2',
            ),
            73 => 
            array (
                'Created_Date' => NULL,
                'id' => 74,
                'Modified_Date' => NULL,
                'name' => 'General Studies',
                'Slug' => 'General Studies',
                'UserID' => '2',
            ),
            74 => 
            array (
                'Created_Date' => NULL,
                'id' => 75,
                'Modified_Date' => NULL,
                'name' => 'Graphic Design',
                'Slug' => 'Graphic Design',
                'UserID' => '2',
            ),
            75 => 
            array (
                'Created_Date' => NULL,
                'id' => 76,
                'Modified_Date' => NULL,
                'name' => 'Geology/Earth Science, General',
                'Slug' => 'Geology/Earth Science, General',
                'UserID' => '2',
            ),
            76 => 
            array (
                'Created_Date' => NULL,
                'id' => 77,
                'Modified_Date' => NULL,
                'name' => 'Geography',
                'Slug' => 'Geography',
                'UserID' => '2',
            ),
            77 => 
            array (
                'Created_Date' => NULL,
                'id' => 78,
                'Modified_Date' => NULL,
                'name' => 'History',
                'Slug' => 'History',
                'UserID' => '2',
            ),
            78 => 
            array (
                'Created_Date' => NULL,
                'id' => 79,
                'Modified_Date' => NULL,
                'name' => 'Human Resources Management/Personnel Administration, General',
                'Slug' => 'Human Resources Management/Personnel Administration, General',
                'UserID' => '2',
            ),
            79 => 
            array (
                'Created_Date' => NULL,
                'id' => 80,
                'Modified_Date' => NULL,
                'name' => 'Human Resources Management and Services',
                'Slug' => 'Human Resources Management and Services',
                'UserID' => '2',
            ),
            80 => 
            array (
                'Created_Date' => NULL,
                'id' => 81,
                'Modified_Date' => NULL,
                'name' => 'Hospitality Administration/Management',
                'Slug' => 'Hospitality Administration/Management',
                'UserID' => '2',
            ),
            81 => 
            array (
                'Created_Date' => NULL,
                'id' => 82,
                'Modified_Date' => NULL,
                'name' => 'Health/Health Care Administration/Management',
                'Slug' => 'Health/Health Care Administration/Management',
                'UserID' => '2',
            ),
            82 => 
            array (
                'Created_Date' => NULL,
                'id' => 83,
                'Modified_Date' => NULL,
                'name' => 'Art History, Criticism and Conservation',
                'Slug' => 'Art History, Criticism and Conservation',
                'UserID' => '2',
            ),
            83 => 
            array (
                'Created_Date' => NULL,
                'id' => 84,
                'Modified_Date' => NULL,
                'name' => 'Hotel/Motel Administration/Management',
                'Slug' => 'Hotel/Motel Administration/Management',
                'UserID' => '2',
            ),
            84 => 
            array (
                'Created_Date' => NULL,
                'id' => 85,
                'Modified_Date' => NULL,
                'name' => 'Environmental/Environmental Health Engineering',
                'Slug' => 'Environmental/Environmental Health Engineering',
                'UserID' => '2',
            ),
            85 => 
            array (
                'Created_Date' => NULL,
                'id' => 86,
                'Modified_Date' => NULL,
                'name' => 'Humanities/Humanistic Studies',
                'Slug' => 'Humanities/Humanistic Studies',
                'UserID' => '2',
            ),
            86 => 
            array (
                'Created_Date' => NULL,
                'id' => 87,
                'Modified_Date' => NULL,
                'name' => 'Public Health',
                'Slug' => 'Public Health',
                'UserID' => '2',
            ),
            87 => 
            array (
                'Created_Date' => NULL,
                'id' => 88,
                'Modified_Date' => NULL,
                'name' => 'Health and Physical Education/Fitness',
                'Slug' => 'Health and Physical Education/Fitness',
                'UserID' => '2',
            ),
            88 => 
            array (
                'Created_Date' => NULL,
                'id' => 89,
                'Modified_Date' => NULL,
                'name' => 'Health Services/Allied Health/Health Sciences, General',
                'Slug' => 'Health Services/Allied Health/Health Sciences, General',
                'UserID' => '2',
            ),
            89 => 
            array (
                'Created_Date' => NULL,
                'id' => 90,
                'Modified_Date' => NULL,
                'name' => 'Higher Education/Higher Education Administration',
                'Slug' => 'Higher Education/Higher Education Administration',
                'UserID' => '2',
            ),
            90 => 
            array (
                'Created_Date' => NULL,
                'id' => 91,
                'Modified_Date' => NULL,
                'name' => 'Human Services, General',
                'Slug' => 'Human Services, General',
                'UserID' => '2',
            ),
            91 => 
            array (
                'Created_Date' => NULL,
                'id' => 92,
                'Modified_Date' => NULL,
                'name' => 'Human Development and Family Studies, General',
                'Slug' => 'Human Development and Family Studies, General',
                'UserID' => '2',
            ),
            92 => 
            array (
                'Created_Date' => NULL,
                'id' => 93,
                'Modified_Date' => NULL,
                'name' => 'Human Resources Development',
                'Slug' => 'Human Resources Development',
                'UserID' => '2',
            ),
            93 => 
            array (
                'Created_Date' => NULL,
                'id' => 94,
                'Modified_Date' => NULL,
                'name' => 'Health and Wellness, General',
                'Slug' => 'Health and Wellness, General',
                'UserID' => '2',
            ),
            94 => 
            array (
                'Created_Date' => NULL,
                'id' => 95,
                'Modified_Date' => NULL,
                'name' => 'Homeland Security, Law Enforcement, Firefighting and Related Protective Services',
                'Slug' => 'Homeland Security, Law Enforcement, Firefighting and Related Protective Services',
                'UserID' => '2',
            ),
            95 => 
            array (
                'Created_Date' => NULL,
                'id' => 96,
                'Modified_Date' => NULL,
                'name' => 'Health Services Administration',
                'Slug' => 'Health Services Administration',
                'UserID' => '2',
            ),
            96 => 
            array (
                'Created_Date' => NULL,
                'id' => 97,
                'Modified_Date' => NULL,
                'name' => 'Information Technology',
                'Slug' => 'Information Technology',
                'UserID' => '2',
            ),
            97 => 
            array (
                'Created_Date' => NULL,
                'id' => 98,
                'Modified_Date' => NULL,
                'name' => 'International Business',
                'Slug' => 'International Business',
                'UserID' => '2',
            ),
            98 => 
            array (
                'Created_Date' => NULL,
                'id' => 99,
                'Modified_Date' => NULL,
                'name' => 'Management Information Systems, General',
                'Slug' => 'Management Information Systems, General',
                'UserID' => '2',
            ),
            99 => 
            array (
                'Created_Date' => NULL,
                'id' => 100,
                'Modified_Date' => NULL,
                'name' => 'Industrial Engineering',
                'Slug' => 'Industrial Engineering',
                'UserID' => '2',
            ),
            100 => 
            array (
                'Created_Date' => NULL,
                'id' => 101,
                'Modified_Date' => NULL,
                'name' => 'International Relations and Affairs',
                'Slug' => 'International Relations and Affairs',
                'UserID' => '2',
            ),
            101 => 
            array (
                'Created_Date' => NULL,
                'id' => 102,
                'Modified_Date' => NULL,
                'name' => 'Interior Design',
                'Slug' => 'Interior Design',
                'UserID' => '2',
            ),
            102 => 
            array (
                'Created_Date' => NULL,
                'id' => 103,
                'Modified_Date' => NULL,
                'name' => 'Public Relations/Image Management',
                'Slug' => 'Public Relations/Image Management',
                'UserID' => '2',
            ),
            103 => 
            array (
                'Created_Date' => NULL,
                'id' => 104,
                'Modified_Date' => NULL,
                'name' => 'International Business/Trade/Commerce',
                'Slug' => 'International Business/Trade/Commerce',
                'UserID' => '2',
            ),
            104 => 
            array (
                'Created_Date' => NULL,
                'id' => 105,
                'Modified_Date' => NULL,
                'name' => 'Industrial and Product Design',
                'Slug' => 'Industrial and Product Design',
                'UserID' => '2',
            ),
            105 => 
            array (
                'Created_Date' => NULL,
                'id' => 106,
                'Modified_Date' => NULL,
                'name' => 'Computer/Information Technology Administration and Management',
                'Slug' => 'Computer/Information Technology Administration and Management',
                'UserID' => '2',
            ),
            106 => 
            array (
                'Created_Date' => NULL,
                'id' => 107,
                'Modified_Date' => NULL,
                'name' => 'Spanish and Iberian Studies',
                'Slug' => 'Spanish and Iberian Studies',
                'UserID' => '2',
            ),
            107 => 
            array (
                'Created_Date' => NULL,
                'id' => 108,
                'Modified_Date' => NULL,
                'name' => 'Informatics',
                'Slug' => 'Informatics',
                'UserID' => '2',
            ),
            108 => 
            array (
                'Created_Date' => NULL,
                'id' => 109,
                'Modified_Date' => NULL,
                'name' => 'International/Global Studies',
                'Slug' => 'International/Global Studies',
                'UserID' => '2',
            ),
            109 => 
            array (
                'Created_Date' => NULL,
                'id' => 110,
                'Modified_Date' => NULL,
                'name' => 'Information Technology Project Management',
                'Slug' => 'Information Technology Project Management',
                'UserID' => '2',
            ),
            110 => 
            array (
                'Created_Date' => NULL,
                'id' => 111,
                'Modified_Date' => NULL,
                'name' => 'International Marketing',
                'Slug' => 'International Marketing',
                'UserID' => '2',
            ),
            111 => 
            array (
                'Created_Date' => NULL,
                'id' => 112,
                'Modified_Date' => NULL,
                'name' => 'Library and Information Science',
                'Slug' => 'Library and Information Science',
                'UserID' => '2',
            ),
            112 => 
            array (
                'Created_Date' => NULL,
                'id' => 113,
                'Modified_Date' => NULL,
                'name' => 'Computer and Information Sciences, General',
                'Slug' => 'Computer and Information Sciences, General',
                'UserID' => '2',
            ),
            113 => 
            array (
                'Created_Date' => NULL,
                'id' => 114,
                'Modified_Date' => NULL,
                'name' => 'Information Resources Management',
                'Slug' => 'Information Resources Management',
                'UserID' => '2',
            ),
            114 => 
            array (
                'Created_Date' => NULL,
                'id' => 115,
                'Modified_Date' => NULL,
                'name' => 'Journalism',
                'Slug' => 'Journalism',
                'UserID' => '2',
            ),
            115 => 
            array (
                'Created_Date' => NULL,
                'id' => 116,
                'Modified_Date' => NULL,
                'name' => 'Japanese Studies',
                'Slug' => 'Japanese Studies',
                'UserID' => '2',
            ),
            116 => 
            array (
                'Created_Date' => NULL,
                'id' => 117,
                'Modified_Date' => NULL,
                'name' => 'Japanese Language and Literature',
                'Slug' => 'Japanese Language and Literature',
                'UserID' => '2',
            ),
            117 => 
            array (
                'Created_Date' => NULL,
                'id' => 118,
                'Modified_Date' => NULL,
                'name' => 'Criminal Justice/Police Science',
                'Slug' => 'Criminal Justice/Police Science',
                'UserID' => '2',
            ),
            118 => 
            array (
                'Created_Date' => NULL,
                'id' => 119,
                'Modified_Date' => NULL,
                'name' => 'Canadian Law/Legal Studies/Jurisprudence',
                'Slug' => 'Canadian Law/Legal Studies/Jurisprudence',
                'UserID' => '2',
            ),
            119 => 
            array (
                'Created_Date' => NULL,
                'id' => 120,
                'Modified_Date' => NULL,
                'name' => 'Criminal Justice/Safety Studies',
                'Slug' => 'Criminal Justice/Safety Studies',
                'UserID' => '2',
            ),
            120 => 
            array (
                'Created_Date' => NULL,
                'id' => 121,
                'Modified_Date' => NULL,
                'name' => 'Jewish/Judaic Studies',
                'Slug' => 'Jewish/Judaic Studies',
                'UserID' => '2',
            ),
            121 => 
            array (
                'Created_Date' => NULL,
                'id' => 122,
                'Modified_Date' => NULL,
                'name' => 'Jazz/Jazz Studies',
                'Slug' => 'Jazz/Jazz Studies',
                'UserID' => '2',
            ),
            122 => 
            array (
                'Created_Date' => NULL,
                'id' => 123,
                'Modified_Date' => NULL,
                'name' => 'Agricultural Communications/Journalism',
                'Slug' => 'Agricultural Communications/Journalism',
                'UserID' => '2',
            ),
            123 => 
            array (
                'Created_Date' => NULL,
                'id' => 124,
                'Modified_Date' => NULL,
                'name' => 'Criminal Justice/Law Enforcement Administration',
                'Slug' => 'Criminal Justice/Law Enforcement Administration',
                'UserID' => '2',
            ),
            124 => 
            array (
                'Created_Date' => NULL,
                'id' => 125,
                'Modified_Date' => NULL,
                'name' => 'American/U.S.Law/Legal Studies/Jurisprudence',
                'Slug' => 'American/U.S.Law/Legal Studies/Jurisprudence',
                'UserID' => '2',
            ),
            125 => 
            array (
                'Created_Date' => NULL,
                'id' => 126,
                'Modified_Date' => NULL,
                'name' => 'Junior High/Intermediate/Middle School Education and Teaching',
                'Slug' => 'Junior High/Intermediate/Middle School Education and Teaching',
                'UserID' => '2',
            ),
            126 => 
            array (
                'Created_Date' => NULL,
                'id' => 127,
                'Modified_Date' => NULL,
                'name' => 'Watchmaking and Jewelrymaking',
                'Slug' => 'Watchmaking and Jewelrymaking',
                'UserID' => '2',
            ),
            127 => 
            array (
                'Created_Date' => NULL,
                'id' => 128,
                'Modified_Date' => NULL,
                'name' => 'Metal and Jewelry Arts',
                'Slug' => 'Metal and Jewelry Arts',
                'UserID' => '2',
            ),
            128 => 
            array (
                'Created_Date' => NULL,
                'id' => 129,
                'Modified_Date' => NULL,
                'name' => 'Army JROTC/ROTC',
                'Slug' => 'Army JROTC/ROTC',
                'UserID' => '2',
            ),
            129 => 
            array (
                'Created_Date' => NULL,
                'id' => 130,
                'Modified_Date' => NULL,
                'name' => 'Air Force JROTC/ROTC',
                'Slug' => 'Air Force JROTC/ROTC',
                'UserID' => '2',
            ),
            130 => 
            array (
                'Created_Date' => NULL,
                'id' => 131,
                'Modified_Date' => NULL,
                'name' => 'Juvenile Corrections',
                'Slug' => 'Juvenile Corrections',
                'UserID' => '2',
            ),
            131 => 
            array (
                'Created_Date' => NULL,
                'id' => 132,
                'Modified_Date' => NULL,
                'name' => 'Navy/Marine Corps JROTC/ROTC',
                'Slug' => 'Navy/Marine Corps JROTC/ROTC',
                'UserID' => '2',
            ),
            132 => 
            array (
                'Created_Date' => NULL,
                'id' => 133,
                'Modified_Date' => NULL,
                'name' => 'Kinesiology and Exercise Science',
                'Slug' => 'Kinesiology and Exercise Science',
                'UserID' => '2',
            ),
            133 => 
            array (
                'Created_Date' => NULL,
                'id' => 134,
                'Modified_Date' => NULL,
                'name' => 'Keyboard Instruments',
                'Slug' => 'Keyboard Instruments',
                'UserID' => '2',
            ),
            134 => 
            array (
                'Created_Date' => NULL,
                'id' => 135,
                'Modified_Date' => NULL,
                'name' => 'Knowledge Management',
                'Slug' => 'Knowledge Management',
                'UserID' => '2',
            ),
            135 => 
            array (
                'Created_Date' => NULL,
                'id' => 136,
                'Modified_Date' => NULL,
                'name' => 'Korean Studies',
                'Slug' => 'Korean Studies',
                'UserID' => '2',
            ),
            136 => 
            array (
                'Created_Date' => NULL,
                'id' => 137,
                'Modified_Date' => NULL,
                'name' => 'Korean Language and Literature',
                'Slug' => 'Korean Language and Literature',
                'UserID' => '2',
            ),
            137 => 
            array (
                'Created_Date' => NULL,
                'id' => 138,
                'Modified_Date' => NULL,
                'name' => 'Food Preparation/Professional Cooking/Kitchen Assistant',
                'Slug' => 'Food Preparation/Professional Cooking/Kitchen Assistant',
                'UserID' => '2',
            ),
            138 => 
            array (
                'Created_Date' => NULL,
                'id' => 139,
                'Modified_Date' => NULL,
                'name' => 'Kindergarten/Preschool Education and Teaching',
                'Slug' => 'Kindergarten/Preschool Education and Teaching',
                'UserID' => '2',
            ),
            139 => 
            array (
                'Created_Date' => NULL,
                'id' => 140,
                'Modified_Date' => NULL,
                'name' => 'Kinesiotherapy/Kinesiotherapist',
                'Slug' => 'Kinesiotherapy/Kinesiotherapist',
                'UserID' => '2',
            ),
            140 => 
            array (
                'Created_Date' => NULL,
                'id' => 141,
                'Modified_Date' => NULL,
                'name' => 'Khmer/Cambodian Language and Literature',
                'Slug' => 'Khmer/Cambodian Language and Literature',
                'UserID' => '2',
            ),
            141 => 
            array (
                'Created_Date' => NULL,
                'id' => 142,
                'Modified_Date' => NULL,
                'name' => 'Law Enforcement Record-Keeping and Evidence Management',
                'Slug' => 'Law Enforcement Record-Keeping and Evidence Management',
                'UserID' => '2',
            ),
            142 => 
            array (
                'Created_Date' => NULL,
                'id' => 143,
                'Modified_Date' => NULL,
                'name' => 'Birthing and Parenting Knowledge and Skills',
                'Slug' => 'Birthing and Parenting Knowledge and Skills',
                'UserID' => '2',
            ),
            143 => 
            array (
                'Created_Date' => NULL,
                'id' => 144,
                'Modified_Date' => NULL,
                'name' => 'Health-Related Knowledge and Skills',
                'Slug' => 'Health-Related Knowledge and Skills',
                'UserID' => '2',
            ),
            144 => 
            array (
                'Created_Date' => NULL,
                'id' => 145,
                'Modified_Date' => NULL,
                'name' => 'Law',
                'Slug' => 'Law',
                'UserID' => '2',
            ),
            145 => 
            array (
                'Created_Date' => NULL,
                'id' => 146,
                'Modified_Date' => NULL,
                'name' => 'Liberal Arts and Sciences/Liberal Studies',
                'Slug' => 'Liberal Arts and Sciences/Liberal Studies',
                'UserID' => '2',
            ),
            146 => 
            array (
                'Created_Date' => NULL,
                'id' => 147,
                'Modified_Date' => NULL,
                'name' => 'Logistics,Materials, and Supply Chain Management',
                'Slug' => 'Logistics,Materials, and Supply Chain Management',
                'UserID' => '2',
            ),
            147 => 
            array (
                'Created_Date' => NULL,
                'id' => 148,
                'Modified_Date' => NULL,
                'name' => 'Legal Assistant/Paralegal',
                'Slug' => 'Legal Assistant/Paralegal',
                'UserID' => '2',
            ),
            148 => 
            array (
                'Created_Date' => NULL,
                'id' => 149,
                'Modified_Date' => NULL,
                'name' => 'Organizational Leadership',
                'Slug' => 'Organizational Leadership',
                'UserID' => '2',
            ),
            149 => 
            array (
                'Created_Date' => NULL,
                'id' => 150,
                'Modified_Date' => NULL,
                'name' => 'Educational Leadership and Administration, General',
                'Slug' => 'Educational Leadership and Administration, General',
                'UserID' => '2',
            ),
            150 => 
            array (
                'Created_Date' => NULL,
                'id' => 151,
                'Modified_Date' => NULL,
                'name' => 'Linguistics',
                'Slug' => 'Linguistics',
                'UserID' => '2',
            ),
            151 => 
            array (
                'Created_Date' => NULL,
                'id' => 152,
                'Modified_Date' => NULL,
                'name' => 'Landscape Architecture',
                'Slug' => 'Landscape Architecture',
                'UserID' => '2',
            ),
            152 => 
            array (
                'Created_Date' => NULL,
                'id' => 153,
                'Modified_Date' => NULL,
                'name' => 'Library Science',
                'Slug' => 'Library Science',
                'UserID' => '2',
            ),
            153 => 
            array (
                'Created_Date' => NULL,
                'id' => 154,
                'Modified_Date' => NULL,
                'name' => 'Legal Studies, General',
                'Slug' => 'Legal Studies, General',
                'UserID' => '2',
            ),
            154 => 
            array (
                'Created_Date' => NULL,
                'id' => 155,
                'Modified_Date' => NULL,
                'name' => 'Clinical Laboratory Science/Medical Technology/Technologist',
                'Slug' => 'Clinical Laboratory Science/Medical Technology/Technologist',
                'UserID' => '2',
            ),
            155 => 
            array (
                'Created_Date' => NULL,
                'id' => 156,
                'Modified_Date' => NULL,
                'name' => 'Labor and Industrial Relations',
                'Slug' => 'Labor and Industrial Relations',
                'UserID' => '2',
            ),
            156 => 
            array (
                'Created_Date' => NULL,
                'id' => 157,
                'Modified_Date' => NULL,
                'name' => 'International Law and Legal Studies',
                'Slug' => 'International Law and Legal Studies',
                'UserID' => '2',
            ),
            157 => 
            array (
                'Created_Date' => NULL,
                'id' => 158,
                'Modified_Date' => NULL,
                'name' => 'Literature',
                'Slug' => 'Literature',
                'UserID' => '2',
            ),
            158 => 
            array (
                'Created_Date' => NULL,
                'id' => 159,
                'Modified_Date' => NULL,
                'name' => 'Speech-Language Pathology/Pathologist',
                'Slug' => 'Speech-Language Pathology/Pathologist',
                'UserID' => '2',
            ),
            159 => 
            array (
                'Created_Date' => NULL,
                'id' => 160,
                'Modified_Date' => NULL,
                'name' => 'Marketing',
                'Slug' => 'Marketing',
                'UserID' => '2',
            ),
            160 => 
            array (
                'Created_Date' => NULL,
                'id' => 161,
                'Modified_Date' => NULL,
                'name' => 'Mechanical Engineering',
                'Slug' => 'Mechanical Engineering',
                'UserID' => '2',
            ),
            161 => 
            array (
                'Created_Date' => NULL,
                'id' => 162,
                'Modified_Date' => NULL,
                'name' => 'Mathematics',
                'Slug' => 'Mathematics',
                'UserID' => '2',
            ),
            162 => 
            array (
                'Created_Date' => NULL,
                'id' => 163,
                'Modified_Date' => NULL,
                'name' => 'Marketing/Marketing Management, General',
                'Slug' => 'Marketing/Marketing Management, General',
                'UserID' => '2',
            ),
            163 => 
            array (
                'Created_Date' => NULL,
                'id' => 164,
                'Modified_Date' => NULL,
                'name' => 'Project Management',
                'Slug' => 'Project Management',
                'UserID' => '2',
            ),
            164 => 
            array (
                'Created_Date' => NULL,
                'id' => 165,
                'Modified_Date' => NULL,
                'name' => 'Medicine',
                'Slug' => 'Medicine',
                'UserID' => '2',
            ),
            165 => 
            array (
                'Created_Date' => NULL,
                'id' => 166,
                'Modified_Date' => NULL,
                'name' => 'Mass Communication/Media Studies',
                'Slug' => 'Mass Communication/Media Studies',
                'UserID' => '2',
            ),
            166 => 
            array (
                'Created_Date' => NULL,
                'id' => 167,
                'Modified_Date' => NULL,
                'name' => 'Music',
                'Slug' => 'Music',
                'UserID' => '2',
            ),
            167 => 
            array (
                'Created_Date' => NULL,
                'id' => 168,
                'Modified_Date' => NULL,
                'name' => 'Mathematics and Computer Science',
                'Slug' => 'Mathematics and Computer Science',
                'UserID' => '2',
            ),
            168 => 
            array (
                'Created_Date' => NULL,
                'id' => 169,
                'Modified_Date' => NULL,
                'name' => 'Registered Nursing/Registered Nurse',
                'Slug' => 'Registered Nursing/Registered Nurse',
                'UserID' => '2',
            ),
            169 => 
            array (
                'Created_Date' => NULL,
                'id' => 170,
                'Modified_Date' => NULL,
                'name' => 'Non-Profit/Public/Organizational Management',
                'Slug' => 'Non-Profit/Public/Organizational Management',
                'UserID' => '2',
            ),
            170 => 
            array (
                'Created_Date' => NULL,
                'id' => 171,
                'Modified_Date' => NULL,
                'name' => 'Neuroscience',
                'Slug' => 'Neuroscience',
                'UserID' => '2',
            ),
            171 => 
            array (
                'Created_Date' => NULL,
                'id' => 172,
                'Modified_Date' => NULL,
                'name' => 'Classical, Ancient Mediterranean and Near Eastern Studies and Archaeology',
                'Slug' => 'Classical, Ancient Mediterranean and Near Eastern Studies and Archaeology',
                'UserID' => '2',
            ),
            172 => 
            array (
                'Created_Date' => NULL,
                'id' => 173,
                'Modified_Date' => NULL,
                'name' => 'Naval Architecture and Marine Engineering',
                'Slug' => 'Naval Architecture and Marine Engineering',
                'UserID' => '2',
            ),
            173 => 
            array (
                'Created_Date' => NULL,
                'id' => 174,
                'Modified_Date' => NULL,
                'name' => 'Natural Sciences',
                'Slug' => 'Natural Sciences',
                'UserID' => '2',
            ),
            174 => 
            array (
                'Created_Date' => NULL,
                'id' => 175,
                'Modified_Date' => NULL,
                'name' => 'Cosmetology, Barber/Styling, and Nail Instructor',
                'Slug' => 'Cosmetology, Barber/Styling, and Nail Instructor',
                'UserID' => '2',
            ),
            175 => 
            array (
                'Created_Date' => NULL,
                'id' => 176,
                'Modified_Date' => NULL,
                'name' => 'System, Networking, and LAN/WAN Management/Manager',
                'Slug' => 'System, Networking, and LAN/WAN Management/Manager',
                'UserID' => '2',
            ),
            176 => 
            array (
                'Created_Date' => NULL,
                'id' => 177,
                'Modified_Date' => NULL,
                'name' => 'Nuclear Engineering',
                'Slug' => 'Nuclear Engineering',
                'UserID' => '2',
            ),
            177 => 
            array (
                'Created_Date' => NULL,
                'id' => 178,
                'Modified_Date' => NULL,
                'name' => 'Network and System Administration/Administrator',
                'Slug' => 'Network and System Administration/Administrator',
                'UserID' => '2',
            ),
            178 => 
            array (
                'Created_Date' => NULL,
                'id' => 179,
                'Modified_Date' => NULL,
                'name' => 'National Security Policy Studies',
                'Slug' => 'National Security Policy Studies',
                'UserID' => '2',
            ),
            179 => 
            array (
                'Created_Date' => NULL,
                'id' => 180,
                'Modified_Date' => NULL,
                'name' => 'Nutrition Sciences',
                'Slug' => 'Nutrition Sciences',
                'UserID' => '2',
            ),
            180 => 
            array (
                'Created_Date' => NULL,
                'id' => 181,
                'Modified_Date' => NULL,
                'name' => 'Energy, Environment, and Natural Resources Law',
                'Slug' => 'Energy, Environment, and Natural Resources Law',
                'UserID' => '2',
            ),
            181 => 
            array (
                'Created_Date' => NULL,
                'id' => 182,
                'Modified_Date' => NULL,
                'name' => 'Neurobiology and Behavior',
                'Slug' => 'Neurobiology and Behavior',
                'UserID' => '2',
            ),
            182 => 
            array (
                'Created_Date' => NULL,
                'id' => 183,
                'Modified_Date' => NULL,
                'name' => 'Human Nutrition',
                'Slug' => 'Human Nutrition',
                'UserID' => '2',
            ),
            183 => 
            array (
                'Created_Date' => NULL,
                'id' => 184,
                'Modified_Date' => NULL,
                'name' => 'Natural Resources Management and Policy',
                'Slug' => 'Natural Resources Management and Policy',
                'UserID' => '2',
            ),
            184 => 
            array (
                'Created_Date' => NULL,
                'id' => 185,
                'Modified_Date' => NULL,
                'name' => 'Natural Resources/Conservation, General',
                'Slug' => 'Natural Resources/Conservation, General',
                'UserID' => '2',
            ),
            185 => 
            array (
                'Created_Date' => NULL,
                'id' => 186,
                'Modified_Date' => NULL,
                'name' => 'Family Practice Nurse/Nursing',
                'Slug' => 'Family Practice Nurse/Nursing',
                'UserID' => '2',
            ),
            186 => 
            array (
                'Created_Date' => NULL,
                'id' => 187,
                'Modified_Date' => NULL,
                'name' => 'Other',
                'Slug' => 'Other',
                'UserID' => '2',
            ),
            187 => 
            array (
                'Created_Date' => NULL,
                'id' => 188,
                'Modified_Date' => NULL,
                'name' => 'Undecided',
                'Slug' => 'Undecided',
                'UserID' => '2',
            ),
            188 => 
            array (
                'Created_Date' => NULL,
                'id' => 189,
                'Modified_Date' => NULL,
                'name' => 'Physics',
                'Slug' => 'Physics',
                'UserID' => '2',
            ),
        ));
        
        
    }
}