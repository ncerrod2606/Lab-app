<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Research Lab</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --primary: #3b82f6; /* Modern Blue */
            --primary-hover: #2563eb;
            --secondary: #0ea5e9; /* Light Blue */
            --text-main: #1e293b;
            --text-light: #64748b;
            --bg-color: #f0f9ff;
            --white: #ffffff;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Background Circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            z-index: 0;
        }

        .circle-1 {
            width: 600px;
            height: 600px;
            background-color: #e0f2fe;
            top: -100px;
            right: -100px;
            opacity: 0.7;
        }

        .circle-2 {
            width: 400px;
            height: 400px;
            background-color: #dbeafe;
            bottom: -50px;
            left: -50px;
            opacity: 0.6;
        }

        /* Main Container */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header Branding */
        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon {
            font-size: 3rem;
            color: #6366f1; /* Icon specific color from image usually purple/indigo */
            background: #e0e7ff;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            margin: 0 auto 1.5rem auto;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .brand-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            letter-spacing: -0.5px;
        }

        .brand-subtitle {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        /* Card */
        .login-card {
            background: var(--white);
            border-radius: 24px;
            padding: 2.5rem;
            width: 100%;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.2s;
            box-sizing: border-box; /* Important fix */
            color: var(--text-main);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        
        .form-input::placeholder {
            color: #cbd5e1;
        }

        /* Checkbox */
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check input {
            width: 18px;
            height: 18px;
            border: 2px solid var(--border);
            border-radius: 4px;
            margin-right: 0.75rem;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .form-check label {
            color: var(--text-light);
            font-size: 0.9rem;
            cursor: pointer;
        }

        /* Buttons */
        .btn {
            display: block;
            width: 100%;
            padding: 0.9rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.5);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 8px -1px rgba(59, 130, 246, 0.6);
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(14, 165, 233, 0.5);
        }

        .btn-secondary:hover {
            background-color: #0284c7;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--border);
            color: var(--text-light);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #eff6ff;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: var(--text-light);
            font-size: 0.8rem;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border);
        }

        .divider:not(:empty)::before {
            margin-right: .5em;
        }

        .divider:not(:empty)::after {
            margin-left: .5em;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 1.5rem;
            }
            .brand-icon {
                font-size: 2.5rem;
                width: 60px;
                height: 60px;
            }
            .brand-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>

    <div class="login-wrapper">
        <div class="brand-header">
            <div class="brand-icon">
                <i class="fas fa-microscope text-primary" style="color: #4f46e5;"></i>
            </div>
            <h1 class="brand-title">Research Lab</h1>
            <p class="brand-subtitle">Sistema de Investigación Científica</p>
        </div>

        <div class="login-card">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-input @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input id="password" type="password" class="form-input @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" {{ old("remember") ? 'checked' : '' }}>
                    <label for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Login <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                </button>

                <div class="divider">o</div>

                 @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="btn btn-outline" style="margin-bottom: 1rem;">
                        Forgot Your Password?
                    </a>
                @endif

                <a href="{{ route('register') }}" class="btn btn-secondary">
                    Create Account
                </a>
            </form>
        </div>
    </div>

</body>
</html>