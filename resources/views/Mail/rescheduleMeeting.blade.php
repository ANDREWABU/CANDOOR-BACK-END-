<!DOCTYPE html>
<html lang="en">
<head>
  <title>Candoor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!--  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"> -->
   <!--  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css"> -->
<body>

<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,400;1,700;1,900&display=swap');
body {
    font-family: 'Inter', sans-serif;
    /*font-family: 'Lato', sans-serif;*/
    margin: 0px;
  }
</style>


<div class="mail-messages" style="width: 640px; background: #FFFFFF; margin: 0px auto; padding: 55px; border: 1px solid #ccc;">
  <div class="mail-logo" style="margin-bottom: 50px;">
    <a href="#" style="display: inline-block; width: 160px;"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="" style="max-width: 100%; height: auto;"></a>
  </div>
  <div class="mail-desc">
  <h2 style="font-weight: 700; font-size: 26px; line-height: 24px; color: #313438; margin-bottom: 25px; font-family: 'Inter', sans-serif; margin-top: 0px;"><img src="{{$message->embed(public_path('assets/images/reschedule.png'))}}" class="img-fluid" alt="" style="max-width: 100%;height: auto;display: inline-block;margin-right: 15px;vertical-align: bottom;">  New Time Proposed</h2>
   <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Hi {{ucfirst($details['send_usr_mail'])}},</p>
   <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif;"><strong>{{$details['currentUser_first_name']}} {{$details['currentUser_last_name']}}</strong> has proposed alternate times for your meeting of <strong> {{$details['meeting_type']}}.</strong> </p>

  </div>
  <div style="border: 1px solid #E4E7EC;margin-bottom: 23px;"></div>
  
  <div class="mail-img-desc" style="">
    <div class="mail-img" style="background: linear-gradient(180deg, #67C3F3 0%, #458DFC 100%); width: 75px;height: 75px;border-radius: 100%;padding: 2px;display:inline-block;vertical-align: top;">
      <img style="display: block;border: 2px solid #fff;border-radius: 100%;max-width: 100%;width: 71px;height: 71px;" src="{{$message->embed(public_path($details['profile']))}}" class="img-fluid" alt="">
    </div>
    <div class="mail-img-sec" style="width: 80%;display: inline-block;padding-left: 20px;">
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">{{$details['message']}}</p>
    </div>
  </div>

  <div style="border: 1px solid #E4E7EC;margin-bottom: 23px;"></div>

   <div class="verify-btn" style="margin-bottom: 24px;">
    <a href="{{$details['redirect_url']}}" class="btn btn-info" style="border-radius: 8px !important; background: #458DFC !important; outline: none !important;    box-shadow: none !important; border: none !important; font-weight: 500; font-size: 16px; line-height: 26px; padding: 9px 19px;text-decoration: none; color: #fff;display: block; font-family: 'Inter', sans-serif; text-align: center;">Reply ></a>
   </div>
   <div class="mail-thanks">
    <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Click the button above to confirm a time or suggest an alternate time. We’ll send both of you a calendar invite with a Zoom link once confirmed. Happy connecting!</p>
    <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin: 0px; font-family: 'Inter', sans-serif;">The Candoor team</p>
   </div>

</div>




</body>
</html>