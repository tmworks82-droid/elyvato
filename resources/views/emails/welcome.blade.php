<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Elyvato</title>
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
            
            width: 90px;
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
            text-align: center;
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
    <div class="content">
      <h1>You’re One of Us Now</h1>
      <h2>Let’s Get Started</h2>
      <h3>We’re thrilled to have you on board. Dive in and explore the possibilities with Elyvato’s smart content services.</h3>

      <a href="{{ url('/login') }}" class="button btn">Explore Now</a>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p>Need help? <a href="mailto:support@elyvato.com">support@elyvato.com</a></p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
