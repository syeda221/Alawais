<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Login | Al-Owais Petroleum Service</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            /* Software Signature Petrol Gradient */
            background: linear-gradient(135deg, #051d18 0%, #093028 40%, #0e4c3a 75%, #156d53 100%);
            position: relative;
            overflow-x: hidden;
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
            width: 440px;
            height: 440px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.28) 0%, transparent 70%);
            top: -120px;
            left: -100px;
            animation: pulse-slow 8s ease-in-out infinite alternate;
        }

        .orb-2 {
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.22) 0%, transparent 70%);
            bottom: -120px;
            right: -100px;
            animation: pulse-slow 10s ease-in-out infinite alternate-reverse;
        }

        @keyframes pulse-slow {
            0% { transform: scale(1); opacity: 0.55; }
            100% { transform: scale(1.15); opacity: 0.85; }
        }

        /* Grid Pattern */
        .grid-pattern {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 45px 45px;
            pointer-events: none;
        }

        /* Center Card */
        .login-card {
            position: relative;
            z-index: 10;
            max-width: 450px;
            width: 100%;
            background: #ffffff;
            padding: 44px 38px;
            border-radius: 24px;
            box-shadow: 0 25px 60px -10px rgba(5, 29, 24, 0.45), 
                        0 0 0 1px rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header in Card */
        .card-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-badge-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            background: linear-gradient(135deg, #093028 0%, #0e4c3a 50%, #156d53 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 10px 22px rgba(14, 76, 58, 0.25);
            border: 1px solid rgba(52, 211, 153, 0.35);
        }

        .brand-badge-icon img {
            max-height: 36px;
            max-width: 36px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .title {
            font-size: 26px;
            font-weight: 800;
            color: #093028;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 13.5px;
            color: #64748b;
            font-weight: 500;
            line-height: 1.4;
        }

        /* Form Inputs */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap i.input-icon {
            position: absolute;
            left: 16px;
            color: #0e4c3a;
            font-size: 16px;
            transition: color 0.2s ease;
            pointer-events: none;
            z-index: 2;
        }

        .input-wrap input {
            width: 100%;
            height: 50px;
            padding: 0 46px 0 46px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14.5px;
            color: #0f172a;
            background: #f8fafc;
            transition: all 0.25s ease;
            outline: none;
        }

        .input-wrap input::placeholder {
            color: #94a3b8;
        }

        .input-wrap input:focus {
            background: #ffffff;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        }

        .input-wrap input:focus ~ i.input-icon {
            color: #10b981;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 6px;
            font-size: 15px;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
        }

        .password-toggle:hover {
            color: #0e4c3a;
        }

        /* Options Row (Remember Me & Forgot Password) */
        .options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .remember-wrap {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #475569;
            user-select: none;
            font-weight: 500;
        }

        .remember-wrap input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: #0e4c3a;
            cursor: pointer;
            border-radius: 4px;
        }

        .forgot-link {
            color: #0e4c3a;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .forgot-link:hover {
            color: #10b981;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #093028 0%, #0e4c3a 50%, #156d53 100%);
            color: #ffffff;
            font-size: 15.5px;
            font-weight: 700;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 10px 22px -5px rgba(14, 76, 58, 0.42);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #0e4c3a 0%, #156d53 45%, #10b981 100%);
            transform: translateY(-2px);
            box-shadow: 0 14px 28px -4px rgba(14, 76, 58, 0.58);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit i {
            transition: transform 0.2s ease;
        }

        .btn-submit:hover i {
            transform: translateX(4px);
        }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13.5px;
            margin-bottom: 22px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.4;
            text-align: left;
        }

        .alert-danger {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 13.5px;
            color: #64748b;
        }

        .login-footer a {
            color: #0e4c3a;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .login-footer a:hover {
            color: #10b981;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 34px 22px;
            }
            .title {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
    <!-- Ambient Glowing Orbs -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <!-- Background Grid -->
    <div class="grid-pattern"></div>

    <!-- Login Card -->
    <div class="login-card">
        <div class="card-header">
            <div class="brand-badge-icon">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fas fa-gas-pump\' style=\'color: #34d399; font-size: 24px;\'></i>';">
            </div>
            <h1 class="title">Welcome Back</h1>
            <p class="subtitle">Please enter your credentials to access the system</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle" style="margin-top: 2px;"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle" style="margin-top: 2px;"></i>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-wrap">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus autocomplete="username">
                    <i class="fas fa-envelope input-icon"></i>
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="passwordInput" class="form-label">Password</label>
                <div class="input-wrap">
                    <input type="password" id="passwordInput" name="password" placeholder="Enter your password" required autocomplete="current-password">
                    <i class="fas fa-lock input-icon"></i>
                    <button type="button" class="password-toggle" id="togglePasswordBtn" aria-label="Toggle password visibility">
                        <i class="far fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Options Row -->
            <div class="options-row">
                <label class="remember-wrap" for="remember_me">
                    <input type="checkbox" id="remember_me" name="remember">
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">
                <span>Login Now</span>
                <i class="fas fa-arrow-right"></i>
            </button>

            <!-- Signup / Help Footer -->
            <div class="login-footer">
                Don't have an account? 
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Signup now</a>
                @else
                    <a href="#">Signup now</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Password visibility toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('toggleIcon');

            if (toggleBtn && passwordInput && toggleIcon) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    toggleIcon.classList.toggle('fa-eye', !isPassword);
                    toggleIcon.classList.toggle('fa-eye-slash', isPassword);
                });
            }
        });
    </script>
</body>

</html>
