<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Project Has Started - {{ config('app.name') }}</title>
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
    <h1>👥 Your Team’s Gearing Up</h1>
    <h2>Freelancers Assigned & Work Started</h2>
    <h3>Your dedicated team has been deployed and your project is officially underway. Stay tuned for progress updates.</h3>

    <div class="details-box">
      <p><strong>Project Name:</strong> {{ $service_name }}</p>
      <p><strong>Status:</strong> Active</p>
      <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($project->started_at)->format('d M Y, h:i A') }}</p>
    </div>

    <p style="margin-top: 25px;">We’ll keep you updated at every step. If you need anything, don’t hesitate to reach out.</p>

    <!-- Footer -->
    <div class="footer">
      <p>Need help? <a href="mailto:support@{{ request()->getHost() }}" style="color:#ffffff;">Contact Support</a></p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
