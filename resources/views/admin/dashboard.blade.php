
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODDROOM — Admin Dashboard</title>

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

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--black);
            font-family: Arial, Helvetica, sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button { font: inherit; }

        .layout { min-height: 100vh; }

        /* SIDEBAR - SAME STYLE AS STUDIO MANAGEMENT */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 235px;
            height: 100vh;
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
            margin-bottom: 7px;
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
            margin: 0 0 42px;
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

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            border-top: 1px solid #64806D;
            padding-top: 17px;
            margin-bottom: 16px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            background: var(--pink);
            color: var(--black);
            border: var(--border);
            display: grid;
            place-items: center;
            font-size: 17px;
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
            border-radius: 6px;
            font-size: 12px;
            font-weight: 800;
        }

        .logout:hover {
            background: var(--pink);
            color: var(--black);
            border-color: var(--black);
        }

        /* MAIN CONTENT */
        .main {
            min-width: 0;
            margin-left: 235px;
            padding: 34px 38px 45px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 38px;
        }

        .breadcrumb {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: var(--muted);
        }

        .top-tag {
            border: var(--border);
            padding: 9px 12px;
            background: var(--white);
            box-shadow: 3px 3px 0 var(--black);
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .welcome {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 30px;
        }

        .eyebrow {
            font-size: 11px;
            letter-spacing: 3px;
            font-weight: 900;
            margin: 0 0 12px;
        }

        h1 {
            font-size: clamp(38px, 5vw, 65px);
            line-height: .98;
            letter-spacing: -3px;
            margin: 0;
            font-weight: 1000;
        }

        h1 span { color: var(--green); }

        .welcome-desc {
            color: #65645B;
            font-size: 13px;
            line-height: 1.7;
            margin-top: 16px;
        }

        .date-label {
            white-space: nowrap;
            background: var(--yellow);
            border: var(--border);
            padding: 12px 15px;
            box-shadow: var(--shadow);
            font-size: 11px;
            font-weight: 900;
        }

        /* STAT CARDS */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 17px;
            margin: 35px 0;
        }

        .stat-card {
            position: relative;
            min-height: 160px;
            padding: 20px;
            border: var(--border);
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform .18s;
        }

        .stat-card:hover { transform: translate(-2px, -2px); }
        .stat-card.green { background: var(--green); color: var(--cream); }
        .stat-card.yellow { background: var(--yellow); }
        .stat-card.pink { background: var(--pink); }
        .stat-card.blue { background: var(--blue); }

        .stat-label {
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.4px;
            line-height: 1.5;
            max-width: 125px;
        }

        .stat-number {
            font-size: clamp(34px, 3.5vw, 47px);
            font-weight: 1000;
            letter-spacing: -2px;
            line-height: 1;
            overflow-wrap: anywhere;
        }

        .stat-foot {
            font-size: 10px;
            margin-top: 9px;
            opacity: .8;
        }

        .stat-symbol {
            position: absolute;
            right: 15px;
            top: 15px;
            font-size: 24px;
            font-weight: 900;
        }

        /* LOWER SECTION */
        .section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 17px;
        }

        h2 {
            font-size: 20px;
            letter-spacing: -.6px;
            margin: 0;
        }

        .section-kicker {
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.5px;
            color: var(--muted);
        }

        .lower-grid {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 22px;
        }

        .panel {
            background: var(--white);
            border: var(--border);
            box-shadow: var(--shadow);
            padding: 23px;
            min-width: 0;
        }

        .panel-desc {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            margin: 8px 0 22px;
        }

        .action-list {
            display: grid;
            gap: 12px;
        }

        .action {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px;
            background: var(--cream);
            border: 1.5px solid var(--black);
            transition: .2s;
        }

        .action:hover {
            box-shadow: 3px 3px 0 var(--black);
            transform: translate(-1px, -1px);
        }

        .action-icon {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            border: 1.5px solid var(--black);
            display: grid;
            place-items: center;
            font-size: 20px;
            background: var(--yellow);
        }

        .action:nth-child(2) .action-icon { background: var(--blue); }
        .action:nth-child(3) .action-icon { background: var(--pink); }
        .action:nth-child(4) .action-icon { background: var(--green); color: var(--cream); }

        .action-name {
            font-size: 12px;
            font-weight: 900;
        }

        .action-desc {
            font-size: 10px;
            color: var(--muted);
            margin-top: 5px;
            line-height: 1.5;
        }

        .action-arrow {
            margin-left: auto;
            font-size: 18px;
            font-weight: 900;
        }

        .status-box {
            display: flex;
            gap: 13px;
            align-items: flex-start;
            padding: 15px 0;
            border-bottom: 1px solid #E2DACA;
        }

        .status-box:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .status-dot {
            width: 11px;
            height: 11px;
            margin-top: 3px;
            flex-shrink: 0;
            border: 1.5px solid var(--black);
            background: var(--yellow);
        }

        .status-box:nth-child(3) .status-dot { background: var(--pink); }
        .status-box:nth-child(4) .status-dot { background: var(--blue); }

        .status-name {
            font-size: 12px;
            font-weight: 800;
        }

        .status-desc {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.6;
            margin-top: 5px;
        }

        .status-count {
            margin-left: auto;
            background: var(--cream);
            border: 1.5px solid var(--black);
            padding: 5px 8px;
            font-size: 12px;
            font-weight: 900;
        }

        .footer {
            margin-top: 35px;
            padding-top: 17px;
            border-top: 1px solid #CFC5B2;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .7px;
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .sidebar { width: 235px; padding: 25px 15px; }
            .main { margin-left: 235px; padding: 28px 24px; }
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .lower-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 760px) {
            .sidebar { width: 190px; padding: 22px 12px; }
            .brand { font-size: 23px; }
            .brand-note { font-size: 9px; letter-spacing: 1px; margin-bottom: 25px; }
            .menu { grid-template-columns: 1fr; }
            .menu a { padding: 12px 8px; font-size: 11px; }
            .menu-icon { width: 23px; }
            .sidebar-bottom { margin-top: auto; padding-top: 25px; }
            .admin-profile { gap: 7px; padding-top: 13px; margin-bottom: 13px; }
            .profile-name { font-size: 10px; }
            .profile-role { font-size: 9px; }
            .logout { padding: 10px 7px; font-size: 10px; }
            .main { margin-left: 190px; padding: 24px 15px; }
            .topbar { align-items: flex-start; flex-direction: column; gap: 12px; margin-bottom: 28px; }
            .breadcrumb { font-size: 9px; }
            .welcome { align-items: flex-start; flex-direction: column; }
            h1 { font-size: clamp(28px, 7vw, 42px); letter-spacing: -2px; }
            .welcome-desc { font-size: 11px; }
            .date-label { font-size: 10px; padding: 10px; }
            .stats { gap: 12px; margin: 25px 0; }
            .stat-card { min-height: 135px; padding: 13px; }
            .stat-number { font-size: 32px; }
            .stat-label, .stat-foot { font-size: 9px; }
            .stat-symbol { right: 10px; top: 10px; font-size: 19px; }
            .panel { padding: 16px; }
            .action { gap: 8px; padding: 10px; }
            .action-icon { width: 35px; height: 35px; font-size: 17px; }
            .action-name { font-size: 10px; }
            .action-desc { font-size: 9px; }
            .action-arrow { font-size: 15px; }
            .footer { flex-direction: column; font-size: 9px; }
        }

        @media (max-width: 400px) {
            .sidebar { width: 155px; padding: 18px 9px; }
            .brand { font-size: 20px; }
            .brand-note { font-size: 8px; letter-spacing: .7px; }
            .menu a { font-size: 10px; padding: 10px 5px; }
            .menu-icon { width: 20px; font-size: 14px; }
            .main { margin-left: 155px; padding: 20px 10px; }
            .stats { grid-template-columns: 1fr; }
            .stat-card { min-height: 120px; }
            .section-title { align-items: flex-start; flex-direction: column; }
            .top-tag { white-space: normal; }
            .status-box { gap: 8px; }
            .status-name { font-size: 10px; }
            .status-desc { font-size: 9px; }
            .status-count { padding: 4px 6px; font-size: 10px; }
        }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <a href="/admin" class="brand">ODDROOM<span></span></a>
        <div class="brand-note">MUSIC STUDIO MANAGEMENT</div>

        <div class="menu-label">WORKSPACE</div>

        <nav class="menu">
            <a href="/admin" class="active">
                <span class="menu-icon">▦</span> Dashboard
            </a>

            <a href="/admin/studios">
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
            <div class="admin-profile">
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
                <button type="submit" class="logout">
                    ↗ &nbsp; LOG OUT
                </button>
            </form>
        </div>
    </aside>

    <main class="main">

        <div class="topbar">
            <div class="top-tag">ADMIN</div>
        </div>

        <section class="welcome">
            <div>
                <p class="eyebrow">YOUR SPACE. YOUR SOUND.</p>
                <h1>HEY, ADMIN<span>!</span><br>LET'S GET TO WORK.</h1>
                <p class="welcome-desc">
                    Welcome back to ODDROOM.<br>
                    Here's what's happening in your studio business.
                </p>
            </div>

            <div class="date-label">
                ✳ &nbsp; CONTROL ROOM
            </div>
        </section>

        <section class="stats">

            <div class="stat-card green">
                <div class="stat-label">TOTAL STUDIOS</div>
                <div>
                    <div class="stat-number">{{ $totalStudios }}</div>
                    <div class="stat-foot">Studios in your collection</div>
                </div>
                <div class="stat-symbol">♫</div>
            </div>

            <div class="stat-card yellow">
                <div class="stat-label">TOTAL BOOKINGS</div>
                <div>
                    <div class="stat-number">{{ $totalBookings }}</div>
                    <div class="stat-foot">All recorded bookings</div>
                </div>
                <div class="stat-symbol">↗</div>
            </div>

            <div class="stat-card pink">
                <div class="stat-label">NEED VERIFICATION</div>
                <div>
                    <div class="stat-number">{{ $pendingBookings }}</div>
                    <div class="stat-foot">Bookings awaiting review</div>
                </div>
                <div class="stat-symbol">!</div>
            </div>

            <div class="stat-card blue">
                <div class="stat-label">PAYMENTS WAITING</div>
                <div>
                    <div class="stat-number">{{ $pendingPayments }}</div>
                    <div class="stat-foot">Payments to check</div>
                </div>
                <div class="stat-symbol">▣</div>
            </div>

        </section>

        <div class="section-title">
            <h2>THE CONTROL ROOM.</h2>
            <div class="section-kicker">MANAGE YOUR SPACE</div>
        </div>

        <section class="lower-grid">

            <div class="panel">
                <h2>QUICK ACTIONS</h2>
                <p class="panel-desc">
                    Everything you need to keep ODDROOM running.
                </p>

                <!-- qa-->
                <div class="action-list">

                    <a href="/admin/studios/create" class="action">
                        <div class="action-icon">＋</div>
                        <div>
                            <div class="action-name">ADD NEW STUDIO</div>
                            <div class="action-desc">
                                Add a studio to your collection.
                            </div>
                        </div>
                        <div class="action-arrow">↗</div>
                    </a>

                    <a href="/admin/studios" class="action">
                        <div class="action-icon">♫</div>
                        <div>
                            <div class="action-name">MANAGE STUDIOS</div>
                            <div class="action-desc">
                                Review, edit, or remove studios.
                            </div>
                        </div>
                        <div class="action-arrow">↗</div>
                    </a>

                    <a href="/admin/payments" class="action">
                        <div class="action-icon">▣</div>
                        <div>
                            <div class="action-name">CHECK PAYMENTS</div>
                            <div class="action-desc">
                                Review payment proofs and decisions.
                            </div>
                        </div>
                        <div class="action-arrow">↗</div>
                    </a>

                    <a href="/admin/users" class="action">
                        <div class="action-icon">♟</div>
                        <div>
                            <div class="action-name">USER CONTROL</div>
                            <div class="action-desc">
                                Manage user accounts and account access.
                            </div>
                        </div>
                        <div class="action-arrow">↗</div>
                    </a>

                </div>
            </div>

            <div class="panel">
                <h2>BOOKING STATUS ✳</h2>
                <p class="panel-desc">
                    A quick overview of your current workload.
                </p>

                <div class="status-box">
                    <div class="status-dot"></div>
                    <div>
                        <div class="status-name">Pending verification</div>
                        <div class="status-desc">
                            Bookings waiting for payment review.
                        </div>
                    </div>
                    <div class="status-count">{{ $pendingBookings }}</div>
                </div>

                <div class="status-box">
                    <div class="status-dot"></div>
                    <div>
                        <div class="status-name">Payments waiting</div>
                        <div class="status-desc">
                            Submitted proofs that need a decision.
                        </div>
                    </div>
                    <div class="status-count">{{ $pendingPayments }}</div>
                </div>

                <div class="status-box">
                    <div class="status-dot"></div>
                    <div>
                        <div class="status-name">Studio collection</div>
                        <div class="status-desc">
                            Studios currently registered in the system.
                        </div>
                    </div>
                    <div class="status-count">{{ $totalStudios }}</div>
                </div>
            </div>

        </section>

        <footer class="footer">
        </footer>

    </main>
</div>
</body>
</html>
