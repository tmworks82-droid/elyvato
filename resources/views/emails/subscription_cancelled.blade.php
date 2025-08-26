<!-- Subscription Cancelled Email -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Subscription Cancelled</title>
  <style>
    body { background-color: #303030; margin: 0; padding: 30px 0; font-family: 'Montserrat', sans-serif; }
    .container { max-width: 600px; background-color: #ffffff; margin: auto; padding: 40px 30px; border-radius: 12px; }
    .logo { margin-bottom: 20px; }
    .logo img { width: 100px; }
    h1 { font-size: 1.5rem; color: #3f4345; margin-bottom: 5px; }
    h2 { font-size: 1.2rem; color: #3f4345; margin-top: 0; }
    h3 { color: #3f4345; font-weight: normal; }
    p { font-size: 16px; color: #3f4345; line-height: 1.6; }
    .btn { display: inline-block; padding: 12px 30px; background-color: #f97a00; color: #ffffff !important; font-weight: 600; border-radius: 8px; margin-top: 20px; text-decoration: none; }
    .footer { text-align: center; margin-top: 40px; color: #ffffff; font-size: 12px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="{{ url('front/assets/images/elyvato-header-logo.png') }}" alt="Elyvato Logo">
    </div>
    <h1>❌ Your Subscription Has Been Cancelled</h1>
    <h2>You've been unsubscribed your booking Elyvato</h2>
    <p>Your subscription has been cancelled successfully. While your premium access is no longer active, you're always welcome back whenever you're ready.</p>

    <p><strong>Status:</strong> Cancelled</p>
    <p><strong>Plan:</strong> {{ $time ?? 'N/A' }}</p>
    <p><strong>Cancelled On:</strong> {{ \Carbon\Carbon::parse($date)->format('d M Y, h:i A') }}</p>

    <a href="{{ url('/user/dashboard') }}" class="btn">Renew Subscription</a>

    <div class="footer">
      <p>Need help? <a href="mailto:support@{{ request()->getHost() }}" style="color:#ffffff;">Contact our support team</a>.</p>
      <p><a href="#" style="color:#ffffff;">Unsubscribe</a> | <a href="{{ url('/dashboard') }}" style="color:#ffffff;">My Account</a></p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
