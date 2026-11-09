
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODDROOM — Payment Verification</title>

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

        .page-heading {
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
            color: var(--green);
        }

        h1 {
            font-size: clamp(34px, 4vw, 55px);
            line-height: .98;
            letter-spacing: -2.5px;
            margin: 0;
            font-weight: 1000;
        }

        h1 span { color: var(--green); }

        .subtitle {
            color: #65645B;
            font-size: 13px;
            line-height: 1.7;
            margin-top: 16px;
        }

        .count-badge {
            white-space: nowrap;
            background: var(--yellow);
            border: var(--border);
            padding: 12px 15px;
            box-shadow: var(--shadow);
            font-size: 11px;
            font-weight: 900;
        }

        .notice {
            padding: 15px 18px;
            margin: 18px 0;
            border: var(--border);
            font-size: 13px;
            font-weight: 700;
        }

        .notice.success { background: #DCEBDD; }
        .notice.error { background: #F8DADA; }

        /* PAYMENT TABLE */
        .table-card {
            margin-top: 28px;
            background: var(--white);
            border: var(--border);
            box-shadow: 6px 6px 0 var(--black);
            overflow: hidden;
        }

        .table-heading {
            padding: 20px 22px;
            background: var(--yellow);
            border-bottom: var(--border);
        }

        .table-heading h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
        }

        .table-heading p {
            margin: 6px 0 0;
            font-size: 12px;
        }

        .table-scroll { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
            font-size: 12px;
        }

        thead { background: #EEE7D7; }

        th {
            padding: 15px 12px;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-size: 10px;
            border-bottom: var(--border);
        }

        td {
            padding: 16px 12px;
            border-bottom: 1px solid #DAD5C8;
            vertical-align: middle;
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #FAF4E7; }

        .payment-id {
            font-weight: 900;
            color: var(--green);
        }

        .customer-name {
            font-weight: 800;
            margin-bottom: 5px;
        }

        .studio-name {
            font-weight: 800;
            font-size: 13px;
        }

        .proof-button {
            display: inline-block;
            padding: 9px 11px;
            background: var(--blue);
            color: var(--black);
            border: 2px solid var(--black);
            box-shadow: 2px 2px 0 var(--black);
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            white-space: nowrap;
        }

        .proof-button:hover {
            transform: translate(-1px, -1px);
            box-shadow: 3px 3px 0 var(--black);
        }

        .status {
            display: inline-block;
            padding: 7px 9px;
            border: 1.5px solid var(--black);
            border-radius: 3px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .status.waiting,
        .status.pending_verification { background: var(--yellow); }

        .status.approved,
        .status.confirmed { background: #CDE6C9; }

        .status.rejected { background: var(--pink); }
        .status.pending_payment { background: var(--blue); }

        .actions {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 9px;
        }

        .action-button {
            min-width: 100px;
            padding: 9px 11px;
            border: 2px solid var(--black);
            box-shadow: 2px 2px 0 var(--black);
            font-size: 10px;
            font-weight: 900;
            cursor: pointer;
        }

        .approve-button {
            background: var(--green);
            color: white;
        }

        .reject-button {
            background: var(--pink);
            color: var(--black);
        }

        .action-button:hover {
            transform: translate(-1px, -1px);
            box-shadow: 3px 3px 0 var(--black);
        }

        .processed {
            color: #777;
            font-size: 11px;
            font-weight: 800;
            line-height: 1.6;
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-state .symbol {
            font-size: 42px;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            margin: 0 0 8px;
            font-size: 20px;
            font-weight: 900;
        }

        .empty-state p {
            margin: 0;
            color: #777;
            font-size: 13px;
        }

        /* PAYMENT PROOF MODAL */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 100;
            padding: 22px;
            background: rgba(23, 23, 20, .82);
            align-items: center;
            justify-content: center;
        }

        .modal.show { display: flex; }

        .modal-box {
            width: min(760px, 100%);
            max-height: 90vh;
            overflow: auto;
            background: var(--cream);
            border: 3px solid var(--black);
            box-shadow: 8px 8px 0 var(--yellow);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            background: var(--green);
            color: white;
            border-bottom: 3px solid var(--black);
        }

        .modal-header h2 {
            margin: 0;
            font-size: 17px;
        }

        .close-button {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            background: var(--pink);
            border: 2px solid var(--black);
            font-size: 22px;
            font-weight: 900;
            cursor: pointer;
        }

        .modal-content {
            padding: 20px;
            text-align: center;
        }

        .modal-content img {
            display: block;
            max-width: 100%;
            max-height: 60vh;
            object-fit: contain;
            margin: 0 auto 18px;
            border: 2px solid var(--black);
            background: white;
        }

        .open-original {
            display: inline-block;
            padding: 10px 14px;
            background: var(--yellow);
            color: var(--black);
            border: 2px solid var(--black);
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
            .sidebar { padding: 25px 15px; }
            .main { padding: 28px 24px; }
        }

        @media (max-width: 760px) {
            .sidebar { width: 190px; padding: 22px 12px; }
            .brand { font-size: 23px; }
            .brand-note {
                font-size: 9px;
                letter-spacing: 1px;
                margin-bottom: 25px;
            }
            .menu a { padding: 12px 8px; font-size: 11px; }
            .menu-icon { width: 23px; }
            .sidebar-bottom { padding-top: 25px; }
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
            .page-heading { align-items: flex-start; flex-direction: column; }
            h1 { font-size: clamp(28px, 7vw, 42px); letter-spacing: -2px; }
            .subtitle { font-size: 11px; }
            .count-badge { font-size: 10px; padding: 10px; }
            .footer { flex-direction: column; font-size: 9px; }
        }

        @media (max-width: 500px) {
            .sidebar { width: 155px; padding: 18px 9px; }
            .brand { font-size: 20px; }
            .brand-note { font-size: 8px; letter-spacing: .7px; }
            .menu a { font-size: 10px; padding: 10px 5px; }
            .menu-icon { width: 20px; font-size: 14px; }
            .main { margin-left: 155px; padding: 20px 10px; }
            .top-tag { white-space: normal; }
        }

        @media (max-width: 420px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                min-height: auto;
                border-right: none;
                border-bottom: var(--border);
            }

            .brand-note { margin-bottom: 25px; }

            .sidebar-bottom {
                margin-top: 18px;
                padding-top: 0;
            }

            .main {
                margin-left: 0;
                padding: 22px 14px 35px;
            }

            .page-heading { gap: 15px; }
            .count-badge { white-space: normal; }
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

            <a href="/admin/studios">
                <span class="menu-icon">♫</span> Kelola Studio
            </a>

            <a href="/admin/payments" class="active">
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
            <div class="top-tag">● ADMIN MODE</div>
        </div>

        <section class="page-heading">
            <div>
                <h1>PAYMENT <span>VERIFICATION.</span></h1>
                <p class="subtitle">
                    Periksa bukti pembayaran customer dan kelola status booking mereka.
                </p>
            </div>

            <div class="count-badge">
                ✳ &nbsp; TOTAL {{ $payments->count() }} PEMBAYARAN
            </div>
        </section>

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
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="table-card">
            <div class="table-heading">
                <h2>DAFTAR PEMBAYARAN</h2>
                <p>Pastikan bukti transfer sesuai sebelum mengambil keputusan.</p>
            </div>

            @if ($payments->isEmpty())
                <div class="empty-state">
                    <div class="symbol">♫</div>
                    <h3>Belum ada pembayaran.</h3>
                    <p>Pembayaran customer akan muncul di sini.</p>
                </div>
            @else
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Studio</th>
                                <th>Tanggal Booking</th>
                                <th>Metode</th>
                                <th>Bukti</th>
                                <th>Status Bayar</th>
                                <th>Status Booking</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>
                                        <span class="payment-id">
                                            #{{ $payment->payment_id }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="customer-name">
                                            {{ $payment->customer_name }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="studio-name">
                                            {{ $payment->studio_name }}
                                        </div>
                                    </td>

                                    <td>{{ $payment->booking_date }}</td>
                                    <td>{{ $payment->payment_method }}</td>

                                    <td>
                                        @if ($payment->payment_proof)
                                            <button
                                                type="button"
                                                class="proof-button"
                                                data-proof-url="{{ asset('storage/' . $payment->payment_proof) }}"
                                                data-proof-title="Bukti Pembayaran #{{ $payment->payment_id }}"
                                            >
                                                LIHAT BUKTI
                                            </button>
                                        @else
                                            <span class="processed">Tidak ada bukti</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="status {{ $payment->status }}">
                                            {{ str_replace('_', ' ', $payment->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="status {{ $payment->booking_status }}">
                                            {{ str_replace('_', ' ', $payment->booking_status) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if (
                                            $payment->status === 'waiting' &&
                                            $payment->booking_status === 'pending_verification'
                                        )
                                            <div class="actions">
                                                <form
                                                    action="/admin/payments/{{ $payment->payment_id }}/approve"
                                                    method="POST"
                                                    onsubmit="return confirm('Setujui pembayaran ini?')"
                                                >
                                                    @csrf
                                                    <button
                                                        type="submit"
                                                        class="action-button approve-button"
                                                    >
                                                        ✓ SETUJUI
                                                    </button>
                                                </form>

                                                <form
                                                    action="/admin/payments/{{ $payment->payment_id }}/reject"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menolak pembayaran ini?')"
                                                >
                                                    @csrf
                                                    <button
                                                        type="submit"
                                                        class="action-button reject-button"
                                                    >
                                                        ✕ TOLAK
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="processed">
                                                ✓ Sudah diproses
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <footer class="footer">
            <span></span>
            <span></span>
        </footer>

    </main>

    <!-- modal bukti paymentnyaa-->
    <div
        class="modal"
        id="proofModal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modalTitle"
        onclick="closeProofOutside(event)"
    >
        <div class="modal-box">
            <div class="modal-header">
                <h2 id="modalTitle">Bukti Pembayaran</h2>

                <button
                    type="button"
                    class="close-button"
                    onclick="closeProof()"
                    aria-label="Tutup popup"
                >
                    ×
                </button>
            </div>

            <div class="modal-content">
                <img id="proofImage" src="" alt="Bukti pembayaran customer">

                <a
                    id="originalProof"
                    class="open-original"
                    href="#"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    BUKA GAMBAR ASLI ↗
                </a>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.proof-button').forEach(function(button) {
            button.addEventListener('click', function() {
                const imageUrl = button.dataset.proofUrl;
                const title = button.dataset.proofTitle;

                const modal = document.getElementById('proofModal');
                const image = document.getElementById('proofImage');
                const original = document.getElementById('originalProof');

                document.getElementById('modalTitle').textContent = title;
                image.src = imageUrl;
                original.href = imageUrl;

                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeProof() {
            document.getElementById('proofModal').classList.remove('show');
            document.body.style.overflow = '';
            document.getElementById('proofImage').src = '';
        }

        function closeProofOutside(event) {
            if (event.target === document.getElementById('proofModal')) {
                closeProof();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeProof();
            }
        });
    </script>

</body>
</html>
