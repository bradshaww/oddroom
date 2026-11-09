
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — ODDROOM</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            background: #F5EBD7;
            color: #171714;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 440px;
            padding: 32px;
            background: #fffaf0;
            border: 2px solid #171714;
            box-shadow: 7px 7px 0 #171714;
        }

        .logo {
            margin: 0 0 28px;
            color: #244C3A;
            font-size: 30px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        h1 {
            margin-bottom: 10px;
            font-size: 28px;
        }

        p {
            line-height: 1.6;
        }

        label {
            display: block;
            margin: 22px 0 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 2px solid #171714;
            background: white;
            font-size: 15px;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            border: 2px solid #171714;
            background: #244C3A;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 4px 4px 0 #171714;
        }

        button:hover {
            background: #35694f;
        }

        .message {
            margin-top: 16px;
            padding: 12px;
            border: 1px solid #244C3A;
            line-height: 1.5;
        }

        .reset-link {
            display: block;
            margin-top: 14px;
            padding: 13px;
            background: #F2C94C;
            border: 2px solid #171714;
            box-shadow: 4px 4px 0 #171714;
            color: #171714;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
        }

        .reset-link:hover {
            background: #e4b932;
        }

        .error {
            color: #a32121;
            font-size: 14px;
        }

        a {
            color: #244C3A;
            font-weight: bold;
        }

        .back {
            margin-top: 24px;
            text-align: center;
        }
    </style>
</head>
<body>
    <main class="container">
        <div class="logo">ODDROOM.</div>

        <h1>Forgot Password?</h1>

        <p>
            Enter the email address linked to your account.
            We'll generate a password reset link for your account.
        </p>

        @if (session('success'))
            <div class="message">
                {{ session('success') }}

                @if (session('reset_url'))
                    <a href="{{ session('reset_url') }}"
                       class="reset-link">
                        RESET PASSWORD NOW ↗
                    </a>
                @endif
            </div>
        @endif

        @if ($errors->any())
            <div class="message error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label for="email">Email Address</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@example.com"
                required
                autocomplete="email"
            >

            <button type="submit">GENERATE RESET LINK ↗</button>
        </form>

        <div class="back">
            <a href="{{ url('/login') }}">← Back to Login</a>
        </div>
    </main>
</body>
</html>
