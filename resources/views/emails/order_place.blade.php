<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation - Eventre</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 30px 10px;
        }
        .email-container {
            max-width: 650px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .email-header {
            background-color: #4a90e2;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px;
        }
        .email-body h2 {
            color: #333333;
            margin-top: 0;
        }
        .email-body p {
            font-size: 15px;
            color: #555555;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #f0f0f0;
            text-align: center;
            font-size: 13px;
            color: #777777;
            padding: 20px;
        }
        .email-footer p {
            margin: 5px 0;
        }
        .highlight {
            font-weight: bold;
            color: #000000;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="email-header">
        <h1>Eventre</h1>
        <p>Your Trusted Event Partner</p>
    </div>

    <div class="email-body">
        <h2>Hi {{ $order->name }},</h2>

        <p>Thank you for your booking with <strong>Eventre</strong>! We are excited to help make your event a success.</p>
 
 
        <p><span class="highlight">Name:</span> {{ $order->name }}</p>
        <p><span class="highlight">Booking ID:</span> {{ $order->id }}</p>
       
        <p><span class="highlight">Transaction ID:</span> {{ $order->transaction_id }}</p>
        <p><span class="highlight">Total Amount:</span> BDT {{ $order->total_amount }}</p>

        <p>We will notify you once your booking is confirmed and processing begins. If you have any questions, feel free to contact us anytime.</p>

        <p>Regards,<br><strong>Eventre Team</strong></p>
    </div>

    <div class="email-footer">
        <p>📍 Pallabi, Mitpur-12, Bangladesh</p>
        <p>📞 +8801303810979</p>
        <p>📧 support@eventre.com</p>
        <p>&copy; {{ date('Y') }} Eventre. All rights reserved.</p>
    </div>
</div>

</body>
</html>
