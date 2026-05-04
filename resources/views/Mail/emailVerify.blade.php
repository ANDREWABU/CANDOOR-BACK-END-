<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Candoor</title>
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,400;1,700;1,900&display=swap');
            body {
                font-family: 'Inter', sans-serif;
                /*font-family: 'Lato', sans-serif;*/
                margin: 0px;
            }
        </style>
    </head>
    <body>
        <div class="mail-messages" style="width: 640px; background: #FFFFFF; margin: 0px auto; padding: 55px; border: 1px solid #ccc;">
        <div class="mail-logo" style="margin-bottom: 50px;">
            <a href="#" style="display: inline-block; width: 160px;"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="" style="max-width: 100%; height: auto;"></a>
        </div>
        <div class="mail-desc">
        <h2 style="font-weight: 700; font-size: 26px; line-height: 24px; color: #313438; margin-bottom: 25px; font-family: 'Inter', sans-serif;">Verify Your Email Address</h2>
        <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif;">Hi {{ucfirst($details['firstname'])}},</p>
        <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin-bottom: 24px; font-family: 'Inter', sans-serif;">Thank you for joining Candoor - we're excited to have you! Click the link below to verify your email and continue the sign-up process.</p>
        </div>
        <div class="verify-btn" style="margin-bottom: 24px;">
            <a href="{{$details['url']}}" class="btn btn-info" style="border-radius: 8px !important; background: #458DFC !important; outline: none !important;    box-shadow: none !important; border: none !important; font-weight: 500; font-size: 16px; line-height: 26px; padding: 9px 19px;text-decoration: none; color: #fff;display: block; font-family: 'Inter', sans-serif; text-align:center;">Verify Your Email Address</a>
        </div>
        <div class="mail-thanks">
            <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #344054; margin: 0px; font-family: 'Inter', sans-serif;">Thanks,
        <span style="display: block;">The Candoor team</span></p>
        </div>
        <div class="mail-coptright" style="padding-top: 40px; margin-bottom: 40px;">
            <p style="font-weight: 400; font-size: 14px; line-height: 20px; color: #667085; margin: 0px; font-family: 'Inter', sans-serif;">© 2022 Candoor</p>
        </div>
            <div class="mail-footer-logo">
            <a href="#" class="mailfooter-logo" style="display: inline-block; width: 120px;"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" alt="" style="max-width: 100%; height: auto;"></a>
            <ul style="margin: 0px; padding: 0px; list-style: none; float: right;">
            <li style="display: inline-block; margin-left: 15px;"><a href="#"><img src="{{asset('assets/images/mail-icon1.png')}}" class="img-fluid" alt="" style="max-width: 100%; height: auto;"></a></li>
            <li style="display: inline-block; margin-left: 15px;"><a href="#"><img src="{{asset('assets/images/mail-icon2.png')}}" class="img-fluid" alt="" style="max-width: 100%; height: auto;"></a></li>
            <li style="display: inline-block; margin-left: 15px;"><a href="#"><img src="{{asset('assets/images/mail-icon3.png')}}" class="img-fluid" alt="" style="max-width: 100%; height: auto;"></a></li>
            </ul>
            </div>

        </div>
    </body>
</html>