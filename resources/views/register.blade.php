<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 440px;
            padding: 48px 40px;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4ade80 0%, #3b82f6 100%);
            border-radius: 16px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            font-weight: 600;
        }

        h1 {
            text-align: center;
            color: #1e293b;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 15px;
            margin-bottom: 32px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #475569;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            color: #1e293b;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-family: inherit;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4ade80;
            background: white;
            box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.1);
        }

        .name-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .terms {
            display: flex;
            align-items: start;
            gap: 10px;
            margin-bottom: 24px;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #4ade80;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .terms label {
            margin: 0;
            font-size: 13px;
            color: #475569;
            cursor: pointer;
            line-height: 1.5;
        }

        .terms a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .terms a:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        .btn-signup {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #4ade80 0%, #3b82f6 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(74, 222, 128, 0.3);
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 222, 128, 0.4);
        }

        .btn-signup:active {
            transform: translateY(0);
        }

        .btn-signup:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
            gap: 16px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            color: #94a3b8;
            font-size: 13px;
            font-weight: 500;
        }

        .social-login {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .social-btn {
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #475569;
        }

        .social-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .signin-link {
            text-align: center;
            margin-top: 28px;
            color: #64748b;
            font-size: 14px;
        }

        .signin-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .signin-link a:hover {
            color: #2563eb;
        }

        .error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 4px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">A</div>
        
        <h1>Create your account</h1>
        <p class="subtitle">Start your journey with us today</p>

        <form action="/register" method="POST">
            @csrf
            
            <div class="name-group">
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input 
                        type="text" 
                        id="first_name" 
                        name="first_name" 
                        placeholder="John"
                        value="{{ old('first_name') }}"
                        required
                    >
                    @error('first_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input 
                        type="text" 
                        id="last_name" 
                        name="last_name" 
                        placeholder="Doe"
                        value="{{ old('last_name') }}"
                        required
                    >
                    @error('last_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="john.doe@example.com"
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Create a strong password"
                    required
                >
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Re-enter your password"
                    required
                >
            </div>

            <div class="terms">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    I agree to the <a href="/terms">Terms of Service</a> and <a href="/privacy">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="btn-signup">Create account</button>
        </form>

        <div class="divider">
            <span>Or sign up with</span>
        </div>

        <div class="social-login">
            <button class="social-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </button>
            <button class="social-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </button>
        </div>

        <div class="signin-link">
            Already have an account? <a href="/login">Sign in</a>
        </div>
    </div>
</body>
</html>