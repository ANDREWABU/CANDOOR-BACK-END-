<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IndustriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('industries')->delete();
        
        \DB::table('industries')->insert(array (
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
                'name' => 'Advertising, Public Relations & Marketing',
                'Slug' => 'Advertising, Public Relations & Marketing',
                'UserID' => '2',
            ),
            2 => 
            array (
                'Created_Date' => NULL,
                'id' => 3,
                'Modified_Date' => NULL,
                'name' => 'Aerospace & Defense',
                'Slug' => 'Aerospace & Defense',
                'UserID' => '2',
            ),
            3 => 
            array (
                'Created_Date' => NULL,
                'id' => 4,
                'Modified_Date' => NULL,
                'name' => 'Agriculture',
                'Slug' => 'Agriculture',
                'UserID' => '2',
            ),
            4 => 
            array (
                'Created_Date' => NULL,
                'id' => 5,
                'Modified_Date' => NULL,
                'name' => 'Architecture and Planning',
                'Slug' => 'Architecture and Planning',
                'UserID' => '2',
            ),
            5 => 
            array (
                'Created_Date' => NULL,
                'id' => 6,
                'Modified_Date' => NULL,
                'name' => 'Automotive',
                'Slug' => 'Automotive',
                'UserID' => '2',
            ),
            6 => 
            array (
                'Created_Date' => NULL,
                'id' => 7,
                'Modified_Date' => NULL,
                'name' => 'Construction',
                'Slug' => 'Construction',
                'UserID' => '2',
            ),
            7 => 
            array (
                'Created_Date' => NULL,
                'id' => 8,
                'Modified_Date' => NULL,
                'name' => 'Consumer Products, Retail & E-commerce',
                'Slug' => 'Consumer Products, Retail & E-commerce',
                'UserID' => '2',
            ),
            8 => 
            array (
                'Created_Date' => NULL,
                'id' => 9,
                'Modified_Date' => NULL,
                'name' => 'Design',
                'Slug' => 'Design',
                'UserID' => '2',
            ),
            9 => 
            array (
                'Created_Date' => NULL,
                'id' => 10,
                'Modified_Date' => NULL,
                'name' => 'Education - Higher Education & Academia',
                'Slug' => 'Education - Higher Education & Academia',
                'UserID' => '2',
            ),
            10 => 
            array (
                'Created_Date' => NULL,
                'id' => 11,
                'Modified_Date' => NULL,
                'name' => 'Education - K-12 Education',
                'Slug' => 'Education - K-12 Education',
                'UserID' => '2',
            ),
            11 => 
            array (
                'Created_Date' => NULL,
                'id' => 12,
                'Modified_Date' => NULL,
                'name' => 'Energy & Sustainability',
                'Slug' => 'Energy & Sustainability',
                'UserID' => '2',
            ),
            12 => 
            array (
                'Created_Date' => NULL,
                'id' => 13,
                'Modified_Date' => NULL,
                'name' => 'Fashion & Beauty',
                'Slug' => 'Fashion & Beauty',
                'UserID' => '2',
            ),
            13 => 
            array (
                'Created_Date' => NULL,
                'id' => 14,
                'Modified_Date' => NULL,
                'name' => 'Finance',
                'Slug' => 'Finance',
                'UserID' => '2',
            ),
            14 => 
            array (
                'Created_Date' => NULL,
                'id' => 15,
                'Modified_Date' => NULL,
                'name' => 'Food & Beverage',
                'Slug' => 'Food & Beverage',
                'UserID' => '2',
            ),
            15 => 
            array (
                'Created_Date' => NULL,
                'id' => 16,
                'Modified_Date' => NULL,
                'name' => 'Government & Politics',
                'Slug' => 'Government & Politics',
                'UserID' => '2',
            ),
            16 => 
            array (
                'Created_Date' => NULL,
                'id' => 17,
                'Modified_Date' => NULL,
                'name' => 'Healthcare - Biotechnology, Pharmaceuticals & Life Sciences',
                'Slug' => 'Healthcare - Biotechnology, Pharmaceuticals & Life Sciences',
                'UserID' => '2',
            ),
            17 => 
            array (
                'Created_Date' => NULL,
                'id' => 18,
                'Modified_Date' => NULL,
                'name' => 'Healthcare - Digital & Consumer Health',
                'Slug' => 'Healthcare - Digital & Consumer Health',
                'UserID' => '2',
            ),
            18 => 
            array (
                'Created_Date' => NULL,
                'id' => 19,
                'Modified_Date' => NULL,
                'name' => 'Healthcare - Global / Public Health & Policy',
                'Slug' => 'Healthcare - Global / Public Health & Policy',
                'UserID' => '2',
            ),
            19 => 
            array (
                'Created_Date' => NULL,
                'id' => 20,
                'Modified_Date' => NULL,
                'name' => 'Healthcare - Healthcare Providers',
                'Slug' => 'Healthcare - Healthcare Providers',
                'UserID' => '2',
            ),
            20 => 
            array (
                'Created_Date' => NULL,
                'id' => 21,
                'Modified_Date' => NULL,
                'name' => 'Healthcare - Healthcare Services',
                'Slug' => 'Healthcare - Healthcare Services',
                'UserID' => '2',
            ),
            21 => 
            array (
                'Created_Date' => NULL,
                'id' => 22,
                'Modified_Date' => NULL,
                'name' => 'Healthcare - Medical Devices & Diagnostics',
                'Slug' => 'Healthcare - Medical Devices & Diagnostics',
                'UserID' => '2',
            ),
            22 => 
            array (
                'Created_Date' => NULL,
                'id' => 23,
                'Modified_Date' => NULL,
            'name' => 'Hospitality (e.g., Hotels & Accomodations, Restaurants)',
            'Slug' => 'Hospitality (e.g., Hotels & Accomodations, Restaurants)',
                'UserID' => '2',
            ),
            23 => 
            array (
                'Created_Date' => NULL,
                'id' => 24,
                'Modified_Date' => NULL,
                'name' => 'Human Resources',
                'Slug' => 'Human Resources',
                'UserID' => '2',
            ),
            24 => 
            array (
                'Created_Date' => NULL,
                'id' => 25,
                'Modified_Date' => NULL,
                'name' => 'Insurance',
                'Slug' => 'Insurance',
                'UserID' => '2',
            ),
            25 => 
            array (
                'Created_Date' => NULL,
                'id' => 26,
                'Modified_Date' => NULL,
                'name' => 'Journalism, Media & Publishing',
                'Slug' => 'Journalism, Media & Publishing',
                'UserID' => '2',
            ),
            26 => 
            array (
                'Created_Date' => NULL,
                'id' => 27,
                'Modified_Date' => NULL,
                'name' => 'Law Enforcement',
                'Slug' => 'Law Enforcement',
                'UserID' => '2',
            ),
            27 => 
            array (
                'Created_Date' => NULL,
                'id' => 28,
                'Modified_Date' => NULL,
                'name' => 'Legal Services',
                'Slug' => 'Legal Services',
                'UserID' => '2',
            ),
            28 => 
            array (
                'Created_Date' => NULL,
                'id' => 29,
                'Modified_Date' => NULL,
                'name' => 'Logistics & Supply Chain',
                'Slug' => 'Logistics & Supply Chain',
                'UserID' => '2',
            ),
            29 => 
            array (
                'Created_Date' => NULL,
                'id' => 30,
                'Modified_Date' => NULL,
                'name' => 'Management Consulting',
                'Slug' => 'Management Consulting',
                'UserID' => '2',
            ),
            30 => 
            array (
                'Created_Date' => NULL,
                'id' => 31,
                'Modified_Date' => NULL,
                'name' => 'Manufacturing',
                'Slug' => 'Manufacturing',
                'UserID' => '2',
            ),
            31 => 
            array (
                'Created_Date' => NULL,
                'id' => 32,
                'Modified_Date' => NULL,
                'name' => 'Media, Entertainment & Sports',
                'Slug' => 'Media, Entertainment & Sports',
                'UserID' => '2',
            ),
            32 => 
            array (
                'Created_Date' => NULL,
                'id' => 33,
                'Modified_Date' => NULL,
                'name' => 'Real Estate',
                'Slug' => 'Real Estate',
                'UserID' => '2',
            ),
            33 => 
            array (
                'Created_Date' => NULL,
                'id' => 34,
                'Modified_Date' => NULL,
                'name' => 'Research',
                'Slug' => 'Research',
                'UserID' => '2',
            ),
            34 => 
            array (
                'Created_Date' => NULL,
                'id' => 35,
                'Modified_Date' => NULL,
                'name' => 'Sales & Marketing',
                'Slug' => 'Sales & Marketing',
                'UserID' => '2',
            ),
            35 => 
            array (
                'Created_Date' => NULL,
                'id' => 36,
                'Modified_Date' => NULL,
                'name' => 'Scientific and Technical Consulting',
                'Slug' => 'Scientific and Technical Consulting',
                'UserID' => '2',
            ),
            36 => 
            array (
                'Created_Date' => NULL,
                'id' => 37,
                'Modified_Date' => NULL,
            'name' => 'Social Impact (e.g., Non-Profit/Philanthropy, Private Sector / For-Profit Impact)',
            'Slug' => 'Social Impact (e.g., Non-Profit/Philanthropy, Private Sector / For-Profit Impact)',
                'UserID' => '2',
            ),
            37 => 
            array (
                'Created_Date' => NULL,
                'id' => 38,
                'Modified_Date' => NULL,
                'name' => 'Staffing & Recruiting',
                'Slug' => 'Staffing & Recruiting',
                'UserID' => '2',
            ),
            38 => 
            array (
                'Created_Date' => NULL,
                'id' => 39,
                'Modified_Date' => NULL,
                'name' => 'Technology',
                'Slug' => 'Technology',
                'UserID' => '2',
            ),
            39 => 
            array (
                'Created_Date' => NULL,
                'id' => 40,
                'Modified_Date' => NULL,
                'name' => 'Telecommunications',
                'Slug' => 'Telecommunications',
                'UserID' => '2',
            ),
            40 => 
            array (
                'Created_Date' => NULL,
                'id' => 41,
                'Modified_Date' => NULL,
                'name' => 'Travel & Transportation',
                'Slug' => 'Travel & Transportation',
                'UserID' => '2',
            ),
            41 => 
            array (
                'Created_Date' => NULL,
                'id' => 42,
                'Modified_Date' => NULL,
                'name' => 'Veterinary',
                'Slug' => 'Veterinary',
                'UserID' => '2',
            ),
        ));
        
        
    }
}