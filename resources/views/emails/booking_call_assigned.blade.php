<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Booking Call Assigned</title>
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
    .btn {
      display: inline-block;
      padding: 12px 30px;
      background-color: #f97a00;
      color: #ffffff !important;
      font-weight: 600;
      border-radius: 8px;
      margin-top: 20px;
      text-decoration: none;
    }
    .footer {
      text-align: center;
      margin-top: 40px;
      color: #ffffff;
      font-size: 12px;
    }
    .highlight {
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
    <h1>Your Call Assignment is Live</h1>

    <!-- Content -->
    <h2>Booking Alert for Your Attention</h2>
    <h3>You’ve been assigned a new booking call. Please check your dashboard to view the call details and take necessary actions.</h3>

    <div class="highlight">
      <p><strong>Call Time:</strong> {{ $booking_time }}</p>
    </div>

    <p style="margin-top: 30px;">If you have any questions or need help, don’t hesitate to reach out.</p>

    <!-- Footer -->
    <div class="footer">
      <p>Need help? <a href="mailto:support@elyvato.com" style="color:#ffffff;">support@elyvato.com</a></p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
