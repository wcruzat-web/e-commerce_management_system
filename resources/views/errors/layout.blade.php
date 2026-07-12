<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            overflow: hidden;
        }

        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border-radius: 32px;
            padding: 48px 48px 44px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: fadeUp 0.6s ease-out;
            position: relative;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #06b6d4, transparent);
            border-radius: 2px;
        }

        .image-wrap {
            width: 220px;
            height: 160px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .code {
            font-size: 112px;
            font-weight: 800;
            background: linear-gradient(135deg, #1e3a5f, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            letter-spacing: -4px;
        }

        .title {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin-top: 8px;
        }

        .message {
            font-size: 15px;
            color: #64748b;
            margin-top: 10px;
            line-height: 1.6;
            max-width: 340px;
            margin-left: auto;
            margin-right: auto;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 28px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: #0f172a;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            border-radius: 14px;
            text-decoration: none;
            transition: all 0.25s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #1e3a5f;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -8px rgba(15, 23, 42, 0.3);
        }

        .btn svg {
            width: 16px;
            height: 16px;
            transition: transform 0.25s ease;
        }

        .btn:hover svg {
            transform: translateX(-3px);
        }

        .btn-outline {
            background: transparent;
            color: #0f172a;
            border: 1.5px solid #e2e8f0;
        }

        .btn-outline:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            box-shadow: none;
        }

        .decor {
            position: fixed;
            border-radius: 50%;
            opacity: 0.06;
            pointer-events: none;
            z-index: -1;
        }

        .decor-1 {
            width: 400px; height: 400px;
            background: #06b6d4;
            top: -120px; right: -80px;
        }

        .decor-2 {
            width: 300px; height: 300px;
            background: #1e3a5f;
            bottom: -100px; left: -60px;
        }

        .decor-3 {
            width: 180px; height: 180px;
            background: #f59e0b;
            bottom: 30%; right: -60px;
        }

        .brand {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            color: #94a3b8;
            letter-spacing: 0.5px;
            font-weight: 400;
        }
    </style>
</head>
<body>
    <div class="decor decor-1"></div>
    <div class="decor decor-2"></div>
    <div class="decor decor-3"></div>

    <div class="card">
        <div class="image-wrap">
            @if(trim($__env->yieldContent('image')))
            <img src="@yield('image')" alt="" onerror="this.style.display='none'">
            @endif
        </div>

        <div class="code">@yield('code')</div>
        <div class="title">@yield('title')</div>
        <div class="message">@yield('message')</div>

        <div class="actions">
            <a href="/" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Back to Home
            </a>
        </div>
    </div>

    <p class="brand">E-Commerce Management System</p>
</body>
</html>
