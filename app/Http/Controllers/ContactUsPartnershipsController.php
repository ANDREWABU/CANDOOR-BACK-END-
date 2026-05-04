<?php

namespace App\Http\Controllers;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsPartnershipsController extends Controller
{
    //
    public function contactUS(Request $request)
    {

        $rules=[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ];


        $this->validate($request,$rules);
        $html = 'First Name: '.$request->first_name.'<br>'.
                'Last Name: '.$request->last_name.'<br>'.
                'Email: '.$request->email.'<br>'.
                'Subject: '.$request->subject.'<br>'.
                'Message: '.$request->message;

            Mail::send([], [], function ($message)  use($html){
                $message->to(env('MAIL_SUPPORT'))->subject('[Contact Us Form]');
                $message->from(env("MAIL_FROM_ADDRESS", "support@candoor.com"), 'Candoor')
                    ->setBody($html, 'text/html');;
            });

        $responseData['data']=[];
        $responseData['status']=200;
        $responseData['message']='Request has been processed.';
        return   response()->json($responseData, 200);
    }


    public function partnerWithUs(Request $request)
    {
        $rules=[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'job_title' => 'required',
            'company_name' => 'required',
            'company_size' => 'required',
            'message' => 'required',
        ];

        $this->validate($request,$rules);
        $html = 'First Name: '.$request->first_name.'<br>'.
                'Last Name: '.$request->last_name.'<br>'.
                'Email: '.$request->email.'<br>'.
                'Job Title: '.$request->job_title.'<br>'.
                'Company: '.$request->company_name.'<br>'.
                'Company Size: '.$request->company_size.'<br>'.
                'Message: '.$request->message;

            Mail::send([], [], function ($message)  use($html){
                $message->to(env('MAIL_SUPPORT'))->subject('[Partner with Us Form]');
                $message->from(env("MAIL_FROM_ADDRESS", "support@candoor.com"), 'Candoor')
                    ->setBody($html, 'text/html');;
            });

        $responseData['data']=[];
        $responseData['status']=200;
        $responseData['message']='Request has been processed.';
        return   response()->json($responseData, 200);
    }
}
