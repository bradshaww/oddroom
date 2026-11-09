
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Slots — ODDROOM</title>

    <style>
        :root {
            --cream: #F5EBD7;
            --green: #244C3A;
            --yellow: #F2C94C;
            --pink: #F28C8C;
            --black: #171714;
            --white: #FFFCF5;
            --muted: #77766D;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 35px;
            background: var(--cream);
            color: var(--black);
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            max-width: 950px;
            margin: auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 25px;
            color: var(--green);
            font-size: 12px;
            font-weight: 900;
        }

        .eyebrow {
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 3px;
        }

        h1 {
            margin: 0;
            font-size: clamp(35px, 6vw, 55px);
            letter-spacing: -2px;
        }

        h1 span {
            color: var(--green);
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .card {
            padding: 25px;
            margin-bottom: 25px;
            background: var(--white);
            border: 2px solid var(--black);
            box-shadow: 5px 5px 0 var(--black);
        }

        h2 {
            margin-top: 0;
            font-size: 19px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 11px;
            font-weight: 900;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1.5px solid var(--black);
            background: var(--white);
        }

        button,
        .button {
            display: inline-block;
            padding: 12px 16px;
            border: 2px solid var(--black);
            box-shadow: 3px 3px 0 var(--black);
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            text-decoration: none;
            color: var(--black);
        }

        .add-button {
            background: var(--yellow);
        }

        .save-button {
            background: var(--green);
            color: white;
        }

        .delete-button {
            background: var(--pink);
        }

        .slot-list {
            display: grid;
            gap: 12px;
        }

        .slot-item {
            display: grid;
            grid-template-columns: 1fr 1fr auto auto;
            gap: 12px;
            align-items: end;
            padding: 15px;
            border: 1.5px solid var(--black);
            background: var(--cream);
        }

        .slot-time {
            font-size: 10px;
            font-weight: 900;
            color: var(--muted);
            margin-bottom: 7px;
        }

        .notice {
            padding: 13px 15px;
            margin-bottom: 18px;
            border: 2px solid var(--black);
            font-size: 12px;
            line-height: 1.6;
        }

        .success {
            background: #D9F0DF;
        }

        .error {
            background: #FFE0DC;
        }

        .empty {
            padding: 30px;
            text-align: center;
            background: var(--cream);
            border: 1.5px dashed var(--green);
            font-size: 12px;
            line-height: 1.7;
        }

        .errors {
            color: #A52D2D;
            font-size: 11px;
            margin-bottom: 15px;
        }

        @media (max-width: 650px) {
            body {
                padding: 18px;
            }

            .card {
                padding: 17px;
            }

            .form-row,
            .slot-item {
                grid-template-columns: 1fr 1fr;
            }

            .form-row button,
            .slot-item button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="/admin/studios" class="back">
        ← BACK TO STUDIO COLLECTION
    </a>


    <h1>MANAGE <span>SLOTS.</span></h1>

    <p class="subtitle">
        Atur jadwal booking untuk {{ $studio->name }}.
        Slot yang dibuat di sini akan muncul di halaman booking customer.
    </p>

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
            <strong>Periksa kembali:</strong>
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="card">

        <h2>＋ ADD NEW TIME SLOT</h2>

        <form
            action="/admin/studios/{{ $studio->studio_id }}/slots"
            method="POST"
        >
            @csrf

            <div class="form-row">

                <div>
                    <label for="start_time">START TIME</label>
                    <input
                        type="time"
                        id="start_time"
                        name="start_time"
                        value="{{ old('start_time') }}"
                        required
                    >
                </div>

                <div>
                    <label for="end_time">END TIME</label>
                    <input
                        type="time"
                        id="end_time"
                        name="end_time"
                        value="{{ old('end_time') }}"
                        required
                    >
                </div>

                <button type="submit" class="add-button">
                    ADD SLOT +
                </button>

            </div>
        </form>

    </section>

    <section class="card">

        <h2>AVAILABLE TIME SLOTS</h2>

        <p class="subtitle">
            {{ $studio->name }} — {{ $slots->count() }} slot terdaftar.
        </p>

        @forelse ($slots as $slot)

            <div class="slot-item">

                <div>
                    <div class="slot-time">START TIME</div>

                    <form
                        id="update-{{ $slot->slot_id }}"
                        action="/admin/studios/{{ $studio->studio_id }}/slots/{{ $slot->slot_id }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <input
                            type="time"
                            name="start_time"
                            value="{{ substr($slot->start_time, 0, 5) }}"
                            required
                        >
                </div>

                <div>
                    <div class="slot-time">END TIME</div>

                        <input
                            type="time"
                            name="end_time"
                            value="{{ substr($slot->end_time, 0, 5) }}"
                            required
                        >
                </div>

                <button
                    type="submit"
                    form="update-{{ $slot->slot_id }}"
                    class="save-button"
                >
                    SAVE
                </button>

                    </form>

                <form
                    action="/admin/studios/{{ $studio->studio_id }}/slots/{{ $slot->slot_id }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus slot ini?')"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete-button">
                        DELETE
                    </button>
                </form>

            </div>

        @empty

            <div class="empty">
                <strong>NO TIME SLOTS YET.</strong>
                <br>
                Belum ada jadwal untuk studio ini.
                Tambahkan slot melalui form di atas.
            </div>

        @endforelse

    </section>

    <a href="/admin/studios" class="button delete-button">
        ← BACK TO STUDIOS
    </a>

</div>

</body>
</html>
