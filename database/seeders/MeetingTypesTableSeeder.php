<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MeetingTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('meeting_types')->delete();
        
        \DB::table('meeting_types')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
            'name' => 'Career Advice (Exploration)',
                'tool_tip' => 'Help Advisees discover their strengths, explore career paths and figure out their next step. You don’t have to have all the answers; just share your experiences and perspectives. Why did you choose the career path that you did? What unique skillsets and perspectives have you gained from these experiences?',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
            'name' => 'Career Advice (Preparation)',
                'tool_tip' => 'Help Advisees prepare for their dream roles by sharing what helped you in your own job search. What courses, publications, projects, resources or people helped you the most? What ultimately enabled you to land the role? How were you able to craft your story?',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'name' => 'Job Search Strategy',
                'tool_tip' => 'Help Advisees navigate the recruiting process by sharing your experiences, helping them develop a list of target companies/roles and forming a personalized action plan.',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'name' => 'Networking Strategy',
                'tool_tip' => 'Help Advisees build and maintain their professional network by developing their soft skills or introducing them to relevant people in your own network.',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'name' => 'Resume Review',
                'tool_tip' => 'Help Advisees put their best foot forward by providing detailed, personalized feedback on their resume.',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
                'name' => 'Cover Letter Review',
                'tool_tip' => 'Help Advisees put their best foot forward by providing detailed, personalized feedback on their cover letter.',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'id' => 7,
            'name' => 'Mock Interview (Behavioral)',
                'tool_tip' => 'Conduct a behavioral mock interview and share feedback to help Advisees understand their strengths and areas for improvement.',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'id' => 8,
            'name' => 'Mock Interview (Technical)',
                'tool_tip' => 'Conduct a technical mock interview and share feedback to help Advisees understand their strengths and areas for improvement.',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'id' => 9,
            'name' => 'Career Advice (Advancement)',
                'tool_tip' => 'Help Advisees excel and advance in their current roles by identifying their strengths and opportunities for growth. Share strategies you\'ve used to grow in your own career, as well as tips for navigating performance reviews and offer negotiation.',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'id' => 10,
                'name' => 'Graduate School Application Advice',
                'tool_tip' => 'Help Advisees navigate graduate school admissions and put their best foot forward in the application process.',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => NULL,
                'id' => 11,
                'name' => 'Startup Advice',
            'tool_tip' => 'Help Advisees who are founders tackle key business challenges. Example topics include (but aren’t limited to) customer discovery, ideation, prototyping, pitch deck feedback and fundraising.',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => NULL,
                'id' => 12,
                'name' => 'Offer & Salary Negotiation Strategy',
                'tool_tip' => 'Help Advisees navigate tough conversations & get paid fairly.',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}