
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ODDROOM — Your Space. Your Sound.</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --cream: #F5EBD7;
            --green: #244C3A;
            --yellow: #F2C94C;
            --pink: #F28C8C;
            --blue: #8BB8D9;
            --black: #171714;
        }

        html {
            scroll-behavior: smooth;
            background: var(--cream);
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--black);
        }

        /* NAVBAR & BRAND */

        .navbar {
            background: var(--cream);
            border-bottom: 2px solid var(--black);
        }

        .navbar .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            width: fit-content;
            text-decoration: none;
        }

        .brand-logo {
            width: 38px;
            height: 38px;
            display: block;
            object-fit: contain;
        }

        .brand-name {
            color: var(--black);
            font-size: 14px;
            font-weight: 900;
            letter-spacing: 2px;
            line-height: 1;
        }

        /* HERO */

        .home-hero {
            min-height: 68vh;
            padding: 75px 8%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            position: relative;
            overflow: hidden;
            background: var(--cream);
            border-bottom: 2px solid var(--black);
        }

        .home-hero h1 {
            font-size: clamp(58px, 9vw, 118px);
            line-height: 0.88;
            margin: 18px 0;
            letter-spacing: -5px;
            position: relative;
            z-index: 1;
            text-shadow: 3px 3px 0 rgba(23, 23, 20, 0.08);
        }

        .home-hero h1 span {
            color: var(--green);
        }

        .home-hero .subtitle {
            font-size: 15px;
            line-height: 1.7;
            margin: 16px 0 25px;
        }

        .hero-sticker {
            position: absolute;
            right: 12%;
            top: 25%;
            width: 145px;
            height: 145px;
            background: var(--yellow);
            border: 3px solid var(--black);
            box-shadow: 7px 7px 0 var(--black);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-weight: 900;
            font-size: 18px;
            transform: rotate(12deg);
        }

        /* GENERAL SECTION */

        .home-section {
            padding: 65px 8%;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 26px;
        }

        .section-heading h2 {
            font-size: clamp(36px, 5.5vw, 64px);
            line-height: 0.95;
            margin: 8px 0 0;
            letter-spacing: -2.5px;
        }

        .section-heading p {
            max-width: 280px;
            line-height: 1.6;
            font-size: 14px;
        }

        .eyebrow {
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        /* FEATURED STUDIOS */

        .featured-section {
            background: var(--green);
            color: var(--cream);
            border-bottom: 2px solid var(--black);
        }

        .featured-section .section-heading h2 span {
            color: var(--yellow);
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .featured-card {
            color: var(--black);
            text-decoration: none;
            background: var(--cream);
            border: 2px solid var(--black);
            box-shadow: 5px 5px 0 var(--black);
            transition: 0.2s ease;
            min-width: 0;
        }

        .featured-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 8px 8px 0 var(--black);
        }

        .featured-art {
            min-height: 185px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid var(--black);
            overflow: hidden;
            position: relative;
        }

        .featured-art span {
            font-size: clamp(32px, 4.5vw, 54px);
            font-weight: 1000;
            letter-spacing: -3px;
            transform: rotate(-8deg);
            text-shadow: 2px 2px 0 rgba(23, 23, 20, 0.12);
        }

        .art-band {
            background: var(--pink);
        }

        .art-loop {
            background: var(--yellow);
        }

        .art-beat {
            background: var(--blue);
        }

        .featured-info {
            padding: 16px;
        }

        .featured-info h3 {
            font-size: 21px;
            margin: 0 0 7px;
        }

        .featured-info p {
            margin: 0;
            font-size: 13px;
            line-height: 1.55;
        }

        .featured-link {
            display: inline-block;
            margin-top: 14px;
            font-weight: 900;
            font-size: 12px;
        }

        /* CREATIVE SPACE */

        .creative-section {
            background: var(--cream);
            position: relative;
            overflow: hidden;
        }

        .creative-section .section-heading {
            position: relative;
            z-index: 1;
        }

        .creative-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .creative-main {
            min-height: 340px;
            background: var(--pink);
            border: 2px solid var(--black);
            box-shadow: 6px 6px 0 var(--black);
            padding: 27px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .creative-main h2 {
            font-size: clamp(42px, 6vw, 74px);
            line-height: 0.9;
            letter-spacing: -4px;
            margin: 18px 0;
        }

        .creative-main p {
            max-width: 350px;
            line-height: 1.6;
            font-size: 14px;
        }

        .creative-side {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .creative-box {
            flex: 1;
            min-height: 145px;
            padding: 20px;
            border: 2px solid var(--black);
            box-shadow: 5px 5px 0 var(--black);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .creative-box h3 {
            font-size: 27px;
            margin: 8px 0;
            letter-spacing: -1px;
        }

        .creative-box p {
            margin: 0;
            line-height: 1.5;
            font-size: 13px;
        }

        .creative-yellow {
            background: var(--yellow);
        }

        .creative-blue {
            background: var(--blue);
        }

        /* STATEMENT */

        .statement-section {
            background: var(--yellow);
            text-align: center;
            padding: 75px 8%;
            border-top: 2px solid var(--black);
            border-bottom: 2px solid var(--black);
        }

        .statement-section h2 {
            font-size: clamp(42px, 7vw, 92px);
            line-height: 0.9;
            letter-spacing: -4px;
            margin: 18px 0;
        }

        .statement-section p {
            max-width: 460px;
            margin: 18px auto 25px;
            line-height: 1.7;
            font-size: 14px;
        }

        .statement-button {
            display: inline-block;
            background: var(--green);
            color: var(--cream);
            border: 2px solid var(--black);
            box-shadow: 5px 5px 0 var(--black);
            padding: 13px 22px;
            font-size: 13px;
            font-weight: 900;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .statement-button:hover {
            transform: translate(-3px, -3px);
            box-shadow: 8px 8px 0 var(--black);
        }

        /* FOOTER */

        .home-footer {
            background: var(--black);
            color: var(--cream);
            padding: 42px 8% 22px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            flex-wrap: wrap;
            padding-bottom: 30px;
        }

        .footer-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            width: fit-content;
        }

        .footer-logo {
            width: 38px;
            height: 38px;
            display: block;
            object-fit: contain;
        }

        .footer-brand-name {
            color: var(--cream);
            font-size: 14px;
            font-weight: 900;
            letter-spacing: 2px;
            line-height: 1;
        }

        .footer-description {
            font-size: 13px;
            margin-top: 12px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .footer-links .eyebrow {
            margin: 0 0 3px;
        }

        .footer-links a {
            color: var(--cream);
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
        }

        .footer-links a:hover {
            color: var(--yellow);
        }

        .footer-bottom {
            border-top: 1px solid #555;
            padding-top: 18px;
            display: flex;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            font-size: 11px;
            opacity: 0.7;
        }

        /* RESPONSIVE */

        @media (max-width: 800px) {
            .hero-sticker {
                width: 120px;
                height: 120px;
                font-size: 16px;
                right: 8%;
                top: 15%;
            }

            .featured-grid {
                grid-template-columns: 1fr;
            }

            .featured-art {
                min-height: 190px;
            }

            .creative-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 550px) {
            .brand-logo {
                width: 34px;
                height: 34px;
            }

            .brand-name {
                font-size: 12px;
                letter-spacing: 1.5px;
            }

            .home-hero {
                min-height: 65vh;
                padding: 70px 7%;
            }

            .home-hero h1 {
                font-size: clamp(48px, 12vw, 68px);
                letter-spacing: -3px;
            }

            .hero-sticker {
                width: 85px;
                height: 85px;
                font-size: 11px;
                right: 7%;
                top: 12%;
            }

            .home-section {
                padding: 52px 7%;
            }

            .section-heading {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .featured-art {
                min-height: 175px;
            }

            .creative-main {
                min-height: 310px;
                padding: 22px;
            }

            .creative-main h2 {
                letter-spacing: -3px;
            }

            .creative-box {
                min-height: 140px;
                padding: 19px;
            }

            .statement-section {
                padding: 60px 7%;
            }

            .statement-section h2 {
                letter-spacing: -3px;
            }

            .footer-content {
                gap: 25px;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->

<nav class="navbar">
    <a href="/" class="brand">
        <img src="{{ asset('images/oddroom.png') }}"
             alt="ODDROOM"
             class="brand-logo">

        <span class="brand-name">ODDROOM</span>
    </a>

    <div class="nav-links">
        <a href="/studios">STUDIOS</a>

        @auth
            @if (auth()->user()->role === 'admin')
                <a href="/admin">ADMIN DASHBOARD</a>
            @else
                <a href="/my-bookings">MY BOOKINGS</a>
            @endif

            <form action="/logout" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-login">
                    LOGOUT ↗
                </button>
            </form>
        @else
            <a href="/login" class="nav-login">LOGIN ↗</a>
            <a href="/register">REGISTER ↗</a>
        @endauth
    </div>
</nav>

<!-- HERO -->

<header class="home-hero">

    <p class="eyebrow">Make us your way to find new lyrics.</p>

    <h1>
        MAKE YOUR<br>
        OWN <span>SOUND!</span>
    </h1>

    <p class="subtitle">
        find your way.
        <br>
        seize the day, pals.
    </p>

    <a href="/studios" class="view-studio">
        SEE US WHEN YOU READY!
    </a>

    <div class="hero-sticker">
        MAKE<br>
        SOME NOISE!<br>
        ★
    </div>

</header>

<section class="home-section featured-section">

    <div class="section-heading">
        <div>
            <p class="eyebrow">FIND YOUR WAY</p>
            <h2>PLACES<br><span>FOR YOUR MIND</span></h2>
        </div>

        <p>
        Every musics has it own serve, what serve you will be?
        </p>
    </div>

    <div class="featured-grid">

        <a href="/studios" class="featured-card">
            <div class="featured-art art-band">
                <span>BAND!</span>
            </div>

            <div class="featured-info">
                <h3>BAND ROOM</h3>
                <p>For the loud ones. Bring your whole band and make some noise.</p>
                <span class="featured-link">EXPLORE ROOM ↗</span>
            </div>
        </a>

        <a href="/studios" class="featured-card">
            <div class="featured-art art-loop">
                <span>LOOP.</span>
            </div>

            <div class="featured-info">
                <h3>LOOP ROOM</h3>
                <p>Find your rhythm, build your ideas, and create something new.</p>
                <span class="featured-link">EXPLORE ROOM ↗</span>
            </div>
        </a>

        <a href="/studios" class="featured-card">
            <div class="featured-art art-beat">
                <span>BEAT!</span>
            </div>

            <div class="featured-info">
                <h3>BEAT ROOM</h3>
                <p>Your own space to experiment, record, and make music.</p>
                <span class="featured-link">EXPLORE ROOM ↗</span>
            </div>
        </a>

    </div>

</section>

<!-- CREATIVE SPACE -->

<section class="home-section creative-section">

    <div class="section-heading">
        <div>
            <p class="eyebrow">A LITTLE SOMETHING FROM US</p>
            <h2>THE ODD<br>SPACE.</h2>
        </div>

        <p>
           There's something about turning the volume up and letting everything else fade away. The world keeps moving, time keeps passing, but for a moment, it's just you, your people, and the sound you're making together. Maybe life was always meant to be a little louder.
        </p>
    </div>

    <div class="creative-grid">

        <div class="creative-main">
            <p class="eyebrow">YOUR CREATIVE CORNER</p>

            <h2>OPEN<br>YOUR<br>EYES</h2>

            <p>
               see it beyond your eyes and your mind will follow.
            </p>
        </div>

        <div class="creative-side">

            <div class="creative-box creative-yellow">
                <p class="eyebrow">THE PLAYLIST</p>
                <h3>WHAT'S<br>ON REPEAT?</h3>
                <p>A little corner for music recommendations and inspiration.</p>
            </div>

            <div class="creative-box creative-blue">
                <p class="eyebrow">BEHIND THE SOUND</p>
                <h3>MAKES YOUR<br>OWN DIARIES.</h3>
                <p>Stories, moments, and things happening around ODDROOM.</p>
            </div>

        </div>

    </div>

</section>

<!-- CALL TO ACTION -->

<section class="statement-section">

    <p class="eyebrow">YOUR NEXT SESSION STARTS HERE</p>

    <h2>MAKE IT<br>LOUD.</h2>

    <p>
        Got an idea? A song to practice?
        Or just need a space to create?
        We've got a room for that.
    </p>

    <a href="/studios" class="statement-button">
        BOOK YOUR SESSION
    </a>

</section>

<!-- FOOTER -->

<footer class="home-footer">

    <div class="footer-content">

        <div>
            <div class="footer-brand">
                <img src="{{ asset('images/oddroom.png') }}"
                     alt="ODDROOM"
                     class="footer-logo">

                <span class="footer-brand-name">ODDROOM</span>
            </div>

            <p class="footer-description">Your Space. Your Sound.</p>
        </div>

        <div class="footer-links">
            <p class="eyebrow">EXPLORE</p>
            <a href="/">HOME</a>
            <a href="/studios">STUDIOS</a>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="/admin">ADMIN DASHBOARD</a>
                @else
                    <a href="/my-bookings">MY BOOKINGS</a>
                @endif
            @else
                <a href="/login">LOGIN</a>
            @endauth
        </div>

        <div class="footer-links">
            <p class="eyebrow">ACCOUNT</p>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="/admin">ADMIN DASHBOARD</a>
                @else
                    <a href="/my-bookings">MY BOOKINGS</a>
                @endif
            @else
                <a href="/login">LOGIN</a>
                <a href="/register">REGISTER</a>
            @endauth
        </div>

    </div>

</footer>

</body>
</html>
