<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Support Reply – Elyvato</title>
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
      color: #000000;
      font-size: 12px;
    }
    .details {
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
    <h1>Support Has Replied to Your Ticket</h1>
    <h2>Hi {{ $user->username ?? $user->name }},</h2>
    <h3> Here are your ticket details:</h3>

    <div class="details">
        <strong>Ticket ID:</strong> {{ $ticket->ticket_id ?? $ticket->id }} <br>
        <strong>Status:</strong> {{ucfirst($ticket->ticket_close)}} <br>
    </div>

    <p style="font-size:14px;color:#3f4345;line-height:1.6;">
      <strong>Support Reply:</strong><br>
      <strong>Reply from {{ $agent->name ?? $agent->username }}:</strong><br>
        {{ $replyMessage ?? 'Our team has updated your ticket. Please check the dashboard for details.' }}
    </p>

    <a href="{{ url('/raise-ticket') }}" class="btn">View My Tickets</a>

    <!-- Footer -->
    <div class="footer">
      Need help? <a href="mailto:support@elyvato.com" style="color:#000000;">Contact Us</a><br>
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</body>
</html>
