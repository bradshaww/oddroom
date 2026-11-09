<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings — ODDROOM</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .booking-container {
            max-width: 850px;
            margin: 60px auto;
            padding: 0 24px;
        }

        .booking-header {
            margin-bottom: 32px;
        }

        .booking-header h1 {
            margin-bottom: 8px;
        }

        .booking-list {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .booking-summary {
            background: var(--cream);
            border: 2px solid var(--black);
            box-shadow: 6px 6px 0 var(--black);
            padding: 24px;
        }

        .booking-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .booking-top h2 {
            margin: 0;
        }

        .status-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .status-badge {
            display: inline-block;
            padding: 7px 11px;
            border: 2px solid var(--black);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .status-pending {
            background: var(--yellow);
        }

        .status-success {
            background: #A8D5A2;
        }

        .status-danger {
            background: var(--pink);
        }

        .status-neutral {
            background: var(--blue);
        }

        .booking-details {
            border-top: 2px dashed var(--black);
            padding-top: 16px;
        }

        .booking-detail {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin: 10px 0;
        }

        .booking-detail strong {
            font-weight: 800;
        }

        .time-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 10px 0 16px;
        }

        .time-item {
            background: white;
            border: 1.5px solid var(--black);
            padding: 7px 10px;
            font-size: 13px;
            font-weight: 700;
        }

        .booking-total {
            border-top: 2px solid var(--black);
            margin-top: 16px;
            padding-top: 16px;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 900;
        }

        .booking-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .booking-actions a {
            text-decoration: none;
            text-align: center;
        }

        .contact-admin {
            display: block;
            width: fit-content;
            margin: 28px auto 0;
            padding: 13px 20px;
            background: var(--green);
            color: var(--cream);
            border: 2px solid var(--black);
            box-shadow: 4px 4px 0 var(--black);
            font-weight: 800;
            text-decoration: none;
        }

        .contact-admin:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0 var(--black);
        }

        .success-message {
            background: #A8D5A2;
            border: 2px solid var(--black);
            padding: 12px 16px;
            margin-bottom: 24px;
            font-weight: 700;
        }

        @media (max-width: 600px) {
            .booking-container {
                margin: 35px auto;
            }

            .booking-detail {
                flex-direction: column;
                gap: 4px;
            }

            .booking-total {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <main class="booking-container">

        <header class="booking-header">
            <h1>MY BOOKINGS</h1>
            <p>check your verification, contact us when you need anything.</p>
        </header>

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="booking-list">

            @forelse ($bookings as $booking)

                <section class="booking-summary">

                    <div class="booking-top">
                        <h2>{{ $booking->studio_name }}</h2>

                        <div class="status-group">
                            @php
                                $bookingStatusClass = match ($booking->status) {
                                    'confirmed', 'completed' => 'status-success',
                                    'cancelled', 'rejected' => 'status-danger',
                                    'pending_payment', 'pending_verification' => 'status-pending',
                                    default => 'status-neutral',
                                };

                                $paymentStatusClass = match ($booking->payment_status) {
                                    'approved', 'paid' => 'status-success',
                                    'rejected' => 'status-danger',
                                    'waiting', 'pending' => 'status-pending',
                                    default => 'status-neutral',
                                };
                            @endphp

                            <span class="status-badge {{ $bookingStatusClass }}">
                                {{ str_replace('_', ' ', $booking->status) }}
                            </span>

                            <span class="status-badge {{ $paymentStatusClass }}">
                                {{ $booking->payment_status
                                    ? str_replace('_', ' ', $booking->payment_status)
                                    : 'NOT PAID' }}
                            </span>
                        </div>
                    </div>

                    <div class="booking-details">

                        <div class="booking-detail">
                            <strong>Booking Date</strong>
                            <span>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                            </span>
                        </div>

                        <strong>Selected Time</strong>

                        <div class="time-list">
                            @forelse ($booking->slots as $slot)
                                <span class="time-item">
                                    {{ substr($slot->start_time, 0, 5) }}
                                    –
                                    {{ substr($slot->end_time, 0, 5) }}
                                </span>
                            @empty
                                <span>No time slots recorded.</span>
                            @endforelse
                        </div>

                        <div class="booking-total">
                            <span>TOTAL</span>
                            <span>
                                Rp {{ number_format($booking->total, 0, ',', '.') }}
                            </span>
                        </div>

                    </div>

                    @if ($booking->status === 'pending_payment')
                        <div class="booking-actions">
                            <a href="{{ url('/payment/' . $booking->booking_id) }}"
                               class="book-room-button">
                                CONTINUE PAYMENT ↗
                            </a>
                        </div>
                    @endif

                </section>

            @empty

                <section class="booking-summary">
                    <h2>NO BOOKINGS YET</h2>
                    <p>Your next studio session starts here.</p>
                </section>

            @endforelse

        </div>

        <div class="booking-actions">
            <a href="{{ url('/studios') }}" class="book-room-button">
                BROWSE STUDIOS ↗
            </a>
        </div>

        <a href="https://wa.me/6285810735945"
           target="_blank"
           rel="noopener noreferrer"
           class="contact-admin">
            CONTACT ADMIN VIA WHATSAPP ↗
        </a>

    </main>

</body>
</html>