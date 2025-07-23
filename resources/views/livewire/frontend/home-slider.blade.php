<div>
    @if($sliders && $sliders->count() > 0)
    <div class="th-hero-wrapper hero-1" id="hero">
        <div
            class="swiper th-slider hero-slider1"
            id="heroSlide1"
            data-slider-options='{"effect":"fade", "autoHeight": "true"}'
        >
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                <div class="swiper-slide">
                    <div
                        class="hero-inner"
                        data-bg-src="{{ $slider->featured_image_url ?? asset('assets/img/hero/hero_bg_1_1.jpg') }}"
                        data-overlay="black4"
                        data-opacity="5"
                    >
                        <div class="hero-bg-shape1-1">
                            <img
                                src="{{
                                    asset(
                                        'assets/img/hero/hero-bg-shape1-1.png'
                                    )
                                }}"
                                alt="img"
                            />
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-8 col-lg-9">
                                    <div class="hero-style1 text-center">
                                        @if($slider->subtitle)
                                        <span
                                            class="hero-subtitle"
                                            >{{ $slider->subtitle }}</span
                                        >
                                        @endif
                                        <h1 class="hero-title">
                                            {{ $slider->title }}
                                        </h1>
                                        @if($slider->description)
                                        <p class="hero-text">
                                            {{ $slider->description }}
                                        </p>
                                        @endif @if($slider->button_text &&
                                        $slider->button_url)
                                        <div class="hero-btn">
                                            <a
                                                href="{{ $slider->button_url }}"
                                                class="th-btn style6"
                                            >
                                                {{ $slider->button_text }}
                                                <i
                                                    class="fas fa-arrow-up-right ms-2"
                                                ></i>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider-pagination"></div>
            <div class="slider-pagination2"></div>
            <div class="slider-pagination-progressbar2">
                <div class="slider-progressbar-fill"></div>
            </div>
        </div>
        <div class="icon-box">
            <button
                data-slider-prev="#heroSlide1"
                class="slider-arrow default style-border slider-prev"
            >
                <i class="far fa-arrow-left"></i>
            </button>
            <button
                data-slider-next="#heroSlide1"
                class="slider-arrow default style-border slider-next"
            >
                <i class="far fa-arrow-right"></i>
            </button>
        </div>
    </div>
    @else
    {{-- Fallback to default hero section if no sliders --}}
    <div class="th-hero-wrapper hero-1" id="hero">
        <div
            class="swiper th-slider hero-slider1"
            id="heroSlide1"
            data-slider-options='{"effect":"fade", "autoHeight": "true"}'
        >
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div
                        class="hero-inner"
                        data-bg-src="{{
                            asset('assets/img/hero/hero_bg_1_1.jpg')
                        }}"
                        data-overlay="black4"
                        data-opacity="5"
                    >
                        <div class="hero-bg-shape1-1">
                            <img
                                src="{{
                                    asset(
                                        'assets/img/hero/hero-bg-shape1-1.png'
                                    )
                                }}"
                                alt="img"
                            />
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-8 col-lg-9">
                                    <div class="hero-style1 text-center">
                                        <span class="hero-subtitle"
                                            >Welcome to ASN Upendo Village</span
                                        >
                                        <h1 class="hero-title">
                                            Empowering Communities Through
                                            Compassion
                                        </h1>
                                        <p class="hero-text">
                                            Join us in making a difference in
                                            the lives of those who need it most.
                                            Together, we can build a brighter
                                            future for everyone.
                                        </p>
                                        <div class="hero-btn">
                                            <a
                                                href="{{ route('donate-now') }}"
                                                class="th-btn style6"
                                            >
                                                Donate Now
                                                <i
                                                    class="fas fa-arrow-up-right ms-2"
                                                ></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-pagination"></div>
            <div class="slider-pagination2"></div>
            <div class="slider-pagination-progressbar2">
                <div class="slider-progressbar-fill"></div>
            </div>
        </div>
        <div class="icon-box">
            <button
                data-slider-prev="#heroSlide1"
                class="slider-arrow default style-border slider-prev"
            >
                <i class="far fa-arrow-left"></i>
            </button>
            <button
                data-slider-next="#heroSlide1"
                class="slider-arrow default style-border slider-next"
            >
                <i class="far fa-arrow-right"></i>
            </button>
        </div>
    </div>
    @endif
</div>
