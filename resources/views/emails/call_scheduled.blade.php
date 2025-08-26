<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Call Has Been Scheduled</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background-color: #303030;
      margin: 0;
      padding: 30px 0;
      font-family: 'Montserrat', sans-serif;
    }
    .container {
      max-width: 600px;
      background-color: #ffffff;
      margin: auto;
      padding: 40px 30px;
      border-radius: 12px;
    }
    .logo {
      margin-bottom: 20px;
    }
    .logo img {
      width: 100px;
    }
    h1 {
      color: #3f4345;
      margin-bottom: 5px;
    }
    h2 {
      color: #3f4345;
      margin-top: 0;
    }
    h3 {
      color: #3f4345;
      font-weight: normal;
    }
    p {
      font-size: 16px;
      color: #3f4345;
      line-height: 1.6;
    }
    .btn, .meeting-link {
      display: inline-block;
      padding: 12px 30px;
      background-color: #0000FF;
      color: #ffffff !important;
      font-weight: 600;
      border-radius: 8px;
      margin-top: 20px;
      text-decoration: none;
    }
    .footer {
      text-align: center;
      margin-top: 40px;
      color: black;
      font-size: 12px;
    }
    .details-box {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header -->
    <div class="logo">
      <img src="{{ url('front/assets/images/elyvato-header-logo.png') }}" alt="Elyvato Logo">
    </div>

    <!-- Content -->
    <h1>Meet Your Guide to Great Content</h1>
    <h2>You're in Expert Hands</h2>
    <h3>Your call is scheduled and an Account Manager has been assigned. They will guide you throughout your Elyvato journey.</h3>

    

    <div class="details-box" style="margin-top:20px; font-family:'Montserrat', Arial, sans-serif; color:#3f4345; font-size:15px; line-height:1.6;">
    <p><strong>{{ $user->username ?? 'Guest' }}</strong></p>

    <p>
        {{ \Carbon\Carbon::parse($date_time)->format('l, F d') }} · 
        {{ \Carbon\Carbon::parse($date_time)->format('g:i A') }} – 
        {{ \Carbon\Carbon::parse($date_time)->addHour()->format('g:i A') }}
    </p>

    <p>Time zone: Asia/Kolkata</p>

    <p><strong>Google Meet joining info:</strong></p>
    <p>Video call link: <a href="{{ $call_link }}" target="_blank">{{ $call_link }}</a></p>

    <p><strong>Notes:</strong> {{ $notes ?? 'No additional notes provided.' }}</p>
    <a href="{{ $call_link }}" class="meeting-link btn-primary" target="_blank">Join Call</a>
</div>


    <!-- Footer -->
    <div class="footer">
      <p>Need help? <a href="mailto:support@{{ request()->getHost() }}" style="color:black;">Contact Support</a></p>
      <p><a href="#" style="color:black;">Unsubscribe</a> | <a href="{{ url('/booking-list') }}" style="color:#black;">My Bookings</a></p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
