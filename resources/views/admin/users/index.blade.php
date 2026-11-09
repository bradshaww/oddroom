
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODDROOM — User Control</title>

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
        button, input, select { font: inherit; }

        .layout { min-height: 100vh; }

        /* SIDEBAR - SAME AS ADMIN DASHBOARD */
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

        /* USER STAT CARDS */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
            margin: 35px 0;
        }

        .stat-card {
            position: relative;
            min-height: 150px;
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

        .stat-label {
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.4px;
            line-height: 1.5;
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

        /* USER TABLE */
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

        .panel {
            background: var(--white);
            border: var(--border);
            box-shadow: var(--shadow);
            padding: 23px;
            min-width: 0;
            margin-bottom: 24px;
        }

        .panel-desc {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            margin: 8px 0 22px;
        }

        .alert {
            padding: 13px 15px;
            border: var(--border);
            margin-bottom: 22px;
            font-size: 12px;
            font-weight: 800;
        }

        .alert-success { background: #CBE5C8; }
        .alert-error { background: var(--pink); }

        .filters {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filters input,
        .filters select {
            min-width: 0;
            min-height: 42px;
            padding: 10px 12px;
            background: var(--cream);
            color: var(--black);
            border: var(--border);
            border-radius: 0;
            outline: none;
        }

        .filters input {
            flex: 1;
            min-width: 200px;
        }

        .filters input:focus,
        .filters select:focus {
            box-shadow: 3px 3px 0 var(--black);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 40px;
            padding: 10px 13px;
            background: var(--green);
            color: var(--cream);
            border: var(--border);
            box-shadow: 3px 3px 0 var(--black);
            cursor: pointer;
            font-size: 10px;
            font-weight: 900;
            transition: .15s;
        }

        .btn:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0 var(--black);
        }

        .btn-light {
            background: var(--cream);
            color: var(--black);
        }

        .btn-delete {
            background: var(--pink);
            color: var(--black);
            box-shadow: 2px 2px 0 var(--black);
            min-height: 32px;
            padding: 7px 10px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #D8D0C0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead { background: var(--green); color: var(--cream); }

        th {
            padding: 15px 13px;
            font-size: 10px;
            letter-spacing: 1px;
            font-weight: 900;
            white-space: nowrap;
        }

        td {
            padding: 15px 13px;
            border-bottom: 1px solid #E2DACA;
            vertical-align: middle;
            font-size: 12px;
        }

        tbody tr:hover { background: #F6EFDF; }
        tbody tr:last-child td { border-bottom: 0; }

        .user-name {
            font-size: 12px;
            font-weight: 900;
            overflow-wrap: anywhere;
        }

        .user-id {
            color: var(--muted);
            font-size: 10px;
            margin-top: 5px;
        }

        .email {
            overflow-wrap: anywhere;
            min-width: 150px;
        }

        .role {
            display: inline-block;
            padding: 6px 9px;
            border: 1.5px solid var(--black);
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .role-admin { background: var(--blue); }
        .role-customer { background: var(--yellow); }
        .role-other { background: #E5E1D9; }

        .muted { color: var(--muted); }

        .empty {
            padding: 45px 20px;
            text-align: center;
            border: 1px dashed #CFC5B2;
        }

        .empty strong {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .empty p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .pagination {
            padding-top: 20px;
            font-size: 12px;
        }

        .pagination nav > div:first-child { margin-bottom: 12px; }

        .pagination nav > div:last-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination a,
        .pagination span[aria-current] {
            display: inline-block;
            padding: 7px 11px;
            margin-right: 4px;
            border: 1px solid var(--black);
            background: var(--cream);
            font-weight: 800;
        }

        .pagination span[aria-current] { background: var(--yellow); }

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

        /* RESPONSIVE - SAME BREAKPOINTS AS DASHBOARD */
        @media (max-width: 1100px) {
            .sidebar { width: 235px; padding: 25px 15px; }
            .main { margin-left: 235px; padding: 28px 24px; }
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
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
            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
                margin-bottom: 28px;
            }
            .breadcrumb { font-size: 9px; }
            .welcome { align-items: flex-start; flex-direction: column; }
            h1 { font-size: clamp(28px, 7vw, 42px); letter-spacing: -2px; }
            .welcome-desc { font-size: 11px; }
            .date-label { font-size: 10px; padding: 10px; }
            .stats { gap: 12px; margin: 25px 0; }
            .stat-card { min-height: 125px; padding: 13px; }
            .stat-number { font-size: 32px; }
            .stat-label, .stat-foot { font-size: 9px; }
            .stat-symbol { right: 10px; top: 10px; font-size: 19px; }
            .panel { padding: 16px; }
            .filters { align-items: stretch; }
            .filters input { min-width: 100%; }
            .filters select { flex: 1; }
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
            .stat-card { min-height: 115px; }
            .section-title { align-items: flex-start; flex-direction: column; }
            .top-tag { white-space: normal; }
            .panel { padding: 12px; }
            .filters .btn { flex: 1; }
        }
    </style>
</head>

<body>
<div class="layout">

    <!-- side barnya-->
    <aside class="sidebar">
        <a href="/admin" class="brand">ODDROOM<span></span></a>
        <div class="brand-note">MUSIC STUDIO MANAGEMENT</div>

        <div class="menu-label">WORKSPACE</div>

        <nav class="menu">
            <a href="/admin">
                <span class="menu-icon">▦</span> Dashboard
            </a>

            <a href="/admin/studios">
                <span class="menu-icon">♫</span> Kelola Studio
            </a>

            <a href="/admin/payments">
                <span class="menu-icon">▣</span> Payments
            </a>

            <a href="/admin/users" class="active">
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
            <div class="top-tag">● ADMIN MODE</div>
        </div>

        <section class="welcome">
            <div>
                <p class="eyebrow">MANAGE YOUR COMMUNITY.</p>
                <h1>USER<br>CONTROL<span>.</span></h1>
                <p class="welcome-desc">
                    Manage registered accounts and monitor user roles.<br>
                    Keep your ODDROOM community organized.
                </p>
            </div>

            <div class="date-label">
                ✳ &nbsp; ACCOUNT MANAGEMENT
            </div>
        </section>

        @if (session('success'))
            <div class="alert alert-success">
                ✓ &nbsp; {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                ! &nbsp; {{ session('error') }}
            </div>
        @endif

        <section class="stats">

            <div class="stat-card green">
                <div class="stat-label">TOTAL USERS</div>
                <div>
                    <div class="stat-number">{{ $totalUsers }}</div>
                    <div class="stat-foot">All registered accounts</div>
                </div>
                <div class="stat-symbol">♟</div>
            </div>

            <div class="stat-card yellow">
                <div class="stat-label">ADMIN ACCOUNTS</div>
                <div>
                    <div class="stat-number">{{ $totalAdmins }}</div>
                    <div class="stat-foot">System administrators</div>
                </div>
                <div class="stat-symbol">✳</div>
            </div>

            <div class="stat-card pink">
                <div class="stat-label">CUSTOMER ACCOUNTS</div>
                <div>
                    <div class="stat-number">{{ $totalCustomers }}</div>
                    <div class="stat-foot">Registered customers</div>
                </div>
                <div class="stat-symbol"></div>
            </div>

        </section>

        <div class="section-title">
            <h2>REGISTERED USERS.</h2>
        </div>

        <section class="panel">

            <p class="panel-desc">
                Search accounts, filter by role, and manage customer access.
            </p>

            <form class="filters" action="/admin/users" method="GET">
                <input
                    type="text"
                    name="search"
                    placeholder="Search name, email, or phone..."
                    value="{{ request('search') }}"
                >

                <select name="role" aria-label="Filter by role">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                    <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>
                        Customer
                    </option>
                </select>

                <button type="submit" class="btn">⌕ &nbsp; SEARCH</button>
                <a href="/admin/users" class="btn btn-light">RESET</a>
            </form>

            @if ($users->count())
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>USER</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                            <th>ROLE</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-id">USER ID #{{ $user->user_id }}</div>
                                </td>

                                <td class="email">{{ $user->email }}</td>

                                <td>{{ $user->no_telp ?: '—' }}</td>

                                <td>
                                    @php
                                        $roleClass = match ($user->role) {
                                            'admin' => 'role-admin',
                                            'customer' => 'role-customer',
                                            default => 'role-other',
                                        };
                                    @endphp

                                    <span class="role {{ $roleClass }}">
                                        {{ $user->role ?: 'unknown' }}
                                    </span>
                                </td>

                                <td>
                                    @if ($user->role !== 'admin')
                                        <form
                                            action="/admin/users/{{ $user->user_id }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-delete">
                                                DELETE
                                            </button>
                                        </form>
                                    @else
                                        <span class="muted">Protected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    {{ $users->links() }}
                </div>
            @else
                <div class="empty">
                    <strong>NO USERS FOUND.</strong>
                    <p>
                        No accounts match your current search or filter.
                        Try another keyword or reset the filters.
                    </p>
                </div>
            @endif

        </section>

        <footer class="footer">
        </footer>

    </main>
</div>
</body>
</html>
