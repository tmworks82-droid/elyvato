<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Project Assignment Notification</title>
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
    <h1>Your Project Has Been Assigned</h1>
    <h2>Expert Onboarded</h2>
    <h3>Your project is now officially in motion and our expert has taken charge. Let’s make magic happen!</h3>

    <div class="details-box">
      <p><strong>Service:</strong> {{ $service ?? 'N/A' }}</p>
      <p><strong>Assigned To:</strong> {{ $assigned_to->name ?? $assigned_to->username }}</p>
      <p><strong>Project Title:</strong> {{ $service->name ?? 'N/A' }}</p>
      <p><strong>Status:</strong> Assigned</p>
    </div>

    <p style="margin-top: 25px;">Our specialist will review your requirements and begin execution shortly. Stay tuned for progress updates!</p>

    <p>Thanks again for trusting {{ config('app.name') }}.</p>

    <!-- Footer -->
    <div class="footer">
      Have questions? <a href="mailto:support@{{ request()->getHost() }}" style="color:#ffffff;">Email us</a><br>
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</body>
</html>
