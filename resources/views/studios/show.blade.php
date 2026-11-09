
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $studio->name }} - ODDROOM</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

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

        .studio-detail {
            max-width: 1150px;
            width: 90%;
            margin: 65px auto;
        }

        .detail-heading {
            margin-bottom: 35px;
        }

        .eyebrow {
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 3px;
            color: #244C3A;
            margin-bottom: 12px;
        }

        .detail-heading h1 {
            font-size: clamp(32px, 5vw, 55px);
            line-height: 1.1;
            margin: 0;
            color: #171714;
            text-transform: uppercase;
        }

        .detail-layout {
            display: grid;
            grid-template-columns: 1.35fr 0.85fr;
            gap: 55px;
            align-items: start;
        }

        /* PHOTO SLIDER */

        .studio-gallery {
            width: 100%;
        }

        .studio-slider {
            width: 100%;
            overflow: hidden;
            background: #E9DFC9;
        }

        .slider-track {
            display: flex;
            width: 100%;
            transition: transform 0.45s ease-in-out;
        }

        .slider-image {
            display: block;
            flex: 0 0 100%;
            width: 100%;
            height: 430px;
            object-fit: cover;
        }

        .slider-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 17px;
        }

        .slider-navigation {
            display: flex;
            gap: 10px;
        }

        .slider-button {
            width: 42px;
            height: 42px;
            border: 2px solid #171714;
            background: #F2C94C;
            color: #171714;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 3px 3px 0 #171714;
            transition: 0.2s;
        }

        .slider-button:hover {
            background: #F28C8C;
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0 #171714;
        }

        .slider-indicator {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .slider-dots {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .slider-dot {
            width: 9px;
            height: 9px;
            padding: 0;
            border: 1.5px solid #171714;
            border-radius: 50%;
            background: transparent;
            cursor: pointer;
        }

        .slider-dot.active {
            background: #244C3A;
        }

        .slider-counter {
            font-size: 12px;
            font-weight: bold;
            color: #171714;
        }

        /* STUDIO INFORMATION */

        .studio-information {
            padding-top: 5px;
        }

        .info-label {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #244C3A;
            margin-bottom: 13px;
        }

        .studio-description {
            font-size: 15px;
            line-height: 1.9;
            color: #393932;
            margin: 0 0 30px;
            white-space: pre-line;
        }

        .info-divider {
            width: 100%;
            height: 2px;
            background: #171714;
            margin: 25px 0;
        }

        .price-label {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 9px;
            color: #244C3A;
        }

        .price {
            font-size: 29px;
            font-weight: bold;
            color: #171714;
            margin: 0;
        }

        .price span {
            font-size: 13px;
            font-weight: normal;
        }

        .detail-note {
            margin-top: 30px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #244C3A;
        }

        .book-room-button {
            display: inline-block;
            margin-top: 12px;
            padding: 15px 23px;
            background: #F2C94C;
            border: 2px solid #171714;
            color: #171714;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 4px 4px 0 #171714;
            transition: 0.2s;
        }

        .book-room-button:hover {
            background: #F28C8C;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0 #171714;
        }

        .back-link {
            display: inline-block;
            margin-top: 45px;
            color: #244C3A;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .no-image {
            padding: 70px 20px;
            background: #E9DFC9;
            text-align: center;
            font-weight: bold;
        }

        @media (max-width: 800px) {
            .studio-detail {
                margin: 40px auto;
            }

            .detail-layout {
                grid-template-columns: 1fr;
                gap: 35px;
            }

            .slider-image {
                height: 350px;
            }

            .studio-information {
                padding-top: 0;
            }
        }

        @media (max-width: 500px) {
            .studio-detail {
                width: 92%;
            }

            .slider-image {
                height: 260px;
            }

            .detail-heading {
                margin-bottom: 25px;
            }

            .slider-button {
                width: 36px;
                height: 36px;
            }

            .price {
                font-size: 25px;
            }
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
            <a href="/studios">BOOK A SESSION</a>
        </div>

    </nav>

    @php
        $images = $studioImages ?? collect();

        if ($images->isEmpty() && $studio->image) {
            $images = collect([
                (object) ['image_path' => $studio->image]
            ]);
        }
    @endphp

    <section class="studio-detail">

        <div class="detail-heading">
            <p class="eyebrow">GET TO KNOW YOUR SPACE</p>
            <h1>{{ $studio->name }}</h1>
        </div>

        <div class="detail-layout">

            <!-- PHOTO GALLERY -->

            <div class="studio-gallery">

                @if ($images->isNotEmpty())

                    <div class="studio-slider" id="studioSlider">

                        <div class="slider-track" id="sliderTrack">

                            @foreach ($images as $image)
                                <img
                                    src="{{ asset('images/' . $image->image_path) }}"
                                    alt="{{ $studio->name }} - Foto {{ $loop->iteration }}"
                                    class="slider-image"
                                >
                            @endforeach

                        </div>

                    </div>

                    @if ($images->count() > 1)

                        <div class="slider-controls">

                            <div class="slider-navigation">
                                <button
                                    type="button"
                                    class="slider-button"
                                    id="prevSlide"
                                    aria-label="Foto sebelumnya"
                                >
                                    &#8592;
                                </button>

                                <button
                                    type="button"
                                    class="slider-button"
                                    id="nextSlide"
                                    aria-label="Foto berikutnya"
                                >
                                    &#8594;
                                </button>
                            </div>

                            <div class="slider-indicator">

                                <div class="slider-dots">
                                    @foreach ($images as $image)
                                        <button
                                            type="button"
                                            class="slider-dot {{ $loop->first ? 'active' : '' }}"
                                            data-index="{{ $loop->index }}"
                                            aria-label="Lihat foto {{ $loop->iteration }}"
                                        ></button>
                                    @endforeach
                                </div>

                                <span class="slider-counter" id="sliderCounter">
                                    1 / {{ $images->count() }}
                                </span>

                            </div>

                        </div>

                    @endif

                @else

                    <div class="no-image">
                        FOTO STUDIO BELUM TERSEDIA
                    </div>

                @endif

            </div>

            <!-- STUDIO INFORMATION -->

            <div class="studio-information">

                <p class="info-label">ABOUT THIS ROOM</p>

                <p class="studio-description">
                    {{ $studio->description }}
                </p>

                <div class="info-divider"></div>

                <p class="price-label">HOURLY RATE</p>

                <p class="price">
                    Rp {{ number_format($studio->price_per_hour, 0, ',', '.') }}
                    <span>/ hour</span>
                </p>

                <p class="detail-note">
                    READY TO MAKE SOME NOISE?
                </p>

                <a
                    href="/booking?studio_id={{ $studio->studio_id }}"
                    class="book-room-button"
                >
                    BOOK THIS ROOM ↗
                </a>

            </div>

        </div>

        <a href="/studios" class="back-link">
            ← BACK TO STUDIOS
        </a>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const slider = document.getElementById('studioSlider');
            const track = document.getElementById('sliderTrack');

            if (!slider || !track) return;

            const slides = track.querySelectorAll('.slider-image');
            const dots = document.querySelectorAll('.slider-dot');
            const counter = document.getElementById('sliderCounter');

            const prevButton = document.getElementById('prevSlide');
            const nextButton = document.getElementById('nextSlide');

            let currentSlide = 0;
            let touchStartX = 0;
            let touchEndX = 0;

            function showSlide(index) {
                if (slides.length === 0) return;

                currentSlide = (index + slides.length) % slides.length;

                track.style.transform =
                    `translateX(-${currentSlide * 100}%)`;

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });

                if (counter) {
                    counter.textContent =
                        `${currentSlide + 1} / ${slides.length}`;
                }
            }

            if (prevButton) {
                prevButton.addEventListener('click', function () {
                    showSlide(currentSlide - 1);
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', function () {
                    showSlide(currentSlide + 1);
                });
            }

            dots.forEach((dot) => {
                dot.addEventListener('click', function () {
                    showSlide(Number(this.dataset.index));
                });
            });

            slider.addEventListener('touchstart', function (event) {
                touchStartX = event.changedTouches[0].screenX;
            }, { passive: true });

            slider.addEventListener('touchend', function (event) {
                touchEndX = event.changedTouches[0].screenX;

                const difference = touchStartX - touchEndX;

                if (Math.abs(difference) > 50) {
                    showSlide(
                        difference > 0
                            ? currentSlide + 1
                            : currentSlide - 1
                    );
                }
            }, { passive: true });

            showSlide(0);

        });
    </script>

</body>
</html>
