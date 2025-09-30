<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bank Details Verification – Elyvato</title>
</head>
<body style="background:#303030;margin:0;padding:30px 0;font-family:Montserrat,Arial,sans-serif;">

  <div style="max-width:600px;width:100%;background:#ffffff;margin:auto;padding:40px 30px;border-radius:12px;">

    <!-- Logo -->
    <div style="margin-bottom:20px;">
      <img src="{{ url('front/assets/images/elyvato-header-logo.png') }}" alt="Elyvato Logo" style="width:120px;">
    </div>

    <!-- Heading -->
    <h1 style="color:#3f4345;margin:0 0 15px 0;font-size:22px;font-weight:700;">
      Bank Details Verification Status
    </h1>

    <p style="font-size:16px;color:#3f4345;line-height:1.6;">
      Hi {{ $freelancer->name }},
    </p>

    <!-- Status Message -->
    @if($status === 'Verified')
      <p style="font-size:16px;color:#3f4345;line-height:1.6;">
        🎉  Your bank details have been <strong style="color:green;">verified successfully</strong>.  
        You’re all set to receive payments from Elyvato without any delay.
      </p>
    @elseif($status === 'Rejected')
      <p style="font-size:16px;color:#3f4345;line-height:1.6;">
        ❌ Unfortunately, your bank details <strong style="color:red;">could not be verified</strong>.  
        Please review and update your bank information to continue receiving payments.
      </p>
      @if(!empty($remarks))
        <div style="background:#f9f9f9;padding:12px 18px;border-radius:8px;margin:15px 0;">
          <strong>Reason:</strong> {{ $remarks }}
        </div>
      @endif
      <p style="text-align:center;margin:20px 0 0 0;">
        <a href="{{ url('/bank/update') }}" 
           style="display:inline-block;padding:12px 30px;background:#f97a00;color:#ffffff;
                  font-weight:600;border-radius:8px;text-decoration:none;font-size:15px;" 
           target="_blank">
           Update Bank Details
        </a>
      </p>
    @endif

    <!-- Footer -->
    <div style="background:#303030;color:#ffffff;text-align:center;padding:15px;
                border-radius:0 0 12px 12px;margin-top:30px;font-size:12px;">
      &copy; {{ date('Y') }} Elyvato. All rights reserved.
    </div>
  </div>
</body>
</html>
