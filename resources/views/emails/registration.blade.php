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
            text-align: center;
        }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="{{ url('front/assets/images/elyvato-header-logo.png') }}" alt="Elyvato Logo">
    </div>

    <h1>You’re In! Welcome to Elyvato</h1>
    <h2>Your journey starts here</h2>
    <h3>Thank you for registering with Elyvato. Explore our platform and discover top-tier content solutions tailored for your needs.</h3>

    <div class="credentials">
      <p><strong>Email:</strong> {{ $email }}</p>
      <p><strong>Password:</strong> {{ $password }}</p>
    </div>

    <p><a href="{{ url('/login') }}" class="button btn" target="_blank">Login to Dashboard</a></p>

    <div class="footer">
      &copy; {{ date('Y') }} Elyvato. All rights reserved.
    </div>
  </div>
</body>
</html>
