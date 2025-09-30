<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ticket Raised – Elyvato Support</title>
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
    <h1>Your Support Ticket Has Been Raised</h1>
    <h2>Hello {{ $user->username ?? $user->name }},</h2>
    <h3>Thank you for reaching out. 🎫 We’ve received your support request and our team will connect with you soon.  
      Here are your ticket details:</h3>

    <div class="details">
       <strong>Ticket ID:</strong> {{ $ticket->ticket_id ?? $ticket->id }} <br>
        <strong>Issue:</strong> {{ $ticket->describe_issue ?? 'Your reported issue' }} <br>
        <strong>Status:</strong> Open <br>
        <strong>Raised On:</strong> {{ $ticket->created_at->format('d M, Y H:i') }}
    </div>
    <p style="font-size:14px;color:#3f4345;line-height:1.6;">
      Our support team typically responds within <strong>24 hours</strong>. You can track your ticket anytime from your dashboard.
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
