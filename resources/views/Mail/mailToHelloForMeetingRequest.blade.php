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
  <div style="border: 1px solid #E4E7EC;margin-bottom: 23px;"></div>

  <div class="mail-img-desc">
   
    <div class="mail-img-sec" style="width: 80%;display: inline-block;padding-left: 20px;">
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Meeting Type: <strong>{{$details['meeting_type_and_duration']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">AdviseeUserID: <strong>{{$details['AdviseeUserID']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">AdviseeID: <strong>{{$details['AdviseeID']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Advisee’s Email: <strong>{{$details['AdviseeEmail']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Advisee’s Timezone: <strong>{{$details['AdviseeTimeZone']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Advisee’s Profile:: <strong>{{$details['AdviseeProfileView']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">AdvisorUserID: <strong>{{$details['AdvisorUserID']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">AdvisorID: <strong>{{$details['AdvisorID']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Advisor’s Email: <strong>{{$details['AdvisorEmail']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Advisor’s Timezone: <strong>{{$details['AdvisorTimeZone']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Advisor’s Profile: <strong>{{$details['AdvisorProfileView']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Advisor’s Preferred Availability: <strong>{{$details['AdvisorAvailability']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Availability (in Advisee’s Timezone): <strong>{{$details['SuggestedTimeraw']}}</strong></p>
      <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif; margin-top: 0px;">Message: <strong>{{$details['RequestMessage']}}</strong></p>
    </div>
  </div>

  <div style="border: 1px solid #E4E7EC;margin-bottom: 23px;"></div>

</div>




</body>
</html>













