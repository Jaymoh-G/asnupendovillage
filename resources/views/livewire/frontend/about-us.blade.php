<div>
    <!--==============================
    Breadcumb
============================== -->
    @if($pageBanner && $pageBanner->effective_banner_url)
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner->effective_banner_url }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                    {{ $pageBanner->title ? $pageBanner->title : 'About Us' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">About Us</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>
    @endif @if($pageContent)
    <!--==============================
    Dynamic Content Area
    ==============================-->

        <!--==============================
    About Area
    ==============================-->
    <div class="overflow-hidden space" id="about-sec">
        <div
            class="shape-mockup about-bg-shape1-1 jump-reverse"
            data-top="10%"
            data-right="5%"
        >
            <img
                src="{{ asset('assets/img/shape/heart-shape1.png') }}"
                alt="shape"
            />
        </div>
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-xl-7">
                    <div class="img-box1">
                        @if($pageContent && $pageContent->section1_image_urls && count($pageContent->section1_image_urls) > 0)
                        <div
                            class="img1"
                        >
                            <img
                                src="{{ $pageContent->section1_image_urls[0] }}"
                                alt="About Us"
                                style="
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                "
                            />
                        </div>
                        @elseif($pageContent &&
                        $pageContent->hasMultipleImages())
                        <div
                            class="img1"
                        >
                            <img
                                src="{{ $pageContent->first_image_url }}"
                                alt="About Us"
                                style="
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                "
                            />
                        </div>
                        @else
                        <div
                            class="img1"
                        >
                            <img
                                src="{{
                                    asset('assets/img/normal/about_1_1.png')
                                }}"
                                alt="About"
                            />
                        </div>
                        @endif
                        <div class="about-shape1-1 jump">
                            <img
                                src="{{
                                    asset('assets/img/shape/about_shape1_1.png')
                                }}"
                                alt="img"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="about-wrap1">
                        <div class="title-area mb-30">
                            <span class="sub-title before-none">
                                {{ $pageContent->section1_title }}</span
                            >
                            <h2 class="sec-title">
                                        {{ $pageContent->effective_title }}
                            </h2>
                            <p class="">{!! $pageContent->section1_content !!}</p>
                        </div>
                        </div>

                        <div class="btn-wrap mt-40">
                        <a href="{{ route('programs') }}" class="th-btn"
                            >Our Programs<i
                                    class="fas fa-arrow-up-right ms-2"
                                ></i
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <!--==============================
    Core Values Area
    ==============================-->
    @if($coreValues && $coreValues->count() > 0)
    <section class="space-top">
        <div class="container">
            <div class="title-area text-center mb-50">
                <span class="sub-title">Our Foundation</span>
                <h2 class="sec-title">Core Values</h2>
            </div>
            <div class="row gy-4 justify-content-center">
                @foreach($coreValues as $coreValue)
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-card-bg-shape">
                            <img
                                src="{{
                                    asset(
                                        'assets/img/shape/feature-card-bg-shape1-1.png'
                                    )
                                }}"
                                alt="img"
                            />
                        </div>
                        <div class="box-icon">
                            @if($coreValue->icon)
                            <i
                                class="{{ $coreValue->icon }}"
                                style="font-size: 3rem; color: #ffac00"
                            ></i>
                            @else
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-2.svg')
                                }}"
                                alt="icon"
                            />
                            @endif
                        </div>
                        <h3 class="box-title">{{ $coreValue->title }}</h3>
                        <p class="box-text">
                            {{ $coreValue->description }}
                        </p>
                        <a
                            class="link-btn style2"
                            href="{{ route('contact-us') }}"
                            >Learn More
                            <i class="fa-solid fa-arrow-up-right ms-2"></i
                        ></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!--==============================
    Vision & Mission Area
    ==============================-->
    @if($pageContent && (($pageContent->section2_title || $pageContent->section2_content) || ($pageContent->section3_title || $pageContent->section3_content)))
    <section
        class="space-top"
        data-bg-src="{{ asset('assets/img/bg/gray-bg2.png') }}"
    >
        <div class="container">
            <div class="title-area text-center mb-50">
                <span class="sub-title">Our Foundation</span>
                <h2 class="sec-title">Vision & Mission</h2>
            </div>
            <div class="row gy-4">
                @if($pageContent->section2_title || $pageContent->section2_content)
                <div class="col-lg-6">
                    <div class="vision-card">
                        <div class="vision-icon">
                            <i
                                class="fas fa-eye"
                                style="font-size: 3rem; color: #ffac00"
                            ></i>
                        </div>
                        <h3 class="vision-title">{{ $pageContent->section2_title ?? 'Our Vision' }}</h3>
                        <div class="vision-text">
                            {!! $pageContent->section2_content ?? '<p>To create a world where every individual has access to the resources, support, and opportunities they need to thrive. We envision communities where compassion, equality, and sustainable development are the foundation of a brighter future for all.</p>' !!}
                    </div>
                </div>
                </div>
                @endif
                @if($pageContent->section3_title || $pageContent->section3_content)
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mission-icon">
                            <i
                                class="fas fa-bullseye"
                                style="font-size: 3rem; color: #43b738"
                            ></i>
                        </div>
                        <h3 class="mission-title">{{ $pageContent->section3_title ?? 'Our Mission' }}</h3>
                        <div class="mission-text">
                            {!! $pageContent->section3_content ?? '<p>To empower communities through sustainable development initiatives, educational programs, and humanitarian aid. We are committed to addressing the root causes of poverty and inequality while fostering long-term solutions that create lasting positive change.</p>' !!}
                    </div>
                </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!--==============================
    Founder Area
    ==============================-->
    <section class="space">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="img-box1">
                        @if($pageContent && $pageContent->section1_images &&
                        count($pageContent->section1_images) > 0)
                        <div
                            class="img1"
                        >
                            <img
                                src="{{ $pageContent->section1_image_urls[0] }}"
                                alt="Founder"
                                style="
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                "
                            />
                        </div>
                        @else
                        <div
                            class="img1"
                        >
                            <img
                                src="{{
                                    asset('assets/img/team/team_3_1.png')
                                }}"
                                alt="Founder"
                            />
                        </div>
                        @endif
                        <div class="about-shape1-1 jump">
                            <img
                                src="{{
                                    asset('assets/img/shape/about_shape1_1.png')
                                }}"
                                alt="img"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-wrap1">
                        <div class="title-area mb-30">
                            <span class="sub-title before-none"
                                >Meet Our Founder</span
                            >
                            <h2 class="sec-title">{{ $founderPage->section1_title ?? 'Our Founder' }}</h2>
                            <div class="founder-content">
                                {!! $founderPage->section1_content ?? '<p>Our founder is a visionary leader dedicated to making a positive impact in the community.</p>' !!}
                        </div>
                        </div>

                        <div class="btn-wrap mt-40">
                            <a href="{{ route('founder') }}" class="th-btn"
                                >Learn More About Our Founder<i
                                    class="fas fa-arrow-up-right ms-2"
                                ></i
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
    Team Area
    ==============================-->
    @if($teamMembers && $teamMembers->count() > 0)
    <section

        id="team-sec"
        data-bg-src="{{ asset('assets/img/bg/gray-bg2.png') }}"
    >


        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"
                    ><i class="far fa-heart text-theme"></i> Our Team</span
                >
                <h2 class="sec-title">Meet The Optimistic Team</h2>
            </div>
            <div class="slider-area">
                <div
                    class="swiper th-slider has-shadow"
                    id="teamSlider3"
                    data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'
                >
                    <div class="swiper-wrapper">
                        @foreach($teamMembers as $member)
                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    @if($member->image)
                                    <img
                                        src="{{ $member->image_url }}"
                                        alt="{{ $member->name }}"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_1.png'
                                            )
                                        }}"
                                        alt="{{ $member->name }}"
                                    />
                                    @endif
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a
                                            href="{{ route('team') }}"
                                            >{{ $member->name }}</a
                                        >
                                    </h3>
                                    <span
                                        class="team-desig"
                                        >{{ $member->position ?? 'Volunteer' }}</span
                                    >
                                    <div class="th-social style2">
                                        @if($member->facebook_url)
                                        <a
                                            target="_blank"
                                            href="{{ $member->facebook_url }}"
                                        >
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        @endif @if($member->twitter_url)
                                        <a
                                            target="_blank"
                                            href="{{ $member->twitter_url }}"
                                        >
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        @endif @if($member->instagram_url)
                                        <a
                                            target="_blank"
                                            href="{{ $member->instagram_url }}"
                                        >
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        @endif @if($member->linkedin_url)
                                        <a
                                            target="_blank"
                                            href="{{ $member->linkedin_url }}"
                                        >
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--==============================
    Video Area
    ==============================-->
    @if($featuredVideo)
    <section class="space">
    <div class="video-area-3">
        <div
            class="shape-mockup video-bg-shape3-1"
            data-top="0"
            data-left="0"
            data-bottom="0"
        >
            <img
                src="{{ asset('assets/img/shape/video_bg_shape3_1.png') }}"
                alt="img"
            />
        </div>
        <div
            class="shape-mockup video-bg-shape3-2"
            data-top="0"
            data-right="0"
            data-bottom="0"
        >
            <img
                src="{{ asset('assets/img/shape/video_bg_shape3_2.png') }}"
                alt="img"
            />
        </div>
        <div class="video-thumb3-1 video-box-center">
            <img
                src="{{ $featuredVideo->thumbnail_url }}"
                alt="{{ $featuredVideo->title ?? 'Video Thumbnail' }}"
            />
            <a
                href="{{ $featuredVideo->video_url }}"
                class="play-btn style7 popup-video"
                ><i class="fa-sharp fa-solid fa-play"></i
            ></a>
        </div>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    @if($featuredVideo->title)
                    <h3 class="video-title">{{ $featuredVideo->title }}</h3>
                    @endif
                    @if($featuredVideo->description)
                    <p class="video-description">
                        {{ $featuredVideo->description }}
                    </p>
                    @endif
                    @if($featuredVideo->duration)
                    <div class="video-meta">
                        <span class="duration">
                            <i class="fas fa-clock me-2"></i>{{ $featuredVideo->duration }}
                        </span>
                        @if($featuredVideo->published_at)
                        <span class="published-date">
                            <i class="fas fa-calendar me-2"></i>{{ $featuredVideo->published_at->format('M d, Y') }}
                        </span>
                    @endif
                </div>
                    @endif
            </div>
        </div>
    </div>
        </div>
    </section>
    @endif

    <!--==============================
    Counter Area
    ==============================-->
    @if($counterStats && $counterStats->count() > 0)
    <div class="">
        <div class="container">
            <div class="counter-wrap style2 bg-light">
                @foreach($counterStats as $statistic)
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white">
                            <span
                                class="counter-number"
                                >{{ $statistic->value }}</span
                            >
                            @if($statistic->suffix)
                            <span
                                class="fw-light"
                                >{{ $statistic->suffix }}</span
                            >
                            @endif
                        </h2>
                        <p class="box-text text-white">
                            {{ $statistic->title }}
                        </p>
                    </div>
                </div>
                @if(!$loop->last)
                <div class="divider"></div>
                @endif @endforeach
            </div>
        </div>
    </div>
    @endif

    <!--==============================
    Process Area
    ==============================-->
    @if($donationPage && ($donationPage->section1_title || $donationPage->section1_content || $donationPage->section2_title || $donationPage->section2_content || $donationPage->section3_title || $donationPage->section3_content))
    <section class="space-top">
        <div
            class="shape-mockup process-shape1-1 jump-reverse d-xxl-block d-none"
            data-top="20%"
            data-left="0"
        >
            <img
                src="{{ asset('assets/img/shape/hand-bg-shape2-1.png') }}"
                alt="img"
            />
        </div>
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"
                    >Work Process</span
                >
                <h2 class="sec-title">{{ $donationPage->section1_title ?? 'Our Donating Work Process' }}</h2>
            </div>
            <div class="row gy-40 justify-content-center">
                @if($donationPage->section1_content)
                <div class="col-lg-4 col-md-6 process-card-wrap">
                    <div class="process-card">
                        <div class="process-card-thumb-wrap">
                            <div
                                class="process-card-thumb"
                                data-mask-src="{{
                                    asset(
                                        'assets/img/process/process-card-shape.png'
                                    )
                                }}"
                            >
                                @if($donationPage->section1_images && count($donationPage->section1_images) > 0)
                                <img
                                    src="{{ asset('storage/' . $donationPage->section1_images[0]) }}"
                                    alt="Process Step 1"
                                />
                                @else
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-1-1.png'
                                        )
                                    }}"
                                    alt="img"
                                />
                                @endif
                            </div>
                            <div class="process-card-icon">
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/icon/process-icon1-1.svg'
                                        )
                                    }}"
                                    alt="img"
                                />
                            </div>
                            <div class="process-card-shape">
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-shape2.png'
                                        )
                                    }}"
                                    alt="img"
                                />
                            </div>
                        </div>
                        <div class="box-content">
                            <h3 class="box-title">{{ $donationPage->section1_title ?? 'Awareness & Engagement' }}</h3>
                            <div class="box-text">
                                {!! $donationPage->section1_content ?? '<p>To inform and engage potential donors and supporters about the charity\'s mission and the cause it supports. Utilize various channels such as social media.</p>' !!}
                        </div>
                    </div>
                </div>
                </div>
                @endif

                @if($donationPage->section2_content)
                <div class="col-lg-4 col-md-6 process-card-wrap">
                    <div class="process-card">
                        <div class="process-card-thumb-wrap">
                            <div
                                class="process-card-thumb"
                                data-mask-src="{{
                                    asset(
                                        'assets/img/process/process-card-shape.png'
                                    )
                                }}"
                            >
                                @if($donationPage->section2_images && count($donationPage->section2_images) > 0)
                                <img
                                    src="{{ asset('storage/' . $donationPage->section2_images[0]) }}"
                                    alt="Process Step 2"
                                />
                                @else
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-1-1.png'
                                        )
                                    }}"
                                    alt="img"
                                />
                                @endif
                            </div>
                            <div class="process-card-icon">
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/icon/process-icon1-2.svg'
                                        )
                                    }}"
                                    alt="img"
                                />
                            </div>
                            <div class="process-card-shape">
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-shape2.png'
                                        )
                                    }}"
                                    alt="img"
                                />
                            </div>
                        </div>
                        <div class="box-content">
                            <h3 class="box-title">{{ $donationPage->section2_title ?? 'Donation Collection' }}</h3>
                            <div class="box-text">
                                {!! $donationPage->section2_content ?? '<p>Set up a secure and user-friendly online donation platform that accepts multiple payment methods and allows for both one-time and recurring donations.</p>' !!}
                        </div>
                    </div>
                </div>
                </div>
                @endif

                @if($donationPage->section3_content)
                <div class="col-lg-4 col-md-6 process-card-wrap">
                    <div class="process-card">
                        <div class="process-card-thumb-wrap">
                            <div
                                class="process-card-thumb"
                                data-mask-src="{{
                                    asset(
                                        'assets/img/process/process-card-shape.png'
                                    )
                                }}"
                            >
                                @if($donationPage->section3_images && count($donationPage->section3_images) > 0)
                                <img
                                    src="{{ asset('storage/' . $donationPage->section3_images[0]) }}"
                                    alt="Process Step 3"
                                />
                                @else
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-1-1.png'
                                        )
                                    }}"
                                    alt="img"
                                />
                                @endif
                            </div>
                            <div class="process-card-icon">
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/icon/process-icon1-3.svg'
                                        )
                                    }}"
                                    alt="img"
                                />
                            </div>
                            <div class="process-card-shape">
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-shape2.png'
                                        )
                                    }}"
                                    alt="img"
                                />
                            </div>
                        </div>
                        <div class="box-content">
                            <h3 class="box-title">{{ $donationPage->section3_title ?? 'Impact and Accountability' }}</h3>
                            <div class="box-text">
                                {!! $donationPage->section3_content ?? '<p>Allocate funds to specific projects and initiatives that align with the charity\'s mission, ensuring that resources are used efficiently and effectively.</p>' !!}
                        </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Donation CTA Section -->
            <div class="row justify-content-center mt-50">
                <div class="col-lg-8 text-center">
                    <div class="donation-cta">
                        <h3 class="cta-title">Ready to Make a Difference?</h3>
                        <p class="cta-text">Your donation helps us continue our mission of supporting communities in need.</p>
                        <a href="{{ route('donate-now') }}" class="th-btn style2">
                            <i class="fas fa-heart me-2"></i>Donate Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif



@if($testimonials->count() > 0)

<section class="testi-area-1 space" id="testi-sec">


    <div class="shape-mockup testi-bg-shape1-2" data-top="28%" data-left="5%">
        <img src="{{ asset('assets/img/shape/testimonial_shape1_1.png') }}" alt="img" />
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="title-area text-center">
                    <span class="sub-title">Testimonials</span>
                    <h2 class="sec-title">What People Say</h2>
                </div>
            </div>
        </div>

        <div class="row gx-0 justify-content-end">
            <!-- Thumbnail Slider -->
            <div class="col-lg-5">
                <div class="swiper th-slider testi-thumb-slider1" data-slider-options='{"effect":"fade","loop":{{ $testimonials->count() > 1 ? "true" : "false" }}}'>
                    <div class="swiper-wrapper">
                        @forelse($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testi-box-img">
                                <img
                                    class="testi-img"
                                    src="{{ $testimonial->image_url ?? asset('assets/img/testimonial/testi_1_1.png') }}"
                                    alt="{{ $testimonial->name }}"
                                />
                                <div class="testi-card_review">
                                    <i class="fas fa-star"></i>
                                    5.0
                                </div>

                                @if($testimonial->pdf_file)
                                        <div class="pdf-indicator" title="PDF Document Available" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="fas fa-file-pdf text-danger"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="swiper-slide">
                            <div class="testi-box-img">
                                    <img class="testi-img" src="{{ asset('assets/img/testimonial/testi_1_1.png') }}" alt="Default testimonial" />
                                <div class="testi-card_review">
                                    <i class="fas fa-star"></i>
                                    5.0
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Main Slider -->
            <div class="col-lg-7">
                <div class="testi-slider1">
                    <div class="swiper th-slider testimonial-slider1" id="testiSlide1"
                        data-slider-options='{"loop":{{ $testimonials->count() > 1 ? "true" : "false" }},"paginationType":"progressbar","effect":"fade","autoHeight":true,"thumbs":{"swiper":".testi-thumb-slider1"}}'>
                        <div class="swiper-wrapper">
                            @forelse($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testi-card">
                                    <p class="box-text">
                                        @if($testimonial->excerpt)
                                            {!! $testimonial->excerpt !!}
                                        @else
                                            {!! Str::limit($testimonial->content, 200) !!}
                                        @endif
                                    </p>
                                    <h3 class="box-title">{{ $testimonial->name }}</h3>
                                    <p class="box-desig">{{ $testimonial->program->title ?? 'Community Member' }}</p>

                                    <div class="testimonial-actions d-flex align-items-center justify-content-between">
                                        <div class="quote-icon"
                                            data-mask-src="{{ asset('assets/img/icon/quote2.svg') }}">
                                        </div>

                                        @if($testimonial->pdf_file)
                                        <a href="{{ $testimonial->pdf_url }}" target="_blank"
                                            class="pdf-icon-link"
                                            title="View PDF Document"
                                            aria-label="View PDF document for {{ $testimonial->name }}'s testimonial">
                                            <i class="fas fa-file-pdf text-danger"></i>
                                            <span class="sr-only">PDF</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="swiper-slide">
                                <div class="testi-card">
                                    <p class="box-text">
                                        "Stay informed about our upcoming events and campaigns. Whether it's a
                                        fundraising gala, a charity run, or a community outreach program, there
                                        are plenty of ways to get involved and support our cause. Check our
                                        event calendar for details. We prioritize your security. Our donation
                                        process uses the latest encryption technology to protect your personal
                                        and financial information. Donate with confidence knowing"
                                    </p>
                                    <h3 class="box-title">Alex Fernandes</h3>
                                    <p class="box-desig">CEO, Founder</p>

                                    <div class="testimonial-actions d-flex align-items-center justify-content-between">
                                        <div class="quote-icon"
                                            data-mask-src="{{ asset('assets/img/icon/quote2.svg') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>

                        <div class="slider-pagination"></div>
                        <div class="slider-pagination2"></div>
                    </div>

                    <div class="icon-box">
                        <button data-slider-prev="#testiSlide1"
                            class="slider-arrow default style-border slider-prev">
                            <i class="far fa-arrow-left"></i>
                        </button>
                        <button data-slider-next="#testiSlide1"
                            class="slider-arrow default style-border slider-next">
                            <i class="far fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Button Section -->
        <div class="row justify-content-center mt-50">
            <div class="col-lg-6 text-center">
                <div class="testimonials-cta">
                    <h4 class="cta-title">Want to Read More Testimonials?</h4>
                    <p class="cta-text">Discover inspiring stories from our community members and supporters.</p>
                    <a href="{{ route('testimonials') }}" class="th-btn style2">
                        View All Testimonials<i class="fas fa-arrow-up-right ms-2"></i>
                    </a>
            </div>
        </div>
    </div>
</section>
@endif

    <style>
        /* Page Images Section Styling */
        .page-images-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
            margin-top: 50px;
        }
        .page-images-section h3 {
            color: #1a685b;
            border-bottom: 2px solid #ffac00;
            padding-bottom: 10px;
            margin-bottom: 30px;
            display: inline-block;
        }
        .page-image-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .page-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .page-image-item img {
            transition: transform 0.3s ease;
        }
        .page-image-item:hover img {
            transform: scale(1.05);
        }

        /* Content Sections Styling */
        .content-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
            margin-top: 50px;
        }
        .section-title {
            color: #1a685b;
            border-bottom: 2px solid #ffac00;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: inline-block;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .section-content {
            line-height: 1.8;
            color: #333;
        }
        .section-content p {
            margin-bottom: 15px;
        }
        .section-content h3,
        .section-content h4 {
            color: #1a685b;
            margin-top: 25px;
            margin-bottom: 15px;
        }
        .section-image-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .section-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .section-image-item img {
            transition: transform 0.3s ease;
        }
        .section-image-item:hover img {
            transform: scale(1.05);
        }

        /* Testimonial PDF Icon Styling */
        .testimonial-actions {
            margin-top: 15px;
        }

        .pdf-icon-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .pdf-icon-link:hover {
            background: #dc3545;
            color: white;
            transform: scale(1.1);
            border-color: #dc3545;
            text-decoration: none;
        }

        .pdf-icon-link i {
            font-size: 1.2rem;
        }

        .quote-icon {
            flex: 1;
        }

        /* PDF Indicator in Thumbnail */
        .testi-box-img {
            position: relative;
        }

        .pdf-indicator {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .pdf-indicator:hover {
            background: #dc3545;
            transform: scale(1.1);
            transition: all 0.3s ease;
        }

        /* Screen reader only text */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Vision & Mission Section Styling */
        .vision-card,
        .mission-card {
            background: white;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .vision-card:hover,
        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .vision-card {
            border-color: #ffac00;
        }

        .mission-card {
            border-color: #43b738;
        }

        .vision-icon,
        .mission-icon {
            margin-bottom: 25px;
        }

        .vision-title,
        .mission-title {
            color: #1a685b;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 2px solid;
            padding-bottom: 15px;
            display: inline-block;
        }

        .vision-title {
            border-color: #ffac00;
        }

        .mission-title {
            border-color: #43b738;
        }

        .vision-text,
        .mission-text {
            color: #666;
            line-height: 1.8;
            font-size: 1.1rem;
            margin: 0;
        }

        /* Featured Images Gallery Styling */
        .featured-image-main {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .featured-image-main:hover {
            transform: translateY(-5px);
        }

        .featured-image-main img {
            transition: transform 0.3s ease;
        }

        .featured-image-main:hover img {
            transform: scale(1.05);
        }

        .featured-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: white;
            padding: 20px;
            text-align: center;
        }

        .featured-image-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .featured-image-item:hover {
            transform: translateY(-5px);
        }

        .featured-image-item img {
            transition: transform 0.3s ease;
        }

        .featured-image-item:hover img {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 172, 0, 0.9);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Comprehensive Image Gallery Styling */
        .gallery-image-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .gallery-image-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .image-wrapper img {
            transition: transform 0.3s ease;
        }

        .gallery-image-card:hover .image-wrapper img {
            transform: scale(1.1);
        }

        .image-info-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                135deg,
                rgba(26, 104, 91, 0.8),
                rgba(255, 172, 0, 0.8)
            );
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }

        .gallery-image-card:hover .image-info-overlay {
            opacity: 1;
        }

        .image-type-badge {
            background: rgba(255, 255, 255, 0.9);
            color: #1a685b;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            align-self: flex-start;
        }

        .image-type-badge i {
            margin-right: 5px;
            color: #ffac00;
        }

        .image-number {
            background: rgba(255, 172, 0, 0.9);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            align-self: flex-end;
        }

        .image-caption {
            padding: 20px;
            text-align: center;
        }

        .caption-title {
            color: #1a685b;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .caption-text {
            color: #666;
            font-size: 0.9rem;
            margin: 0;
        }

        .sec-text {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Lightbox Styling */
        .lightbox-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            animation: fadeIn 0.3s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            text-align: center;
        }

        .lightbox-image {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .lightbox-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .lightbox-close:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.1);
        }

        .lightbox-caption {
            color: white;
            margin-top: 15px;
            font-size: 1.1rem;
            background: rgba(0, 0, 0, 0.7);
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        /* Video Section Styling */
        .video-title {
            color: #1a685b;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .video-description {
            color: #666;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        .video-meta {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .video-meta .duration,
        .video-meta .published-date {
            color: #666;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            background: rgba(255, 172, 0, 0.1);
            padding: 8px 15px;
            border-radius: 20px;
            border: 1px solid rgba(255, 172, 0, 0.2);
        }

        .video-meta .duration i,
        .video-meta .published-date i {
            color: #ffac00;
            margin-right: 5px;
        }

        .video-meta .duration:hover,
        .video-meta .published-date:hover {
            background: rgba(255, 172, 0, 0.2);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }



        /* Founder Section Styling */
        .founder-content {
            line-height: 1.8;
            color: #333;
        }

        .founder-content p {
            margin-bottom: 15px;
        }

        .achievements-title {
            color: #1a685b;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 2px solid #ffac00;
            padding-bottom: 10px;
            display: inline-block;
        }

        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .achievement-item {
            text-align: center;
        }

        .achievement-image {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #ffac00;
            transition: transform 0.3s ease;
        }

        .achievement-image:hover {
            transform: scale(1.05);
        }

        /* Testimonials CTA Styling */
        .testimonials-cta {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 40px 30px;
            border-radius: 15px;
            border: 2px solid #ffac00;
        }

        .cta-title {
            color: #1a685b;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .cta-text {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* Donation CTA Styling */
        .donation-cta {
            background: linear-gradient(135deg, #1a685b, #2d8a7a);
            color: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(26, 104, 91, 0.3);
        }

        .donation-cta .cta-title {
            color: white;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .donation-cta .cta-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .donation-cta .th-btn {
            background: #ffac00;
            border-color: #ffac00;
            color: #1a685b;
            font-size: 1.2rem;
            padding: 15px 30px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .donation-cta .th-btn:hover {
            background: #e69500;
            border-color: #e69500;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 172, 0, 0.4);
        }
    </style>

    <script>
        // Initialize tooltips if Bootstrap is available
        if (typeof bootstrap !== "undefined") {
            var tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
            );
            var tooltipList = tooltipTriggerList.map(function (
                tooltipTriggerEl
            ) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // Counter animation for statistics and counter numbers
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize image lightbox functionality
            initializeImageLightbox();
            const counters = document.querySelectorAll(
                ".counter, .counter-number"
            );
            const speed = 200;

            const animateCounter = (counter) => {
                const target = parseInt(counter.textContent);
                const increment = target / speed;
                let current = 0;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                updateCounter();
            };

            // Intersection Observer to trigger animation when in view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        animateCounter(counter);
                        observer.unobserve(counter);
                    }
                });
            });

            counters.forEach((counter) => {
                observer.observe(counter);
            });
        });

        // Image lightbox functionality
        function initializeImageLightbox() {
            const galleryImages = document.querySelectorAll(
                ".gallery-image-card img, .featured-image-item img, .featured-image-main img"
            );

            galleryImages.forEach((img) => {
                img.addEventListener("click", function () {
                    openLightbox(this.src, this.alt);
                });

                // Add cursor pointer to indicate clickable
                img.style.cursor = "pointer";
            });
        }

        function openLightbox(imageSrc, imageAlt) {
            // Create lightbox overlay
            const lightbox = document.createElement("div");
            lightbox.className = "lightbox-overlay";
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <span class="lightbox-close">&times;</span>
                    <img src="${imageSrc}" alt="${imageAlt}" class="lightbox-image">
                    <div class="lightbox-caption">${imageAlt}</div>
                </div>
            `;

            document.body.appendChild(lightbox);

            // Close lightbox on click
            lightbox.addEventListener("click", function (e) {
                if (
                    e.target === lightbox ||
                    e.target.classList.contains("lightbox-close")
                ) {
                    document.body.removeChild(lightbox);
                }
            });

            // Close on escape key
            document.addEventListener("keydown", function (e) {
                if (e.key === "Escape") {
                    if (document.body.contains(lightbox)) {
                        document.body.removeChild(lightbox);
                    }
                }
            });
        }
    </script>
</div>
