
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Session - ODDROOM</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .time-slot {
            position: relative;
        }

        .time-slot input:disabled + span {
            background: #d5d0c5;
            color: #777;
            border-color: #999;
            box-shadow: none;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        .time-slot input:not(:disabled) + span {
            cursor: pointer;
        }

        .time-slot input:checked + span {
            background: #244C3A;
            color: #F5EBD7;
        }

        .time-slot input:disabled {
            cursor: not-allowed;
        }

        .slot-status {
            display: block;
            font-size: 11px;
            font-weight: bold;
            margin-top: 4px;
            text-decoration: none;
        }

        .slot-legend {
            margin: 12px 0 18px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/" class="brand">ODDROOM<span></span></a>

        <div class="nav-links">
            <a href="/studios">STUDIOS</a>
            <a href="/studios">BACK TO STUDIOS</a>
        </div>
    </nav>

    <section class="studio-detail">
        <p class="eyebrow">YOUR SESSION STARTS HERE</p>

        <h1>BOOK A<br>SESSION<span>!</span></h1>

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
        </div>

        <p class="detail-note">YOUR ROOM. YOUR SOUND.</p>

        <div class="booking-form">
            <h2>BOOK YOUR SESSION</h2>

            <form action="/booking" method="POST">
                @csrf

                <input
                    type="hidden"
                    name="studio_id"
                    value="{{ $studio->studio_id }}"
                >

                <label for="booking_date">SELECT YOUR DATE</label>

                <input
                    type="date"
                    id="booking_date"
                    name="booking_date"
                    min="{{ now()->toDateString() }}"
                    max="{{ now()->endOfMonth()->toDateString() }}"
                    value="{{ old('booking_date', now()->toDateString()) }}"
                    required
                >

                <label class="slot-heading">SELECT YOUR TIME SLOT</label>

                <p class="slot-legend">
                    HIJAU = DIPILIH &nbsp; | &nbsp;
                    ABU-ABU = SUDAH DIPESAN
                </p>

                <div class="time-slots">
                    @foreach ($slots as $slot)
                        <label class="time-slot">
                            <input
                                type="checkbox"
                                name="time_slots[]"
                                value="{{ $slot->slot_id }}"
                                data-start="{{ $slot->start_time }}"
                                data-end="{{ $slot->end_time }}"
                                data-originally-checked="{{ in_array(
                                    (string) $slot->slot_id,
                                    array_map('strval', old('time_slots', []))
                                ) ? '1' : '0' }}"
                                {{ in_array(
                                    (string) $slot->slot_id,
                                    array_map('strval', old('time_slots', []))
                                ) ? 'checked' : '' }}
                            >

                            <span>
                                {{ substr($slot->start_time, 0, 5) }}
                                –
                                {{ substr($slot->end_time, 0, 5) }}
                                <small class="slot-status"></small>
                            </span>
                        </label>
                    @endforeach
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="booking-summary">
                    <h2>YOUR SESSION SUMMARY</h2>

                    <p>
                        Studio:
                        <strong>{{ $studio->name }}</strong>
                    </p>

                    <p>
                        Price per hour:
                        <strong
                            id="hourly-price"
                            data-price="{{ $studio->price_per_hour }}"
                        >
                            Rp {{ number_format($studio->price_per_hour, 0, ',', '.') }}
                        </strong>
                    </p>

                    <p>
                        Hours selected:
                        <strong id="selected-hours">0 hours</strong>
                    </p>

                    <p class="summary-total">
                        TOTAL:
                        <strong id="total-price">Rp 0</strong>
                    </p>
                </div>

                <button
                    type="submit"
                    class="book-room-button"
                    id="continue-booking"
                >
                    CONTINUE TO PAYMENT ↗
                </button>
            </form>
        </div>

        <a href="/studios" class="back-link">← CHANGE STUDIO</a>
    </section>

    <script type="application/json" id="booked-slots-data">
    @json($bookedSlotsByDate)
</script>

    <script>
        const slotInputs = Array.from(document.querySelectorAll(
            '.time-slots input[type="checkbox"]'
        ));

        const priceElement = document.getElementById('hourly-price');
        const hoursElement = document.getElementById('selected-hours');
        const totalElement = document.getElementById('total-price');
        const dateInput = document.getElementById('booking_date');
        const form = document.querySelector('.booking-form form');
        const continueButton = document.getElementById('continue-booking');

        const hourlyPrice = Number(priceElement.dataset.price);

        // data slot
       const bookedSlotsByDate = JSON.parse(
    document.getElementById('booked-slots-data').textContent
);

        function getBookedIds(date) {
            return (bookedSlotsByDate[date] || []).map(Number);
        }

        function updateSummary() {
            const selectedHours = slotInputs.filter(
                slot => slot.checked && !slot.disabled
            ).length;

            hoursElement.textContent =
                selectedHours + (selectedHours === 1 ? ' hour' : ' hours');

            totalElement.textContent =
                'Rp ' + (selectedHours * hourlyPrice).toLocaleString('id-ID');
        }

        function getSelectedSlots() {
            return slotInputs
                .filter(slot => slot.checked && !slot.disabled)
                .sort((a, b) =>
                    a.dataset.start.localeCompare(b.dataset.start)
                );
        }

        function isConsecutive(slots) {
            for (let i = 1; i < slots.length; i++) {
                if (slots[i - 1].dataset.end !== slots[i].dataset.start) {
                    return false;
                }
            }

            return true;
        }

        function updateAvailability() {
            const date = dateInput.value;
            const bookedIds = getBookedIds(date);

            slotInputs.forEach(slot => {
                const label = slot.closest('.time-slot');
                const status = label.querySelector('.slot-status');
                const isBooked = bookedIds.includes(Number(slot.value));

                slot.disabled = isBooked;

                if (isBooked) {
                    slot.checked = false;
                    status.textContent = 'SUDAH DIPESAN';
                } else {
                    status.textContent = '';
                }
            });

            updateSummary();
        }

        slotInputs.forEach(slot => {
            slot.addEventListener('change', function () {
                const selected = getSelectedSlots();

                if (!isConsecutive(selected)) {
                    slot.checked = false;

                    alert(
                        'Slot harus berurutan tanpa jeda waktu. ' +
                        'Contoh: 09:00–10:00 dilanjutkan 10:00–11:00.'
                    );
                }

                updateSummary();
            });
        });

        dateInput.addEventListener('change', function () {
            // Pilihan lama tidak boleh terbawa ke tanggal berbeda.
            slotInputs.forEach(slot => {
                slot.checked = false;
            });

            updateAvailability();
        });

        form.addEventListener('submit', function (event) {
            const selected = getSelectedSlots();

            if (!dateInput.value) {
                event.preventDefault();
                alert('Please select your booking date.');
                dateInput.focus();
                return;
            }

            if (selected.length === 0) {
                event.preventDefault();
                alert('Please select at least one available time slot.');
                return;
            }

            if (!isConsecutive(selected)) {
                event.preventDefault();
                alert('Please select consecutive time slots only.');
            }
        });

        updateAvailability();

        // Pulihkan pilihan lama hanya jika slot masih tersedia
        // dan slot yang dipilih berurutan.
        const oldSelection = slotInputs.filter(
            slot => slot.dataset.originallyChecked === '1'
                && !slot.disabled
        );

        if (oldSelection.length > 0 && isConsecutive(
            oldSelection.sort((a, b) =>
                a.dataset.start.localeCompare(b.dataset.start)
            )
        )) {
            oldSelection.forEach(slot => {
                slot.checked = true;
            });
        }

        updateSummary();
    </script>
</body>
</html>
