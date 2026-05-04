<?php

namespace App\Http\Controllers\Api\V2\Advisee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helpers\ApiResponseTrait;

class SubmissionController extends Controller
{
    use ApiResponseTrait;
    
    public function submit(Request $request)
    {
     
        $here_about_us = array(
            "0" => "LinkedIn",
            "1" => "Other Social Media",
            "2" => "Friend",
            "3" => "Colleague",
            "4" => "Search Engine",
            "5" => "School Career Office",
            "6" => "Blog or Article",
            "7" => "Partner Organization",
            "8" => "Employer",
            "9" => "Other",
            "10" => "Know a Founder Personally",
            "11" => "Referred by current user"
        );
        
        $data=[
            'here_about_us' =>$here_about_us,
            
        ];
        if($request->user()->hasRole('Advisor')){
  
            $advisorDT = DB::table('advisors')->where('UserID',$request->user()->id)->select('actively_hiring','hear_about_us','referral_code','consent_to_be_featured')->first();;
            $data=[
                'here_about_us' =>$here_about_us,
                'advisor' => $advisorDT,
            ];
            return $this->respondSuccessWithData($data, "Submission Completed Successfully!",200);

        }elseif($request->user()->hasRole('Advisee')){
            

            $AdviseeDT = DB::table('advisees')->where('UserID',$request->user()->id)->select('apply_notes','hear_about_us','referral_code')->first();
            $data=[
                'here_about_us' =>$here_about_us,
                'advisee' => $AdviseeDT,
            ];
    
            return $this->respondSuccessWithData($data,"Submission Completed Successfully!",200);
        }  
    }
    public function SubmitApplyData(Request $request)
    {
        if($request->user()->hasRole('Advisor')){
            $advisor=DB::table('advisors')->where('UserID',$request->user()->id);
            $advisor->update([            
                'last_funnel_status_update_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'signup_submitted_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
            ]);
            if($request->actively_hiring_confirmation || $request->how_hear_us || $request->referralCode || $request->consent_to_be_featured ){

                if(!empty($request->user()->progress)){
                    $obj = json_decode($request->user()->progress);
                    $progress =  json_decode(json_encode($obj),true);
                    if(array_key_exists("seven_step", $progress)){
                        $advisor=DB::table('advisors')->where('UserID',$request->user()->id);
                        if($request->how_hear_us ){
                            $advisor->update([            
                                // 'actively_hiring_confirmation'=> $request->actively_hiring_confirmation,
                                'actively_hiring' => $request->actively_hiring_confirmation,
                                'hear_about_us'=> $request->how_hear_us,
                                'referral_code'=> $request->referralCode,
                                'consent_to_be_featured' => $request->consent_to_be_featured,
                            ]);
                        }else{
                            $advisor->update([            
                                // 'actively_hiring_confirmation'=> $request->actively_hiring_confirmation,
                                'actively_hiring' => $request->actively_hiring_confirmation,
                            ]);
                        }
                        if($request->referralCode){
                            DB::table('users')->where('id', $request->user()->id)->update([
                                'referral_code_used' => $request->referralCode,
                                'referral_code_used_bool' => 1,
                            ]);
                        }
                        
                        if($request->signup == 1){
                            DB::table('advisors')->where('UserID', $request->user()->id)->update(['funnel_status' => 'Onboarding','first_onboarding_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')]);
                        }
                    }else{
                        $prg_arr = array_merge($progress, ["seven_step" => 1]);
                        $advisor=DB::table('advisors')->where('UserID',$request->user()->id);
                        if($request->how_hear_us ){
                            $advisor->update([            
                                // 'actively_hiring_confirmation'=> $request->actively_hiring_confirmation,
                                'actively_hiring' => $request->actively_hiring_confirmation,
                                'hear_about_us'=> $request->how_hear_us,
                                'referral_code'=> $request->referralCode,
                                'consent_to_be_featured' => $request->consent_to_be_featured,
                            ]);
                        }else{
                            $advisor->update([            
                                // 'actively_hiring_confirmation'=> $request->actively_hiring_confirmation,
                                'actively_hiring' => $request->actively_hiring_confirmation,
                            ]);
                        }
                        if($request->referralCode){
                            DB::table('users')->where('id', $request->user()->id)->update([
                                'referral_code_used' => $request->referralCode,
                                'referral_code_used_bool' => 1,
                            ]);
                        }
                        if($request->signup == 1){
                            DB::table('advisors')->where('UserID', $request->user()->id)->update(['funnel_status' => 'Onboarding','first_onboarding_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')]);
                        }
                        DB::table('users')->where('id', $request->user()->id)->update([
                            'progress' => json_encode($prg_arr),
                        ]);
                    }
                }else{
                    $prg_arr = ["seven_step" => 1 ];
                    $advisor=DB::table('advisors')->where('UserID',$request->user()->id);
                    if($request->how_hear_us ){
                        $advisor->update([            
                            // 'actively_hiring_confirmation'=> $request->actively_hiring_confirmation,
                            'actively_hiring' => $request->actively_hiring_confirmation,
                            'hear_about_us'=> $request->how_hear_us,
                            'referral_code'=> $request->referralCode,
                            'consent_to_be_featured' => $request->consent_to_be_featured,
                        ]);
                    }else{
                        $advisor->update([            
                            // 'actively_hiring_confirmation'=> $request->actively_hiring_confirmation,
                            'actively_hiring' => $request->actively_hiring_confirmation,
                        ]);
                    }
                    if($request->referralCode){
                        DB::table('users')->where('id', $request->user()->id)->update([
                            'referral_code_used' => $request->referralCode,
                            'referral_code_used_bool' => 1,
                        ]);
                    }
                    if($request->signup == 1){
                        DB::table('advisors')->where('UserID', $request->user()->id)->update(['funnel_status' => 'Onboarding','first_onboarding_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')]);
                    }
                    DB::table('users')->where('id', $request->user()->id)->update([
                        'progress' => json_encode($prg_arr),
                    ]);
                }
            }
            return $this->respondSuccess("Submission Completed Successfully!",200);

        }elseif($request->user()->hasRole('Advisee')){
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            $advisee->update([            
                'funnel_status'=>'Career Goals Complete',
                'last_funnel_status_update_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'signup_submitted_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
            ]);
            if($request->belongs_to || $request->how_hear_us || $request->referralCode  ){

                if(!empty($request->user()->progress)){
                    $obj = json_decode($request->user()->progress);
                    $progress =  json_decode(json_encode($obj),true);
                    if(array_key_exists("seven_step", $progress)){
                        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                        $advisee->update([            
                            'apply_notes'=> json_encode($request->belongs_to),
                            'accepted_signup_commitents' => $request->belongs_to?1:0,
                            'hear_about_us'=> $request->how_hear_us,
                            'referral_code'=> $request->referralCode,
                        ]); 
                        if($request->referralCode){
                            DB::table('users')->where('id', $request->user()->id)->update([
                                'referral_code_used_bool' => 1,
                                'referral_code_used' => $request->referralCode,
                            ]);
                        }
                        if($request->signup == 1){
                            DB::table('advisees')->where('UserID', $request->user()->id)->update(['funnel_status' => 'Pending Application Review','application_status' => 'Pending review']);
                        }
                    }else{
                        $prg_arr = array_merge($progress, ["seven_step" => 1]);
                        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                        $advisee->update([            
                            'apply_notes'=> json_encode($request->belongs_to),
                            'accepted_signup_commitents' => $request->belongs_to?1:0,
                            'hear_about_us'=> $request->how_hear_us,
                            'referral_code'=> $request->referralCode,
                        ]); 
                        if($request->referralCode){
                            DB::table('users')->where('id', $request->user()->id)->update([
                                'referral_code_used_bool' => 1,
                                'referral_code_used' => $request->referralCode,
                            ]);
                        }
                        if($request->signup == 1){
                            DB::table('advisees')->where('UserID', $request->user()->id)->update(['funnel_status' => 'Pending Application Review','application_status' => 'Pending review']);
                        }
                        DB::table('users')->where('id', $request->user()->id)->update([
                            'progress' => json_encode($prg_arr),
                        ]);
                    }
                }else{
                    $prg_arr = ["seven_step" => 1 ];
                    $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                    $advisee->update([            
                        'apply_notes'=> json_encode($request->belongs_to),
                        'accepted_signup_commitents' => $request->belongs_to?1:0,
                        'hear_about_us'=> $request->how_hear_us,
                        'referral_code'=> $request->referralCode,
                    ]); 
                    if($request->referralCode){
                        DB::table('users')->where('id', $request->user()->id)->update([
                            'referral_code_used_bool' => 1,
                            'referral_code_used' => $request->referralCode,
                        ]);
                    }
                    if($request->signup == 1){
                        DB::table('advisees')->where('UserID', $request->user()->id)->update(['funnel_status' => 'Pending Application Review','application_status' => 'Pending review']);
                    }
                    DB::table('users')->where('id', $request->user()->id)->update([
                        'progress' => json_encode($prg_arr),
                    ]);
                }
            }

            return $this->respondSuccess("Submission Completed Successfully!",200);
        }
    }
}

