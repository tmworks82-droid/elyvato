<!-- Subscription Status Update to Manager -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Subscription Update</title>
  <style>
    body { background-color: #303030; margin: 0; padding: 30px 0; font-family: 'Montserrat', sans-serif; }
    .container { max-width: 600px; background-color: #ffffff; margin: auto; padding: 40px 30px; border-radius: 12px; }
    .logo { margin-bottom: 20px; }
    .logo img { width: 100px; }
    h1 { font-size: 1.5rem; color: #3f4345; margin-bottom: 5px; }
    h2 { font-size: 1.2rem; color: #3f4345; margin-top: 0; }
    p { font-size: 16px; color: #3f4345; line-height: 1.6; }
    .info-box { margin-top: 20px; background: #f7f7f7; padding: 20px; border-radius: 8px; }
    .footer { text-align: center; margin-top: 40px; color: #ffffff; font-size: 12px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="{{ url('front/assets/images/elyvato-header-logo.png') }}" alt="Elyvato Logo">
    </div>

    <h1>📢 Subscription {{ ucfirst($status) }} Alert</h1>
    <h2>User {{ ucfirst($status) }} Their Subscription</h2>

    <p>The following user has {{ strtolower($status)}} their subscription:</p>

    <div class="info-box">
      <p><strong>Name:</strong> {{ $user->name ?? 'N/A' }}</p>
      <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
      <p><strong>Booking ID:</strong> {{ $booking_id ?? 'N/A' }}</p>
      <p><strong>Subscription Plan:</strong> {{ $time ?? 'N/A' }}</p>
      <p><strong>Status:</strong> {{ ucfirst($status) }}</p>
      <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($date)->format('d M Y, h:i A') }}</p>
    </div>

    <p>You can review this update in the admin dashboard.</p>

    <div class="footer">
      <p>For assistance, contact: <a href="mailto:support@{{ request()->getHost() }}" style="color:#ffffff;">support@{{ request()->getHost() }}</a></p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
