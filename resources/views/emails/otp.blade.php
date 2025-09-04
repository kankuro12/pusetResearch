<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type === 'password_reset' ? 'Password Reset Code' : 'Email Verification Code' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #55c3b7;
        }
        .content {
            margin-bottom: 30px;
        }
        .otp-code {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: linear-gradient(90deg, #55c3b7 0, #5fd0a5 48%, #66da90 100%);
            border-radius: 10px;
        }
        .otp-number {
            font-size: 32px;
            font-weight: bold;
            color: white;
            letter-spacing: 8px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">{{ config('app.name') }}</div>
            <h1>{{ $type === 'password_reset' ? 'Password Reset' : 'Email Verification' }}</h1>
        </div>

        <div class="content">
            @if($userName)
                <p>Hello {{ $userName }},</p>
            @else
                <p>Hello,</p>
            @endif

            @if($type === 'password_reset')
                <p>You have requested to reset your password. Please use the following OTP code to proceed:</p>
            @else
                <p>Thank you for registering with {{ config('app.name') }}! Please use the following OTP code to verify your email address:</p>
            @endif

            <div class="otp-code">
                <div style="color: white; font-size: 16px;">Your OTP Code</div>
                <div class="otp-number">{{ $otp }}</div>
            </div>

            @if($type === 'password_reset')
                <p>Enter this code on the password reset page to create a new password.</p>
            @else
                <p>Enter this code on the verification page to activate your account.</p>
            @endif

            <div class="warning">
                <strong>Important:</strong> This OTP will expire in 10 minutes. Do not share this code with anyone.
            </div>

            @if($type === 'password_reset')
                <p>If you didn't request a password reset, please ignore this email and your account will remain secure.</p>
            @else
                <p>If you didn't create an account with us, please ignore this email.</p>
            @endif
        </div>

        <div class="footer">
            <p>This is an automated message from {{ config('app.name') }}. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
