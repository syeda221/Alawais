<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Al-Owais Petroleum Service | Prowave Technologies</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body, html {
            height: 100%;
            overflow-x: hidden;
            background: #051d18;
        }

        .main-container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: linear-gradient(135deg, #051d18 0%, #093028 40%, #0e4c3a 75%, #156d53 100%);
            overflow: hidden;
        }

        /* Ambient Glowing Background Orbs */
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            opacity: 0.65;
        }

        .orb-1 {
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.3) 0%, transparent 70%);
            top: -120px;
            left: -100px;
            animation: pulse-slow 9s ease-in-out infinite alternate;
        }

        .orb-2 {
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.25) 0%, transparent 70%);
            bottom: -140px;
            right: -120px;
            animation: pulse-slow 11s ease-in-out infinite alternate-reverse;
        }

        .orb-3 {
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.2) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes pulse-slow {
            0% { transform: scale(1); opacity: 0.55; }
            100% { transform: scale(1.15); opacity: 0.85; }
        }

        /* Subtle Grid Pattern Overlay */
        .grid-pattern {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.035) 1px, transparent 1px);
            background-size: 45px 45px;
            pointer-events: none;
        }

        /* Glass Content Box */
        .content-box {
            position: relative;
            z-index: 10;
            max-width: 560px;
            width: 100%;
            padding: 48px 40px;
            background: rgba(14, 76, 58, 0.38);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 26px;
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.45), 
                        inset 0 1px 0 rgba(255, 255, 255, 0.2);
            text-align: center;
            color: #ffffff;
            animation: fadeInScale 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }



        h1 {
            font-size: 2.1rem;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 12px;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 32px;
            max-width: 440px;
            margin-left: auto;
            margin-right: auto;
        }

        .login-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px 38px;
            border-radius: 14px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            font-size: 15.5px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.3px;
            transition: all 0.25s ease;
            box-shadow: 0 10px 25px -4px rgba(16, 185, 129, 0.5),
                        inset 0 1px 0 rgba(255, 255, 255, 0.25);
            cursor: pointer;
            border: none;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #34d399 0%, #059669 100%);
            box-shadow: 0 14px 32px -4px rgba(16, 185, 129, 0.65);
            color: #ffffff;
        }

        .login-btn i {
            transition: transform 0.2s ease;
        }

        .login-btn:hover i {
            transform: translateX(4px);
        }

        .footer-note {
            margin-top: 26px;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 12px;
            color: rgba(255, 255, 255, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        @media (max-width: 576px) {
            .content-box {
                padding: 36px 24px;
            }
            h1 {
                font-size: 1.7rem;
            }
            .subtitle {
                font-size: 13.5px;
            }
            .login-btn {
                width: 100%;
                padding: 14px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Ambient Glowing Orbs -->
        <div class="bg-orb orb-1"></div>
        <div class="bg-orb orb-2"></div>
        <div class="bg-orb orb-3"></div>

        <!-- Decorative Grid -->
        <div class="grid-pattern"></div>

        <!-- Glass Content Box -->
        <div class="content-box">
            <h1>Welcome to Prowave Technologies</h1>
            
            <p class="subtitle">
                Enterprise fuel station billing, inventory tracking, accounts ledger and sales management portal.
            </p>

            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="login-btn">
                    <span>Admin Login</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            @endif

            <div class="footer-note">
                <i class="far fa-copyright"></i> {{ date('Y') }} Al-Owais Petroleum Service • Powered by Prowave Technologies
            </div>
        </div>
    </div>
</body>
</html>
