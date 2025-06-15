<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email ByRead</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #2d3748;
            background-color: #edf2f7;
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
            letter-spacing: 5px;
        }
        .warning {
            color: #718096;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verifikasi Email ByRead</h2>
        
        <p>Halo!</p>
        
        <p>Terima kasih telah mendaftar di ByRead. Untuk melanjutkan, silakan masukkan kode OTP berikut:</p>
        
        <div class="otp-code">
            {{ $otp }}
        </div>
        
        <p>Kode OTP ini akan kadaluarsa dalam 5 menit.</p>
        
        <div class="warning">
            <p>Jika Anda tidak merasa mendaftar di ByRead, silakan abaikan email ini.</p>
        </div>
        
        <p>Salam,<br>Tim ByRead</p>
    </div>
</body>
</html> 