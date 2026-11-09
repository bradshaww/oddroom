<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ODDROOM</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="/" class="brand">ODDROOM<span></span></a>
        <div class="nav-links">
            <a href="/studios">STUDIOS</a>
            <a href="/register">REGISTER</a>
        </div>
    </nav>

    <section class="studio-detail">
        <p class="eyebrow">GOOD TO HAVE YOU BACK</p>
        <h1>WELCOME<br>BACK<span>!</span></h1>

        <div class="booking-form">
            <h2>LOG IN TO ODDROOM</h2>

            <form action="/login" method="POST">
                @csrf

                <label for="email">EMAIL ADDRESS</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}" required>

                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password"
                    required>

                <p>
    <a href="{{ route('password.request') }}">
        Forgot Password?
    </a>
</p>

                @if ($errors->any())
                    <div class="form-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <button type="submit" class="book-room-button">
                    LET'S GET IN ↗
                </button>
            </form>

            <p>NEW TO ODDROOM?</p>
            <a href="/register" class="back-link">CREATE AN ACCOUNT →</a>

            <p style="margin-top: 24px; font-size: 13px;">
                NEED HELP ACCESSING YOUR ACCOUNT?
            </p>
            <a href="https://wa.me/6285810735945?text=Halo%20Admin%20ODDROOM%2C%20saya%20membutuhkan%20bantuan%20terkait%20akun%20saya."
               target="_blank"
               rel="noopener noreferrer"
               class="back-link">
                CONTACT ADMIN VIA WHATSAPP ↗
            </a>
        </div>
    </section>
</body>
</html>