
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — ODDROOM</title>

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
            margin-bottom: 28px;
            color: #244C3A;
            font-size: 30px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        h1 {
            font-size: 28px;
        }

        p {
            line-height: 1.6;
        }

        label {
            display: block;
            margin: 20px 0 8px;
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
            margin-top: 24px;
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

        .error {
            margin-top: 16px;
            color: #a32121;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <main class="container">
        <div class="logo">ODDROOM.</div>

        <h1>Reset Password</h1>

        <p>Create a new password for your account.</p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input
                type="hidden"
                name="token"
                value="{{ $token }}"
            >

            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $email) }}"
                required
                autocomplete="email"
            >

            <label for="password">New Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                minlength="8"
                autocomplete="new-password"
            >

            <label for="password_confirmation">
                Confirm New Password
            </label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
                minlength="8"
                autocomplete="new-password"
            >

            <button type="submit">SAVE NEW PASSWORD ↗</button>
        </form>
    </main>
</body>
</html>
