<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Password</title>
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

        .icon-container {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4ade80 0%, #3b82f6 100%);
            border-radius: 20px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-container svg {
            width: 40px;
            height: 40px;
            color: white;
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
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            color: #475569;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        input[type="email"] {
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

        input[type="email"]:focus {
            outline: none;
            border-color: #4ade80;
            background: white;
            box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.1);
        }

        .btn-submit {
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
            margin-bottom: 16px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 222, 128, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #2563eb;
        }

        .back-link svg {
            width: 16px;
            height: 16px;
        }

        .error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 4px;
            display: block;
        }

        .success-message {
            background: #d1fae5;
            border: 2px solid #4ade80;
            color: #065f46;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            line-height: 1.5;
        }

        .info-box {
            background: #dbeafe;
            border: 2px solid #3b82f6;
            border-radius: 12px;
            padding: 14px 16px;
            margin-top: 24px;
        }

        .info-box p {
            color: #1e40af;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        .info-box strong {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon-container">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
            </svg>
        </div>
        
        <h1>Forgot password?</h1>
        <p class="subtitle">No worries! Enter your email address and we'll send you a link to reset your password.</p>

        @if(session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form action="/forgot-password" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Email address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Send reset link</button>

            <a href="/login" class="back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to sign in
            </a>
        </form>

        <div class="info-box">
            <p><strong>Note:</strong> If you don't receive an email within a few minutes, please check your spam folder or try again.</p>
        </div>
    </div>
</body>
</html>