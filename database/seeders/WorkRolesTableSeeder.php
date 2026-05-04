<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorkRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('work_roles')->delete();
        
        \DB::table('work_roles')->insert(array (
            0 => 
            array (
                'Created_Date' => NULL,
                'id' => 1,
                'Modified_Date' => NULL,
                'name' => 'Consulting',
                'Slug' => 'Consulting',
                'UserID' => '2',
            ),
            1 => 
            array (
                'Created_Date' => NULL,
                'id' => 2,
                'Modified_Date' => NULL,
                'name' => 'Business Development',
                'Slug' => 'Business Development',
                'UserID' => '2',
            ),
            2 => 
            array (
                'Created_Date' => NULL,
                'id' => 3,
                'Modified_Date' => NULL,
                'name' => 'Strategy & Planning',
                'Slug' => 'Strategy & Planning',
                'UserID' => '2',
            ),
            3 => 
            array (
                'Created_Date' => NULL,
                'id' => 4,
                'Modified_Date' => NULL,
                'name' => 'Pricing & Revenue Management',
                'Slug' => 'Pricing & Revenue Management',
                'UserID' => '2',
            ),
            4 => 
            array (
                'Created_Date' => NULL,
                'id' => 5,
                'Modified_Date' => NULL,
                'name' => 'Operations',
                'Slug' => 'Operations',
                'UserID' => '2',
            ),
            5 => 
            array (
                'Created_Date' => NULL,
                'id' => 6,
                'Modified_Date' => NULL,
                'name' => 'General Management',
                'Slug' => 'General Management',
                'UserID' => '2',
            ),
            6 => 
            array (
                'Created_Date' => NULL,
                'id' => 7,
                'Modified_Date' => NULL,
                'name' => 'Accounting & Control',
                'Slug' => 'Accounting & Control',
                'UserID' => '2',
            ),
            7 => 
            array (
                'Created_Date' => NULL,
                'id' => 8,
                'Modified_Date' => NULL,
                'name' => 'Compliance, Security & Privacy',
                'Slug' => 'Compliance, Security & Privacy',
                'UserID' => '2',
            ),
            8 => 
            array (
                'Created_Date' => NULL,
                'id' => 9,
                'Modified_Date' => NULL,
                'name' => 'Legal',
                'Slug' => 'Legal',
                'UserID' => '2',
            ),
            9 => 
            array (
                'Created_Date' => NULL,
                'id' => 10,
                'Modified_Date' => NULL,
                'name' => 'Information Technology',
                'Slug' => 'Information Technology',
                'UserID' => '2',
            ),
            10 => 
            array (
                'Created_Date' => NULL,
                'id' => 11,
                'Modified_Date' => NULL,
                'name' => 'Recruiting & Talent Acquisition',
                'Slug' => 'Recruiting & Talent Acquisition',
                'UserID' => '2',
            ),
            11 => 
            array (
                'Created_Date' => NULL,
                'id' => 12,
                'Modified_Date' => NULL,
                'name' => 'Human Resources & People',
                'Slug' => 'Human Resources & People',
                'UserID' => '2',
            ),
            12 => 
            array (
                'Created_Date' => NULL,
                'id' => 13,
                'Modified_Date' => NULL,
                'name' => 'Diversity, Equity & Inclusion',
                'Slug' => 'Diversity, Equity & Inclusion',
                'UserID' => '2',
            ),
            13 => 
            array (
                'Created_Date' => NULL,
                'id' => 14,
                'Modified_Date' => NULL,
                'name' => 'Corporate Finance / Development',
                'Slug' => 'Corporate Finance / Development',
                'UserID' => '2',
            ),
            14 => 
            array (
                'Created_Date' => NULL,
                'id' => 15,
                'Modified_Date' => NULL,
                'name' => 'Supply Chain',
                'Slug' => 'Supply Chain',
                'UserID' => '2',
            ),
            15 => 
            array (
                'Created_Date' => NULL,
                'id' => 16,
                'Modified_Date' => NULL,
                'name' => 'Purchasing',
                'Slug' => 'Purchasing',
                'UserID' => '2',
            ),
            16 => 
            array (
                'Created_Date' => NULL,
                'id' => 17,
                'Modified_Date' => NULL,
                'name' => 'Logistics',
                'Slug' => 'Logistics',
                'UserID' => '2',
            ),
            17 => 
            array (
                'Created_Date' => NULL,
                'id' => 18,
                'Modified_Date' => NULL,
                'name' => 'Research & Development',
                'Slug' => 'Research & Development',
                'UserID' => '2',
            ),
            18 => 
            array (
                'Created_Date' => NULL,
                'id' => 19,
                'Modified_Date' => NULL,
                'name' => 'Sales & Account Management',
                'Slug' => 'Sales & Account Management',
                'UserID' => '2',
            ),
            19 => 
            array (
                'Created_Date' => NULL,
                'id' => 20,
                'Modified_Date' => NULL,
                'name' => 'Customer Support & Success',
                'Slug' => 'Customer Support & Success',
                'UserID' => '2',
            ),
            20 => 
            array (
                'Created_Date' => NULL,
                'id' => 21,
                'Modified_Date' => NULL,
                'name' => 'Teaching',
                'Slug' => 'Teaching',
                'UserID' => '2',
            ),
            21 => 
            array (
                'Created_Date' => NULL,
                'id' => 22,
                'Modified_Date' => NULL,
                'name' => 'Design',
                'Slug' => 'Design',
                'UserID' => '2',
            ),
            22 => 
            array (
                'Created_Date' => NULL,
                'id' => 23,
                'Modified_Date' => NULL,
                'name' => 'User Research & Insights',
                'Slug' => 'User Research & Insights',
                'UserID' => '2',
            ),
            23 => 
            array (
                'Created_Date' => NULL,
                'id' => 24,
                'Modified_Date' => NULL,
                'name' => 'Project / program management',
                'Slug' => 'Project / program management',
                'UserID' => '2',
            ),
            24 => 
            array (
                'Created_Date' => NULL,
                'id' => 25,
                'Modified_Date' => NULL,
                'name' => 'Product management',
                'Slug' => 'Product management',
                'UserID' => '2',
            ),
            25 => 
            array (
                'Created_Date' => NULL,
                'id' => 26,
                'Modified_Date' => NULL,
                'name' => 'Data Analytics / Business Intelligence',
                'Slug' => 'Data Analytics / Business Intelligence',
                'UserID' => '2',
            ),
            26 => 
            array (
                'Created_Date' => NULL,
                'id' => 27,
                'Modified_Date' => NULL,
                'name' => 'Data Science / Machine Learning',
                'Slug' => 'Data Science / Machine Learning',
                'UserID' => '2',
            ),
            27 => 
            array (
                'Created_Date' => NULL,
                'id' => 28,
                'Modified_Date' => NULL,
                'name' => 'Data Architect',
                'Slug' => 'Data Architect',
                'UserID' => '2',
            ),
            28 => 
            array (
                'Created_Date' => NULL,
                'id' => 29,
                'Modified_Date' => NULL,
                'name' => 'Finance - Investment Banking',
                'Slug' => 'Finance - Investment Banking',
                'UserID' => '2',
            ),
            29 => 
            array (
                'Created_Date' => NULL,
                'id' => 30,
                'Modified_Date' => NULL,
                'name' => 'Finance - Sales & Trading',
                'Slug' => 'Finance - Sales & Trading',
                'UserID' => '2',
            ),
            30 => 
            array (
                'Created_Date' => NULL,
                'id' => 31,
                'Modified_Date' => NULL,
                'name' => 'Finance - Research',
                'Slug' => 'Finance - Research',
                'UserID' => '2',
            ),
            31 => 
            array (
                'Created_Date' => NULL,
                'id' => 32,
                'Modified_Date' => NULL,
                'name' => 'Finance - Capital Markets',
                'Slug' => 'Finance - Capital Markets',
                'UserID' => '2',
            ),
            32 => 
            array (
                'Created_Date' => NULL,
                'id' => 33,
                'Modified_Date' => NULL,
                'name' => 'Finance - Quantitiative Finance',
                'Slug' => 'Finance - Quantitiative Finance',
                'UserID' => '2',
            ),
            33 => 
            array (
                'Created_Date' => NULL,
                'id' => 34,
                'Modified_Date' => NULL,
                'name' => 'Finance - Risk Management',
                'Slug' => 'Finance - Risk Management',
                'UserID' => '2',
            ),
            34 => 
            array (
                'Created_Date' => NULL,
                'id' => 35,
                'Modified_Date' => NULL,
                'name' => 'Finance - Private Equity',
                'Slug' => 'Finance - Private Equity',
                'UserID' => '2',
            ),
            35 => 
            array (
                'Created_Date' => NULL,
                'id' => 36,
                'Modified_Date' => NULL,
                'name' => 'Finance - Hedge Funds',
                'Slug' => 'Finance - Hedge Funds',
                'UserID' => '2',
            ),
            36 => 
            array (
                'Created_Date' => NULL,
                'id' => 37,
                'Modified_Date' => NULL,
                'name' => 'Finance - Venture Capital',
                'Slug' => 'Finance - Venture Capital',
                'UserID' => '2',
            ),
            37 => 
            array (
                'Created_Date' => NULL,
                'id' => 38,
                'Modified_Date' => NULL,
                'name' => 'Finance - Investment Management',
                'Slug' => 'Finance - Investment Management',
                'UserID' => '2',
            ),
            38 => 
            array (
                'Created_Date' => NULL,
                'id' => 39,
                'Modified_Date' => NULL,
                'name' => 'Finance - Wealth Management',
                'Slug' => 'Finance - Wealth Management',
                'UserID' => '2',
            ),
            39 => 
            array (
                'Created_Date' => NULL,
                'id' => 40,
                'Modified_Date' => NULL,
                'name' => 'Public Relations & Communications',
                'Slug' => 'Public Relations & Communications',
                'UserID' => '2',
            ),
            40 => 
            array (
                'Created_Date' => NULL,
                'id' => 41,
                'Modified_Date' => NULL,
            'name' => 'Marketing - Digital Marketing (e.g., SEO, SEM, Social, Email Marketing)',
            'Slug' => 'Marketing - Digital Marketing (e.g., SEO, SEM, Social, Email Marketing)',
                'UserID' => '2',
            ),
            41 => 
            array (
                'Created_Date' => NULL,
                'id' => 42,
                'Modified_Date' => NULL,
                'name' => 'Marketing - Product Marketing',
                'Slug' => 'Marketing - Product Marketing',
                'UserID' => '2',
            ),
            42 => 
            array (
                'Created_Date' => NULL,
                'id' => 43,
                'Modified_Date' => NULL,
                'name' => 'Marketing - Brand & Creative',
                'Slug' => 'Marketing - Brand & Creative',
                'UserID' => '2',
            ),
            43 => 
            array (
                'Created_Date' => NULL,
                'id' => 44,
                'Modified_Date' => NULL,
                'name' => 'Electrical engineer',
                'Slug' => 'Electrical engineer',
                'UserID' => '2',
            ),
            44 => 
            array (
                'Created_Date' => NULL,
                'id' => 45,
                'Modified_Date' => NULL,
                'name' => 'Civil engineer',
                'Slug' => 'Civil engineer',
                'UserID' => '2',
            ),
            45 => 
            array (
                'Created_Date' => NULL,
                'id' => 46,
                'Modified_Date' => NULL,
                'name' => 'Mechanical Engineer',
                'Slug' => 'Mechanical Engineer',
                'UserID' => '2',
            ),
            46 => 
            array (
                'Created_Date' => NULL,
                'id' => 47,
                'Modified_Date' => NULL,
                'name' => 'Chemical Engineer',
                'Slug' => 'Chemical Engineer',
                'UserID' => '2',
            ),
            47 => 
            array (
                'Created_Date' => NULL,
                'id' => 48,
                'Modified_Date' => NULL,
                'name' => 'Environmental engineer',
                'Slug' => 'Environmental engineer',
                'UserID' => '2',
            ),
            48 => 
            array (
                'Created_Date' => NULL,
                'id' => 49,
                'Modified_Date' => NULL,
                'name' => 'Aerospace Engineer',
                'Slug' => 'Aerospace Engineer',
                'UserID' => '2',
            ),
            49 => 
            array (
                'Created_Date' => NULL,
                'id' => 50,
                'Modified_Date' => NULL,
                'name' => 'Biomedical Engineer',
                'Slug' => 'Biomedical Engineer',
                'UserID' => '2',
            ),
            50 => 
            array (
                'Created_Date' => NULL,
                'id' => 51,
                'Modified_Date' => NULL,
                'name' => 'Industrial Engineer',
                'Slug' => 'Industrial Engineer',
                'UserID' => '2',
            ),
            51 => 
            array (
                'Created_Date' => NULL,
                'id' => 52,
                'Modified_Date' => NULL,
                'name' => 'Software Engineer - Front-end',
                'Slug' => 'Software Engineer - Front-end',
                'UserID' => '2',
            ),
            52 => 
            array (
                'Created_Date' => NULL,
                'id' => 53,
                'Modified_Date' => NULL,
                'name' => 'Software Engineer - Back-end',
                'Slug' => 'Software Engineer - Back-end',
                'UserID' => '2',
            ),
            53 => 
            array (
                'Created_Date' => NULL,
                'id' => 54,
                'Modified_Date' => NULL,
                'name' => 'Software Engineer - Full stack',
                'Slug' => 'Software Engineer - Full stack',
                'UserID' => '2',
            ),
            54 => 
            array (
                'Created_Date' => NULL,
                'id' => 55,
                'Modified_Date' => NULL,
            'name' => 'Software Engineer - Quality Assurance (Test)',
            'Slug' => 'Software Engineer - Quality Assurance (Test)',
                'UserID' => '2',
            ),
            55 => 
            array (
                'Created_Date' => NULL,
                'id' => 56,
                'Modified_Date' => NULL,
                'name' => 'Software Engineer - DevOps',
                'Slug' => 'Software Engineer - DevOps',
                'UserID' => '2',
            ),
            56 => 
            array (
                'Created_Date' => NULL,
                'id' => 57,
                'Modified_Date' => NULL,
                'name' => 'Software Engineer - Cyber Security',
                'Slug' => 'Software Engineer - Cyber Security',
                'UserID' => '2',
            ),
            57 => 
            array (
                'Created_Date' => NULL,
                'id' => 58,
                'Modified_Date' => NULL,
                'name' => 'Manufacturing Engineer',
                'Slug' => 'Manufacturing Engineer',
                'UserID' => '2',
            ),
            58 => 
            array (
                'Created_Date' => NULL,
                'id' => 59,
                'Modified_Date' => NULL,
                'name' => 'Computer Engineer',
                'Slug' => 'Computer Engineer',
                'UserID' => '2',
            ),
            59 => 
            array (
                'Created_Date' => NULL,
                'id' => 60,
                'Modified_Date' => NULL,
                'name' => 'Materials Engineer',
                'Slug' => 'Materials Engineer',
                'UserID' => '2',
            ),
            60 => 
            array (
                'Created_Date' => NULL,
                'id' => 61,
                'Modified_Date' => NULL,
                'name' => 'Data / Machine Learning Engineer',
                'Slug' => 'Data / Machine Learning Engineer',
                'UserID' => '2',
            ),
            61 => 
            array (
                'Created_Date' => NULL,
                'id' => 62,
                'Modified_Date' => NULL,
                'name' => 'Cloud Architect',
                'Slug' => 'Cloud Architect',
                'UserID' => '2',
            ),
            62 => 
            array (
                'Created_Date' => NULL,
                'id' => 63,
                'Modified_Date' => NULL,
                'name' => 'Other',
                'Slug' => 'Other',
                'UserID' => '2',
            ),
            63 => 
            array (
                'Created_Date' => NULL,
                'id' => 64,
                'Modified_Date' => NULL,
                'name' => 'Undecided',
                'Slug' => 'Undecided',
                'UserID' => '2',
            ),
            64 => 
            array (
                'Created_Date' => NULL,
                'id' => 65,
                'Modified_Date' => NULL,
                'name' => 'Finance - Commercial Banking',
                'Slug' => 'Finance - Commmercial Banking',
                'UserID' => '2',
            ),
        ));
        
        
    }
}