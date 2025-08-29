<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Successful</title>
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
    .paid-amount {
      margin-top: 20px;
      font-size: 16px;
      color: #3f4345;
      font-weight: bold;
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
    <h1>Payment Done. Let’s Get Building</h1>
    <h2>You're All Set</h2>
    <h3>We’ve received your payment. Your project is now moving forward as per the discussed timeline.</h3>

    @if(isset($paid))
    <div class="paid-amount">
      You paid: ₹{{ number_format($paid, 2) }}
    </div>
    @endif

    <a href="{{ url('/user/dashboard') }}" class="btn">Go to Dashboard</a>

    <!-- Footer -->
    <div class="footer">
      <p>Need help? <a href="mailto:support@{{ request()->getHost() }}" style="color:#000000;">Contact Support</a></p>
      <p><a href="#" style="color:#000000;">Unsubscribe</a> | <a href="{{ url('/booking-list') }}" style="color:#000000;">My Bookings</a></p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
