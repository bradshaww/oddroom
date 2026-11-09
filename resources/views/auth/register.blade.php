
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ODDROOM</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="/" class="brand">ODDROOM<span></span></a>
        <div class="nav-links">
            <a href="/studios">STUDIOS</a>
            <a href="/login">LOGIN</a>
        </div>
    </nav>

    <section class="studio-detail">
        <p class="eyebrow">JOIN THE ODD SIDE</p>
        <h1>CREATE<br>YOUR ACCOUNT<span>!</span></h1>

        <div class="booking-form">
            <h2>LET'S GET YOU STARTED</h2>

            <form action="/register" method="POST">
                @csrf

                <label for="name">YOUR NAME</label>
                <input type="text" id="name" name="name"
                    value="{{ old('name') }}" required>

                <label for="email">EMAIL ADDRESS</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}" required>

                <label for="no_telp">PHONE NUMBER</label>
                <input type="tel" id="no_telp" name="no_telp"
                    value="{{ old('no_telp') }}" required>

                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password"
                    minlength="8" required>

                <label for="password_confirmation">CONFIRM PASSWORD</label>
                <input type="password" id="password_confirmation"
                    name="password_confirmation" minlength="8" required>

                @if ($errors->any())
                    <div class="form-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <button type="submit" class="book-room-button">
                    CREATE ACCOUNT ↗
                </button>
            </form>

            <p>ALREADY HAVE AN ACCOUNT?</p>
            <a href="/login" class="back-link">LOGIN HERE →</a>
        </div>
    </section>
</body>
</html>
