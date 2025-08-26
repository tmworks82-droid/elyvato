<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Milestone Payment Update - {{ config('app.name') }}</title>
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
    <h1>We’ve Kicked Things Off</h1>
    <h2>Milestones Created, Advance Confirmed</h2>
    <h3>We've acknowledged your project, set the initial milestones, and received the advance payment. Let's get started!</h3>

    <div class="details-box">
      <p><strong>Project:</strong> {{ $service ?? 'Your Project' }}</p>
      <p><strong>Milestone:</strong> {{ $milestone->title ?? 'N/A' }}</p>
      <p><strong>Amount:</strong> ₹{{ number_format($milestone->amount ?? 0, 2) }}</p>
      <p><strong>Status:</strong> {{ ucfirst($milestone->status ?? 'Pending') }}</p>
    </div>

    <p style="margin-top: 25px;">Complete your milestone payment via your dashboard to keep progress moving smoothly.</p>
    <p>Thanks for trusting {{ config('app.name') }}!</p>

    <!-- Footer -->
    <div class="footer">
      Need assistance? <a href="mailto:support@elyvato.com" style="color:#ffffff;">support@elyvato.com</a><br>
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</body>
</html>
