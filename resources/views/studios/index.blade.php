<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODDROOM - Studios</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* BRAND LOGO */
        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            text-decoration: none;
            color: #171714;
            font-weight: bold;
        }

        .brand img {
            width: 35px;
            height: 35px;
            object-fit: contain;
            display: block;
        }

        .brand span {
            font-size: 15px;
            letter-spacing: 2px;
        }

        /* NAVBAR SPACING */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }
    </style>
</head>

<body>

<nav class="navbar">
    <a href="/" class="brand">
        <img src="{{ asset('images/oddroom.png') }}" alt="ODDROOM Logo">
        <span>ODDROOM</span>
    </a>

    <div class="nav-links">
        <a href="/studios">STUDIOS</a>
        <a href="#studios">BOOK A SESSION</a>

        @auth
            <a href="/my-bookings">MY BOOKINGS</a>

            <form action="/logout" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-login">
                    LOGOUT ↗
                </button>
            </form>
        @else
            <a href="/login" class="nav-login">LOGIN ↗</a>
        @endauth
    </div>
</nav>

<header class="page-heading">
    <p class="eyebrow">LET US BE YOUR WAY.</p>
    <h1>CHOOSE YOUR<br>STUDIO<span>!</span></h1>
    <p class="subtitle">"I know you're scared, I've been scared but whether you like it or not, you are in this race! So you take all that Kenny G anger and you unleash it!"
        - Jack Salter
    </p>
</header>

<div class="studio-container" id="studios">
    @foreach ($studios as $studio)
        <div class="studio-card">
            <h3>{{ $studio->name }}</h3>

            <img
                src="{{ asset('images/' . $studio->image) }}"
                alt="{{ $studio->name }}"
            >

            <p>{{ $studio->description }}</p>

            <p class="price">
                Rp {{ number_format($studio->price_per_hour, 0, ',', '.') }} / hour
            </p>

            <a href="{{ url('/studios/' . $studio->studio_id) }}"
               class="view-studio">
                VIEW STUDIO
            </a>
        </div>
    @endforeach
</div>

</body>
</html>