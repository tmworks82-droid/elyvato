<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
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
            color: #000000;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{url('front/assets/images/elyvato-header-logo.png')}}" alt="Elyvato Logo">
        </div>
        <h1>No Worries — Let’s Reset It</h1>
        <h2>We’ve Got You</h2>
        <h3>Click the link below to securely reset your password and regain access to your account.</h3>
        <p><a href="{{ $resetLink }}" class="btn">Reset Password</a></p>
        <p>If you didn’t request this change, you can safely ignore this email.</p>
        <p>Thank you!<br>Team Elyvato</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Elyvato. All rights reserved. <br>
        For support, <a href="mailto:support@elyvato.com" style="color:#000000;">contact us</a>.
    </div>
</body>
</html>
