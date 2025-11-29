<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Finance') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #3498db;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background: white;
            border-radius: 8px;
            padding: 48px 40px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-text {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
        }

        .logo-text span {
            color: #3498db;
        }

        .logo-subtitle {
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 8px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 32px;
        }

        .welcome-text h2 {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .welcome-text p {
            font-size: 14px;
            color: #7f8c8d;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #ecf0f1;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            border-color: #3498db;
        }

        .form-input::placeholder {
            color: #bdc3c7;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 6px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border: 2px solid #ecf0f1;
            border-radius: 3px;
            cursor: pointer;
        }

        .remember-me label {
            font-size: 14px;
            color: #2c3e50;
            cursor: pointer;
        }

        .forgot-password {
            font-size: 14px;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .forgot-password:hover {
            color: #2980b9;
        }

        .btn-login {
            width: 100%;
            padding: 14px 24px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .btn-login:hover {
            background: #2980b9;
        }

        .btn-login:active {
            background: #2574a9;
        }

        .footer-text {
            text-align: center;
            margin-top: 32px;
            font-size: 13px;
            color: white;
        }

        .footer-text a {
            color: white;
            font-weight: 600;
            text-decoration: none;
        }

        .session-status {
            background: #2ecc71;
            color: white;
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
            }

            .logo-text {
                font-size: 28px;
            }

            .welcome-text h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <div class="logo-text"><span>Jay</span>Zie-Dev.</div>
                <div class="logo-subtitle">Financial Management System</div>
            </div>

            <div class="welcome-text">
                <h2>Selamat Datang Kembali</h2>
                <p>Silakan login untuk melanjutkan</p>
            </div>

            @if (session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        class="form-input" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="admin@finance.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        class="form-input" 
                        required 
                        autocomplete="current-password"
                        placeholder="Masukkan password">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember_me" name="remember">
                        <label for="remember_me">Ingat Saya</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    Masuk
                </button>
            </form>
        </div>

        <div class="footer-text">
            &copy; 2024 JayZie-Dev. All rights reserved.
        </div>
    </div>
</body>
</html>
