<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reminder from Elyvato</title>
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
  </style>
</head>
<body>
  <div class="container">
    <!-- Logo -->
    <div class="logo">
      <img src="{{ url('front/assets/images/elyvato-header-logo.png') }}" alt="Elyvato Logo">
    </div>

    <!-- Content -->
    <h1>A Quick Nudge — You're Up</h1>
    <h2>Don’t Miss the Deadline</h2>
    <h3>This is a gentle reminder to take necessary action on your current project step or feedback.</h3>

    <a href="{{ url('/user/dashboard') }}" class="btn" target="_blank">Visit Dashboard</a>

    <!-- Footer -->
    <div class="footer">
      &copy; {{ date('Y') }} Elyvato. All rights reserved.
    </div>
  </div>
</body>
</html>
