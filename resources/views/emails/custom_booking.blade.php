<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Strategy Call Is Locked In</title>
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
    .booking-details, .next-steps {
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
    <h1>Your Strategy Call Is Locked In</h1>

    <!-- Main Content -->
    <h2>Let’s Talk Strategy</h2>
    <h3>Your discovery call has been booked. Our team looks forward to understanding your goals and exploring solutions together.</h3>

    <div class="booking-details">
      <h3>Your Booking Summary</h3>
      <p><strong>Service:</strong> {{ $service_name ?? 'N/A' }}</p>
      <p><strong>Status:</strong> {{ ucfirst($booking->status ?? 'pending') }}</p>
      <p><strong>Total Amount:</strong> ₹{{ number_format($booking->price ?? 0, 2) }}</p>
      <p><strong>Requested On:</strong> {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, h:i A') }}</p>
    </div>
      
    

    <div class="next-steps">
      <p><strong>What Happens Next?</strong> Our team is reviewing the details and availability. We will connect with you very soon to confirm your booking and provide further information.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p>If you have any immediate questions, feel free to <a href="mailto:support@{{ request()->getHost() }}" style="color:#ffffff;">contact our support team</a>.</p>
      <p><a href="#" style="color:#ffffff;">Unsubscribe</a> | <a href="{{ url('/booking-list') }}" style="color:#ffffff;">My Bookings</a></p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
