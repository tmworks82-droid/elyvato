<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reminder Update Profile & Payment Details – Elyvato</title>
</head>
<body style="background:#303030;margin:0;padding:30px 0;font-family:Montserrat,Arial,sans-serif;">

  <div style="max-width:600px;width:100%;background:#ffffff;margin:auto;padding:40px 30px;border-radius:12px;">

    <!-- Logo -->
    <div style="margin-bottom:20px;">
      <img src="{{ url('front/assets/images/elyvato-header-logo.png') }}" alt="Elyvato Logo" style="width:120px;">
    </div>

    <!-- Heading -->
    <h1 style="color:#3f4345;margin:0 0 15px 0;font-size:22px;font-weight:700;">
      Hello {{$user->name?? $user->username}}
    </h1>

    <h2 style="font-size:16px;color:#3f4345;line-height:1.6;">
      Please update your profile and payment details to move to the next step of your onboarding. 🚀
    </h2>
    <h3 style="font-size:16px;color:#3f4345;line-height:1.6;">
      This helps us verify your account and start assigning projects.
    </h3>

  
      <p style="margin:20px 0 0 0;">
        <a href="{{ url('/user/profiles') }}" 
           style="display:inline-block;padding:12px 30px;background:#f97a00;color:#ffffff;
                  font-weight:600;border-radius:8px;text-decoration:none;font-size:15px;" 
           target="_blank">
           Update Profile
        </a>
      </p>
   

    <!-- Footer -->
    <div style="background:#303030;color:#ffffff;text-align:center;padding:15px;
                border-radius:0 0 12px 12px;margin-top:30px;font-size:12px;">
      &copy; {{ date('Y') }} Elyvato. All rights reserved.
    </div>
  </div>
</body>
</html>
