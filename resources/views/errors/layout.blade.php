<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        html, body {
            background-color: #f8f9fb;
            color: #636b6f;
            font-family: 'Outfit', sans-serif;
            height: 100vh;
            margin: 0;
        }
        .full-height { height: 100vh; }
        .flex-center { align-items: center; display: flex; justify-content: center; }
        .content { text-align: center; }
        .code { font-size: 96px; font-weight: 700; color: #1e3a5f; line-height: 1; }
        .title { font-size: 24px; font-weight: 600; color: #1e293b; margin-top: 16px; }
        .message { font-size: 15px; color: #64748b; margin-top: 8px; }
        .btn {
            display: inline-block; margin-top: 24px; padding: 10px 24px;
            background: #06b6d4; color: #fff; font-size: 14px; font-weight: 600;
            border-radius: 10px; text-decoration: none; transition: background 0.2s;
        }
        .btn:hover { background: #0891b2; }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="code">@yield('code')</div>
            <div class="title">@yield('title')</div>
            <div class="message">@yield('message')</div>
            <a href="/" class="btn">Back to Home</a>
        </div>
    </div>
</body>
</html>
