<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
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
        <div class="header">
            <h2>New Contact Form Enquiry</h2>
        </div>
        <div class="info">
            <p><span>Name:</span> {{ $contact['name'] }}</p>
            <p><span>Email:</span> {{ $contact['email'] }}</p>
            <p><span>Phone:</span> {{ $contact['phone'] ?? 'Not Provided' }}</p>
            <p><span>Service:</span> {{ $contact['service'] ?? 'Not Specified' }}</p>
            <p><span>Message:</span></p>
            <p style="margin-left: 20px; border-left: 3px solid #007bff; padding-left: 10px;">
                {{ $contact['message'] ?? 'No message provided.' }}
            </p>
        </div>
        <div class="footer">
            <p>This message was sent from your website contact form.</p>
        </div>
    </div>
</body>
</html>
