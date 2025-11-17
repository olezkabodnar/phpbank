<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bank Security Code</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #212121;
            color: #ffffff;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: #2d2d2d;
            border-radius: 16px;
            padding: 32px;
            text-align: center;
        }
        .title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 24px;
            color: #ffffff;
        }
        .code-container {
            background: #1a1a1a;
            border: 2px solid #424242;
            border-radius: 12px;
            padding: 24px;
            margin: 24px 0;
        }
        .security-code {
            font-size: 36px;
            font-weight: bold;
            color: #e87f0c;
            letter-spacing: 8px;
            font-family: monospace;
        }
        .info {
            color: #9e9e9e;
            font-size: 14px;
            margin: 16px 0;
        }
        .footer {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #424242;
            color: #757575;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title"> PHP Bank - Verification Code</div>
        
        <div class="code-container">
            <div class="security-code">{{ $code }}</div>
        </div>
        
        <div class="info">Enter this code to complete your login</div>
        
        <div class="footer">
            PHP Bank Security Team
        </div>
    </div>
</body>
</html>