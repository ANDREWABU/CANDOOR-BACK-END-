<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuizTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('quiz')->delete();
        
        \DB::table('quiz')->insert(array (
            0 => 
            array (
                'answere' => 'All of the above',
                'created_at' => '2022-05-29 06:44:36',
                'display_type' => 'radio',
                'id' => 1,
                'options' => '[{"option1":"Where you grow up","option2":"Where you went to school","option3":"Where you’ve worked","option4":"All of the above"}]',
                'question' => 'Which of the following factors significantly contribute to the strength of one’s professional network?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:36',
                'UserID' => '1',
            ),
            1 => 
            array (
                'answere' => 'All of the above',
                'created_at' => '2022-05-29 06:44:36',
                'display_type' => 'radio',
                'id' => 2,
                'options' => '[{"option1":"Career advice","option2":"Networking strategies","option3":"Job search strategies","option4":"Resume reviews","option5":"Mock interviews","option6":"Personalized feedback","option7":"All of the above"}]',
                'question' => 'What kinds of support can you offer as an Advisor?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:36',
                'UserID' => '1',
            ),
            2 => 
            array (
                'answere' => 'Go to Settings',
                'created_at' => '2022-05-29 06:44:36',
                'display_type' => 'radio',
                'id' => 3,
                'options' => '[{"option1":"Go to My Profile","option2":"Go to Settings","option3":"Ping a Candoor employee via Slack","option4":"Email the Candoor team"}]',
                'question' => 'How do you change your monthly capacity or general availability?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:36',
                'UserID' => '1',
            ),
            3 => 
            array (
                'answere' => 'The link in the calendar invite or Candoors home page',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 4,
                'options' => '[{"option1":"The link in the calendar invite or Candoors home page","option2":"Over email","option3":"Over text"}]',
                'question' => 'Where do you reschedule a confirmed meeting? Select all that apply.',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '1',
            ),
            4 => 
            array (
                'answere' => 'Stay in touch with Advisees on a longer-term basis',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 5,
                'options' => '[{"option1":"Be available for at least one Advisee conversation per month","option2":"Respond to meeting requests within 2 business days","option3":"Respect the meeting time allotted","option4":"Stay in touch with Advisees on a longer-term basis","option5":"Follow through on any commitments made"}]',
                'question' => 'Which of the following is NOT an expectation of a Candoor Advisor?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '1',
            ),
            5 => 
            array (
                'answere' => '12 hours',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 6,
                'options' => '[{"option1":"6 hours","option2":"12 hours","option3":"24 hours","option4":"48 hours"}]',
                'question' => 'How far in advance do you need to reschedule a meeting?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '1',
            ),
            6 => 
            array (
                'answere' => 'File a complaint via the “Share Feedback” page',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 7,
                'options' => '[{"option1":"Nothing","option2":"Ping a Candoor employee via Slack","option3":"File a complaint via the “Share Feedback” page"}]',
                'question' => 'If I witness someone violating the Rules of Conduct, what should I do?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '1',
            ),
            7 => 
            array (
                'answere' => 'Be constructive and positive with feedback',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 8,
                'options' => '[{"option1":"Offer help you don’t intend to follow up on","option2":"Write emails, cover letters, resume bullets, etc. on their behalf","option3":"Be constructive and positive with feedback","option4":"Avoid difficult topics because you may not be able to relate directly to them"}]',
                'question' => 'What should you DO during a meeting with an Advisee?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '1',
            ),
            8 => 
            array (
                'answere' => 'Assume that what worked for you will work for others',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 9,
                'options' => '[{"option1":"Be your authentic self","option2":"Assume that what worked for you will work for others","option3":"Actively listen and ask open-ended questions that encourage Advisees to share their perspectives","option4":"Encourage Advisees to retain their own voice in emails, cover letters, etc."}]',
                'question' => 'What should you AVOID doing during a meeting with an Advisee?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '1',
            ),
            9 => 
            array (
                'answere' => 'All of the above',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 10,
            'options' => '[{"option1":"Get to know your Advisee personally (not just professionally)","option2":"Make intros to connect Advisees with relevant people in your own network","option3":"Check in with your Advisee periodically to support their continued progress and growth","option4":"All of the above"}]',
                'question' => 'What are some ways to turn one-off conversations into more impactful, longer-term professional relationships?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '1',
            ),
            10 => 
            array (
                'answere' => '',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 11,
                'options' => '[{"option1":"1 - Very unprepared","option2":"2 - Unprepared","option3":"3 - Neither prepared nor unprepared","option4":"4 - Prepared","option5":"5 - Very Prepared","option6":"Prefer not to answer"}]',
                'question' => 'On a scale of 1 to 5, how prepared do you feel to support Candoor’s Advisees?',
                'type' => 'Advisor',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '1',
            ),
            11 => 
            array (
                'answere' => 'All of the above',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 12,
                'options' => '[{"option1":"Where you grow up","option2":"Where you went to school","option3":"Where you’ve worked","option4":"All of the above"}]',
                'question' => 'Which of the following factors significantly contribute to the strength of one’s professional network?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '2',
            ),
            12 => 
            array (
                'answere' => 'All of the above',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 13,
                'options' => '[{"option1":"Career advice","option2":"Networking strategies","option3":"Job search strategies","option4":"Resume reviews","option5":"Mock interviews","option6":"Personalized feedback","option7":"All of the above"}]',
                'question' => 'What kinds of support do Candoor’s Advisors offer?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '2',
            ),
            13 => 
            array (
                'answere' => '2',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 14,
                'options' => '[{"option1":"1","option2":"2","option3":"3","option4":"4"}]',
                'question' => 'How many Advisors can you reach out to each month?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '2',
            ),
            14 => 
            array (
                'answere' => 'The link in the calendar invite or Candoors home page',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 15,
                'options' => '[{"option1":"The link in the calendar invite or Candoors home page","option2":"Over email","option3":"Over text"}]',
                'question' => 'Where do you reschedule a confirmed meeting? Select all that apply.',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '2',
            ),
            15 => 
            array (
                'answere' => '12 hours',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 16,
                'options' => '[{"option1":"6 hours","option2":"12 hours","option3":"24 hours","option4":"48 hours"}]',
                'question' => 'How far in advance do I need to reschedule a meeting?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '2',
            ),
            16 => 
            array (
                'answere' => 'All of the above',
                'created_at' => '2022-05-29 06:44:37',
                'display_type' => 'radio',
                'id' => 17,
                'options' => '[{"option1":"Come to meetings prepared","option2":"Respect the allotted meeting time","option3":"Send a thank-you note after every conversation","option4":"Follow up with Advisors about commitments","option5":"All of the above"}]',
                'question' => 'What are the expectations of a Candoor Advisee?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:37',
                'UserID' => '2',
            ),
            17 => 
            array (
                'answere' => 'File a complaint via the “Share Feedback” page',
                'created_at' => '2022-05-29 06:44:38',
                'display_type' => 'radio',
                'id' => 18,
                'options' => '[{"option1":"Nothing","option2":"Ping a Candoor employee via Slack","option3":"File a complaint via the “Share Feedback” page"}]',
                'question' => 'If I witness someone violating the Rules of Conduct, what should I do?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:38',
                'UserID' => '2',
            ),
            18 => 
            array (
                'answere' => 'All of the above',
                'created_at' => '2022-05-29 06:44:38',
                'display_type' => 'radio',
                'id' => 19,
                'options' => '[{"option1":"Research the Advisor’s profile & background thoroughly","option2":"Prepare a meeting agenda with thoughtful, non-generic questions","option3":"Practice your introduction","option4":"All of the above"}]',
                'question' => 'How do you prepare for a meeting with an Advisor?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:38',
                'UserID' => '2',
            ),
            19 => 
            array (
                'answere' => 'Ask for a job, connection or employee referral up front',
                'created_at' => '2022-05-29 06:44:38',
                'display_type' => 'radio',
                'id' => 20,
                'options' => '[{"option1":"Be your authentic self","option2":"Ask open-ended questions instead of “yes” or “no” questions","option3":"Ask for a job, connection or employee referral up front","option4":"Ask for feedback on your candidacy and interview readiness"}]',
                'question' => 'What should you AVOID doing during the first meeting with an Advisor?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:38',
                'UserID' => '2',
            ),
            20 => 
            array (
                'answere' => 'All of the above',
                'created_at' => '2022-05-29 06:44:38',
                'display_type' => 'radio',
                'id' => 21,
                'options' => '[{"option1":"Ask your Advisor how you can help them","option2":"Thank the Advisor during and after the call","option3":"Follow up with the Advisor to update them on your progress and growth","option4":"All of the above"}]',
                'question' => 'What are some ways to turn one-off conversations into longer-term professional connections?',
                'type' => 'Advisee',
                'updated_at' => '2022-05-29 06:44:38',
                'UserID' => '2',
            ),
            21 => 
            array (
                'answere' => NULL,
                'created_at' => NULL,
                'display_type' => 'radio',
                'id' => 22,
                'options' => '[{"option1":"1 - Very unprepared","option2":"2 - Unprepared","option3":"3 - Neither prepared nor unprepared","option4":"4 - Prepared"},"option5":"5 - Very Prepared","option6":"Prefer not to answer"]',
                'question' => 'On a scale of 1 to 5, how prepared do you feel to network with Candoor’s Advisors?',
                'type' => 'advisee',
                'updated_at' => NULL,
                'UserID' => '2',
            ),
        ));
        
        
    }
}