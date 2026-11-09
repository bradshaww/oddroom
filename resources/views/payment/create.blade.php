<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment — ODDROOM</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <main class="payment-page">

        <header class="payment-heading">
            <p class="payment-eyebrow">ODDROOM — BOOKING CHECKOUT</p>
            <h1>COMPLETE YOUR<br><span>PAYMENT </span></h1>
            <p class="payment-subtitle">
                One step closer to your next session. Complete your payment
                and secure your studio booking.
            </p>
        </header>

        @if ($errors->any())
            <div class="payment-errors">
                @foreach ($errors->all() as $error)
                    <p>↗ {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="payment-layout">

            <!-- LEFT: BOOKING SUMMARY -->
            <section class="payment-summary">

                <div class="payment-card-heading">
                    <span>01 / YOUR BOOKING</span>
                    <span>SUMMARY</span>
                </div>

                <div class="booking-id">
                    <p>BOOKING REFERENCE</p>
                    <h2>#{{ $booking->booking_id }}</h2>
                </div>

                <div class="summary-details">

                    <div class="summary-item">
                        <span>STUDIO</span>
                        <strong>{{ $booking->studio_name }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>BOOKING DATE</span>
                        <strong>{{ $booking->booking_date }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>SELECTED TIME</span>

                        <div class="summary-time">
                            @forelse ($slots as $slot)
                                <span>
                                    {{ substr($slot->start_time, 0, 5) }}
                                    –
                                    {{ substr($slot->end_time, 0, 5) }}
                                </span>
                            @empty
                                <span>No time slots found.</span>
                            @endforelse
                        </div>
                    </div>

                </div>

                <div class="summary-total">
                    <span>TOTAL PAYMENT</span>
                    <h2>
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="summary-note">
                    MAKE SURE YOUR BOOKING DETAILS ARE CORRECT
                    BEFORE SUBMITTING YOUR PAYMENT.
                </div>

            </section>


            <!-- RIGHT: PAYMENT FORM -->
            <section class="payment-content">

                <div class="payment-card-heading">
                    <span>02 / PAYMENT DETAILS</span>
                    <span>CHECKOUT</span>
                </div>

                <div class="payment-instructions">

                    <div class="instruction-title">
                        <span>PAYMENT INSTRUCTIONS</span>
                        <span class="instruction-number">↗</span>
                    </div>

                    <p>
                        Contact our admin to receive the latest bank
                        transfer or e-wallet payment details.
                    </p>

                    <a
                        href="https://wa.me/6285810735945?text=Hello%20ODDROOM%2C%20I%20need%20payment%20details%20for%20Booking%20%23{{ $booking->booking_id }}."
                        target="_blank"
                        rel="noopener noreferrer"
                        class="whatsapp-button"
                    >
                        <span>CONTACT ADMIN</span>
                        <span>VIA WHATSAPP ↗</span>
                    </a>

                </div>


                <div class="verification-note">
                    <div class="verification-icon">!</div>

                    <div>
                        <strong>PAYMENT VERIFICATION</strong>
                        <p>
                            Your payment proof will be reviewed by our admin
                            within a maximum of 30 minutes after submission.
                        </p>
                    </div>
                </div>


                <form
                    action="{{ url('/payment/' . $booking->booking_id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="payment-form"
                >
                    @csrf

                    <div class="form-section-heading">
                        <span>03 / SUBMIT YOUR PAYMENT</span>
                    </div>

                    <label for="payment_method">
                        PAYMENT METHOD
                    </label>

                    <select
                        id="payment_method"
                        name="payment_method"
                        required
                    >
                        <option value="">SELECT PAYMENT METHOD</option>

                        <option value="bank_transfer"
                            {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>
                            Bank Transfer (9013 9799 5379 seabank)
                        </option>

                        <option value="e_wallet"
                            {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>
                            E-Wallet (9013 9799 5379 seabank)
                        </option>
                    </select>


                    <label class="proof-label">
                        PAYMENT PROOF
                    </label>

                    <label for="payment_proof" class="proof-upload">

                        <span class="upload-icon">↑</span>

                        <strong>UPLOAD YOUR PAYMENT PROOF</strong>

                        <span class="upload-description">
                            Click here to choose an image
                        </span>

                        <span class="upload-filename" id="file-name">
                            JPG, JPEG or PNG — MAX. 2 MB
                        </span>

                        <input
                            type="file"
                            id="payment_proof"
                            name="payment_proof"
                            accept="image/*"
                            required
                        >

                    </label>

                    <button type="submit" class="payment-submit">
                        SUBMIT PAYMENT PROOF <span></span>
                    </button>

                </form>

            </section>

        </div>

        <footer class="payment-footer">
            <span>ODDROOM</span>
            <span>MAKE SOME NOISE. MAKE SOME MUSIC.</span>
        </footer>

    </main>


    <script>
        const paymentProof = document.getElementById('payment_proof');
        const fileName = document.getElementById('file-name');

        paymentProof.addEventListener('change', function () {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileName.classList.add('file-selected');
            } else {
                fileName.textContent = 'JPG, JPEG or PNG — MAX. 2 MB';
                fileName.classList.remove('file-selected');
            }
        });
    </script>

</body>
</html>