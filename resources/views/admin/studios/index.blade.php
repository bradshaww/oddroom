
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Studio — ODDROOM</title>

    <style>
        :root {
            --cream: #F5EBD7;
            --green: #244C3A;
            --yellow: #F2C94C;
            --pink: #F28C8C;
            --blue: #8BB8D9;
            --black: #171714;
            --white: #FFFCF5;
            --muted: #77766D;
            --border: 2px solid var(--black);
            --shadow: 5px 5px 0 var(--black);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--black);
            font-family: Arial, Helvetica, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 235px;
            padding: 30px 20px;
            background: var(--green);
            color: var(--cream);
            border-right: var(--border);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 5;
        }

        .brand {
            display: inline-block;
            font-size: 27px;
            font-weight: 1000;
            letter-spacing: -1.5px;
        }

        .brand span {
            color: var(--yellow);
            font-size: 13px;
            vertical-align: top;
        }

        .brand-note {
            color: #C9D7CB;
            font-size: 10px;
            letter-spacing: 1.5px;
            line-height: 1.7;
            margin: 7px 0 42px;
        }

        .menu-label {
            margin: 0 0 12px 10px;
            color: #B7C8BA;
            font-size: 10px;
            letter-spacing: 2px;
            font-weight: 800;
        }

        .menu {
            display: grid;
            gap: 8px;
        }

        .menu a {
            display: block;
            padding: 13px 11px;
            border: 2px solid transparent;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: var(--yellow);
            color: var(--black);
            border-color: var(--black);
            box-shadow: 3px 3px 0 var(--black);
            transform: translate(-1px, -1px);
        }

        .menu-icon {
            display: inline-block;
            width: 27px;
            font-size: 16px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 35px;
        }

        .profile {
            border-top: 1px solid #64806D;
            padding-top: 17px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            background: var(--pink);
            color: var(--black);
            border: var(--border);
            font-weight: 900;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .profile-role {
            font-size: 10px;
            color: #C9D7CB;
            margin-top: 4px;
        }

        .logout {
            width: 100%;
            background: transparent;
            border: 1px solid #9BB09E;
            color: var(--cream);
            padding: 11px;
            cursor: pointer;
            text-align: left;
            font-size: 12px;
            font-weight: 800;
            border-radius: 6px;
        }

        .logout:hover {
            background: var(--pink);
            color: var(--black);
            border-color: var(--black);
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 235px;
            padding: 34px 38px 45px;
            min-height: 100vh;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 38px;
        }

        .breadcrumb {
            color: var(--muted);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.5px;
        }

        .top-tag {
            padding: 9px 12px;
            background: var(--white);
            border: var(--border);
            box-shadow: 3px 3px 0 var(--black);
            font-size: 10px;
            font-weight: 900;
            white-space: nowrap;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 30px;
        }

        .eyebrow {
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 3px;
            margin: 0 0 12px;
        }

        h1 {
            margin: 0;
            font-size: clamp(38px, 5vw, 60px);
            line-height: .98;
            letter-spacing: -3px;
            font-weight: 1000;
        }

        h1 span {
            color: var(--green);
        }

        .subtitle {
            color: #65645B;
            font-size: 12px;
            line-height: 1.7;
            margin-top: 14px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 16px;
            border: var(--border);
            box-shadow: 4px 4px 0 var(--black);
            background: var(--yellow);
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            transition: .18s;
        }

        .button:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0 var(--black);
        }

        .notice {
            padding: 14px 16px;
            margin-bottom: 20px;
            border: var(--border);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
        }

        .notice.success {
            background: #D9F0DF;
        }

        .notice.error {
            background: #FFE0DC;
        }

        .notice ul {
            padding-left: 20px;
            margin: 7px 0 0;
        }

        .collection-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 35px 0 18px;
        }

        h2 {
            margin: 0;
            font-size: 19px;
            letter-spacing: -.5px;
        }

        .count {
            background: var(--blue);
            border: 1.5px solid var(--black);
            padding: 8px 11px;
            font-size: 11px;
            font-weight: 900;
            white-space: nowrap;
        }

        .studio-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .studio-card {
            min-width: 0;
            background: var(--white);
            border: var(--border);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform .2s;
        }

        .studio-card:hover {
            transform: translate(-2px, -2px);
        }

        .studio-image {
            position: relative;
            height: 205px;
            background: #DCD2BF;
            border-bottom: var(--border);
            overflow: hidden;
        }

        .studio-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-fallback {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            color: var(--green);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .studio-number {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 7px 10px;
            background: var(--yellow);
            border: 1.5px solid var(--black);
            font-size: 10px;
            font-weight: 900;
        }

        .studio-content {
            padding: 20px;
        }

        .studio-name {
            font-size: 24px;
            line-height: 1.15;
            letter-spacing: -1px;
            overflow-wrap: anywhere;
        }

        .description {
            color: #65645B;
            font-size: 12px;
            line-height: 1.7;
            margin: 12px 0 18px;
            overflow-wrap: anywhere;
        }

        .price-label {
            color: var(--muted);
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 1.5px;
            margin-bottom: 6px;
        }

        .price {
            font-size: 24px;
            font-weight: 1000;
            letter-spacing: -.8px;
            overflow-wrap: anywhere;
        }

        .price small {
            font-size: 11px;
            letter-spacing: 0;
        }

        .image-filename {
            margin-top: 10px;
            color: var(--muted);
            font-size: 10px;
            overflow-wrap: anywhere;
        }

        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 22px;
            padding-top: 16px;
            border-top: 1px solid #E2DACA;
        }

        .edit-button {
            flex: 1;
            background: var(--green);
            color: var(--cream);
            border: 1.5px solid var(--black);
            padding: 11px;
            text-align: center;
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
        }

        .edit-button:hover {
            background: #35674F;
        }

        .delete-button {
            background: var(--pink);
            color: var(--black);
            border: 1.5px solid var(--black);
            padding: 11px 14px;
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
        }

        .delete-button:hover {
            background: #FFB0A8;
        }

        .empty-state {
            padding: 55px 25px;
            text-align: center;
            background: var(--white);
            border: var(--border);
            box-shadow: var(--shadow);
        }

        .empty-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 38px;
            padding-top: 18px;
            border-top: 1px solid #CFC5B2;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .7px;
        }

        @media (max-width: 1000px) {
            .sidebar {
                width: 235px;
                padding: 25px 15px;
            }

            .main {
                margin-left: 235px;
                padding: 28px 24px;
            }

            .studio-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            /* Sidebar tetap menempel saat konten di-scroll */
            .sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                width: 190px;
                padding: 22px 12px;
                overflow-y: auto;
                border-right: var(--border);
                border-bottom: 0;
            }

            .brand {
                font-size: 23px;
            }

            .brand-note {
                font-size: 9px;
                letter-spacing: 1px;
                margin-bottom: 25px;
            }

            .menu {
                grid-template-columns: 1fr;
            }

            .menu a {
                padding: 12px 8px;
                font-size: 11px;
            }

            .menu-icon {
                width: 23px;
            }

            .sidebar-bottom {
                margin-top: auto;
                padding-top: 25px;
            }

            .profile {
                gap: 7px;
            }

            .profile-name {
                font-size: 10px;
            }

            .profile-role {
                font-size: 9px;
            }

            .logout {
                padding: 10px 7px;
                font-size: 10px;
            }

            .main {
                margin-left: 190px;
                padding: 24px 15px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                margin-bottom: 28px;
            }

            .breadcrumb {
                font-size: 9px;
            }

            .top-tag {
                font-size: 9px;
            }

            .heading {
                align-items: flex-start;
                flex-direction: column;
            }

            h1 {
                font-size: clamp(28px, 7vw, 42px);
                letter-spacing: -2px;
            }

            .subtitle {
                font-size: 11px;
            }

            .button {
                padding: 11px;
                font-size: 10px;
            }

            .collection-bar {
                align-items: flex-start;
                flex-direction: column;
            }

            .studio-grid {
                grid-template-columns: 1fr;
            }

            .studio-image {
                height: 160px;
            }

            .studio-content {
                padding: 14px;
            }

            .studio-name {
                font-size: 21px;
            }

            .price {
                font-size: 20px;
            }

            .card-actions {
                gap: 7px;
            }

            .edit-button,
            .delete-button {
                padding: 10px 7px;
                font-size: 10px;
            }

            .footer {
                flex-direction: column;
                font-size: 9px;
            }
        }

        @media (max-width: 380px) {
            .sidebar {
                width: 155px;
                padding: 18px 9px;
            }

            .brand {
                font-size: 20px;
            }

            .brand-note {
                font-size: 8px;
            }

            .menu a {
                font-size: 10px;
                padding: 10px 5px;
            }

            .menu-icon {
                width: 20px;
                font-size: 14px;
            }

            .main {
                margin-left: 155px;
                padding: 20px 10px;
            }

            .top-tag {
                white-space: normal;
            }

            .studio-content {
                padding: 10px;
            }

            .card-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <a href="/admin" class="brand">ODDROOM<span></span></a>
    <div class="brand-note">MUSIC STUDIO MANAGEMENT</div>

    <div class="menu-label">WORKSPACE</div>

    <nav class="menu">
        <a href="/admin">
            <span class="menu-icon">▦</span> Dashboard
        </a>

        <a href="/admin/studios" class="active">
            <span class="menu-icon">♫</span> Kelola Studio
        </a>

        <a href="/admin/payments">
            <span class="menu-icon">▣</span> Payments
        </a>

        <a href="/admin/users">
            <span class="menu-icon">♟</span> User Control
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="profile">
            <div class="avatar">O</div>
            <div>
                <div class="profile-name">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </div>
                <div class="profile-role">ODDROOM ADMIN</div>
            </div>
        </div>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="logout">↗ &nbsp; LOG OUT</button>
        </form>
    </div>
</aside>

<main class="main">

    <div class="topbar">
        <div class="top-tag">♫ STUDIO COLLECTION</div>
    </div>

    <header class="heading">
        <div>
            <h1>STUDIO<br><span>COLLECTION.</span></h1>
            <p class="subtitle">
                All your rooms, one control room.<br>
                Manage studio details, images, and hourly prices here.
            </p>
        </div>

        <a href="/admin/studios/create" class="button">
            ＋ ADD NEW STUDIO 
        </a>
    </header>

    @if (session('success'))
        <div class="notice success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="notice error">
            ! {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="notice error">
            Please check the following:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="collection-bar">
        <h2>YOUR STUDIOS</h2>
        <div class="count">{{ $studios->count() }} STUDIO(S)</div>
    </div>

    @forelse ($studios as $studio)
        <div class="studio-grid" style="margin-bottom: 22px;">
            <article class="studio-card">

                <div class="studio-image">
                    <div class="studio-number">
                        STUDIO #{{ str_pad($studio->studio_id, 2, '0', STR_PAD_LEFT) }}
                    </div>

                    @if ($studio->image)
                        <img
                            src="{{ asset('images/' . $studio->image) }}"
                            alt="{{ $studio->name }}"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';"
                        >
                        <div class="image-fallback" style="display:none;">
                            ♫ ODDROOM STUDIO
                        </div>
                    @else
                        <div class="image-fallback">
                            ♫ NO IMAGE AVAILABLE
                        </div>
                    @endif
                </div>

                <div class="studio-content">
                    <h2 class="studio-name">{{ $studio->name }}</h2>

                    <p class="description">
                        {{ $studio->description ?: 'No description has been added yet.' }}
                    </p>

                    <div class="price-label">HOURLY RATE</div>
                    <div class="price">
                        Rp{{ number_format($studio->price_per_hour, 0, ',', '.') }}
                        <small>/ hour</small>
                    </div>

                    <div class="image-filename">
                        IMAGE FILE: {{ $studio->image ?: 'No image set' }}
                    </div>

                    <div class="card-actions">
                        <a
    href="/admin/studios/{{ $studio->studio_id }}/slots"
    class="edit-button"
    style="background: var(--yellow); color: var(--black);"
>
    ♫ MANAGE SLOTS
</a>
                        <a
                            href="/admin/studios/{{ $studio->studio_id }}/edit"
                            class="edit-button"
                        >
                            ✎ EDIT STUDIO
                        </a>

                        <form
                            action="/admin/studios/{{ $studio->studio_id }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus studio ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-button">
                                DELETE
                            </button>
                        </form>
                    </div>
                </div>

            </article>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">♫</div>
            <h2>NO STUDIOS YET.</h2>
            <p>
                Your collection is still empty.<br>
                Add your first studio to get things started.
            </p>
            <a href="/admin/studios/create" class="button">
                ＋ ADD YOUR FIRST STUDIO
            </a>
        </div>
    @endforelse

    <footer class="footer">
    </footer>

</main>

</body>
</html>
