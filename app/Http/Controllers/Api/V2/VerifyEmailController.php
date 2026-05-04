<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\EmailVerify;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\EmailVerify as SendVerificationMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VerifyEmailController extends Controller
{

    // public function __invoke(Request $request): RedirectResponse
    // {
    //     // dd($request->all());
    //     $user = User::find($request->route('id'));
    //     // dd($user, $user->markEmailAsVerified(), $user->hasVerifiedEmail(),event(new Verified($user)));
    //     if ($user->hasVerifiedEmail()) {
    //         return redirect(env('FRONTEND_URL') . '/email/verify/EmailAlreadyVerify');
    //     }

    //     if ($user->markEmailAsVerified()) {
    //         event(new Verified($user));
    //     }

    //     return redirect(env('FRONTEND_URL') . '/email/verify/EmailVerifySuccess');
    // }

    public function verify($id, $token)
    {
        $user_id = decrypt($id);

        $user = User::where('id',$user_id)->first();

        $user_type=($user->AdviseeID) ? '/' : '/advisor/';
        if (!$user){
            return redirect(env('FRONTEND_URL') .$user_type.'signupwizard/emailVerificationPending');
        }
        User::where('id',$user_id)->update(['email_verified' => true]);

        // if(!empty($user->AdviseeID)){
        //     $funnel_status = DB::table('advisees')->where('UserID', $user->id)->select('funnel_status')->first();
        //         if($funnel_status->funnel_status == "Account Created"){
        //             $advisee= DB::table('advisees')->where('UserID',$user->id)->update([
        //                 'email_verified_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
        //                 'funnel_status'=>'Email Verified',
        //             ]);   
        //         }      
   
        // }
        // else
        // {
        //     $funnel_status = DB::table('advisors')->where('UserID', $user->id)->select('funnel_status')->first();
        //       if($funnel_status->funnel_status == "Account Created"){
        //         $advisor= DB::table('advisors')->where('UserID',$user->id)->update([
        //             'email_verified_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
        //             'funnel_status'=>'Email Verified',
        //           ]);
        //       }
        // }

        return response()->json([
            'message' => 'Your email has now been verified, thank you.'
        ]);

        // return redirect(env('FRONTEND_URL') . $user_type.'signupwizard/emailVerification');

    }

    public function resendEmailVerification(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if($user)
        {
            // $user = $request->user();
            $vToken = Str::random(50);
            $id = encrypt($user->id);

            EmailVerify::updateOrCreate([
                'user_id' => $user->id],[
                'verify_token' => $vToken
            ]);
            $url = \URL::to('api/email/verify/'.$id.'/'.$vToken);

            $details = [
                'email' => $user->email,
                'url'  => $url,
                'firstname' => $user->firstname,
            ];
            \Mail::to($user->email)->send(new SendVerificationMail($details));
            return response()->json([
                'status' => 'success',
                'statusCode' =>200,
                'message' => 'Email Successfully sent'
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'statusCode' =>404,
            'message' => 'Email  Not Exist'
        ]);
        
    }
}
