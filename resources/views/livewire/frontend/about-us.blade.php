<div>
    <!--==============================
    Breadcumb
============================== -->
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner ? $pageBanner->effective_banner_url : asset('assets/img/bg/breadcumb-bg.jpg') }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                    {{ $pageBanner && $pageBanner->title ? $pageBanner->title : 'About Us' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>

    @if($pageContent)
    <!--==============================
    Dynamic Content Area
    ==============================-->
    <section class="space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="title-area text-center mb-50">
                        <h1 class="sec-title">
                            {{ $pageContent->effective_title }}
                        </h1>
                        @if($pageContent->excerpt)
                        <p class="sec-text">{{ $pageContent->excerpt }}</p>
                        @endif
                    </div>
                    <div class="content-area">
                        {!! $pageContent->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--==============================
    Feature Area
    ==============================-->
    <section class="space-top">
        <div class="container">
            <div class="row gy-4 justify-content-center">
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
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-2.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Donor Friendly</h3>
                        <p class="box-text">
                            Stay updated with the latest news, events, and
                            impact stories from our organization. Subscribe to
                            our newsletter.
                        </p>
                        <a
                            class="link-btn style2"
                            href="{{ route('contact-us') }}"
                            >View Details
                            <i class="fa-solid fa-arrow-up-right ms-2"></i
                        ></a>
                    </div>
                </div>
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
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-1.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Fundraising Trust</h3>
                        <p class="box-text">
                            Stay updated with the latest news, events, and
                            impact stories from our organization. Subscribe to
                            our newsletter.
                        </p>
                        <a
                            class="link-btn style2"
                            href="{{ route('contact-us') }}"
                            >View Details
                            <i class="fa-solid fa-arrow-up-right ms-2"></i
                        ></a>
                    </div>
                </div>
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
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-2.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Charity Donate</h3>
                        <p class="box-text">
                            Stay updated with the latest news, events, and
                            impact stories from our organization. Subscribe to
                            our newsletter.
                        </p>
                        <a
                            class="link-btn style2"
                            href="{{ route('contact-us') }}"
                            >View Details
                            <i class="fa-solid fa-arrow-up-right ms-2"></i
                        ></a>
                    </div>
                </div>
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
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-1.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Treatment Help</h3>
                        <p class="box-text">
                            Stay updated with the latest news, events, and
                            impact stories from our organization. Subscribe to
                            our newsletter.
                        </p>
                        <a
                            class="link-btn style2"
                            href="{{ route('contact-us') }}"
                            >View Details
                            <i class="fa-solid fa-arrow-up-right ms-2"></i
                        ></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <div
                            class="img1"
                            data-mask-src="{{
                                asset('assets/img/normal/about_1_1-mask.png')
                            }}"
                        >
                            <img
                                src="{{
                                    asset('assets/img/normal/about_1_1.png')
                                }}"
                                alt="About"
                            />
                        </div>
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
                            <span class="sub-title before-none"
                                >About Us ASN Upendo Village</span
                            >
                            <h2 class="sec-title">
                                We Believe that We can Save More Life's with you
                            </h2>
                            <p class="">
                                ASN Upendo Village is dedicated to making a
                                positive impact in our community through various
                                charitable initiatives and programs. We help
                                people from all walks of life access the tools,
                                training, and support they need to be more
                                effective and make our world a better place.
                            </p>
                        </div>
                        <div class="checklist style2 list-two-column">
                            <ul>
                                <li>Charity For Foods</li>
                                <li data-theme-color="var(--theme-color2)">
                                    Charity For Water
                                </li>
                                <li data-theme-color="#FF5528">
                                    Charity For Education
                                </li>
                                <li data-theme-color="#122F2A">
                                    Charity For Medical
                                </li>
                            </ul>
                        </div>
                        <div class="btn-wrap mt-40">
                            <a href="{{ route('contact-us') }}" class="th-btn"
                                >About More<i
                                    class="fas fa-arrow-up-right ms-2"
                                ></i
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
    Founder Area
    ==============================-->
    <section
        class="space"
        data-bg-src="{{ asset('assets/img/bg/gray-bg2.png') }}"
    >
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="img-box1">
                        <div
                            class="img1"
                            data-mask-src="{{
                                asset('assets/img/normal/about_1_1-mask.png')
                            }}"
                        >
                            <img
                                src="{{
                                    asset('assets/img/team/team_3_1.png')
                                }}"
                                alt="Founder"
                            />
                        </div>
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
                            <h2 class="sec-title">John Doe</h2>
                            <p class="mb-4">
                                John Doe is the visionary founder and CEO of ASN
                                Upendo Village. With over 15 years of experience
                                in community development and charitable work,
                                John has dedicated his life to making a positive
                                impact in the lives of others.
                            </p>
                            <p class="mb-4">
                                Born and raised in the local community, John
                                witnessed firsthand the challenges faced by
                                families and individuals in need. This
                                experience inspired him to establish ASN Upendo
                                Village in 2010, with the mission to provide
                                support, resources, and hope to those who need
                                it most.
                            </p>
                        </div>
                        <div class="checklist style2">
                            <ul>
                                <li>
                                    15+ Years of Community Development
                                    Experience
                                </li>
                                <li>Master's Degree in Social Work</li>
                                <li>
                                    Certified Non-Profit Management Professional
                                </li>
                                <li>
                                    Recipient of Community Service Excellence
                                    Award
                                </li>
                            </ul>
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
    <section
        class="space"
        id="team-sec"
        data-bg-src="{{ asset('assets/img/bg/gray-bg2.png') }}"
    >
        <div
            class="shape-mockup team-bg-shape3-1 d-xxl-block d-none"
            data-top="0%"
            data-left="0%"
            data-bottom="0"
        >
            <img
                src="{{ asset('assets/img/shape/team_bg_shape3_1.png') }}"
                alt="img"
            />
        </div>
        <div
            class="shape-mockup team-bg-shape3-2 d-xxl-block d-none"
            data-top="0%"
            data-right="0%"
            data-bottom="0"
        >
            <img
                src="{{ asset('assets/img/shape/team_bg_shape3_2.png') }}"
                alt="img"
            />
        </div>
        <div
            class="shape-mockup team-bg-shape3-3 spin d-xxl-block d-none"
            data-top="15%"
            data-left="20%"
        >
            <div class="color-masking2">
                <div
                    class="masking-src"
                    data-mask-src="{{
                        asset('assets/img/shape/team_bg_shape3_3.png')
                    }}"
                ></div>
                <img
                    src="{{ asset('assets/img/shape/team_bg_shape3_3.png') }}"
                    alt="img"
                />
            </div>
        </div>
        <div
            class="shape-mockup team-bg-shape3-4 jump d-xxl-block d-none"
            data-top="18%"
            data-right="10%"
        >
            <img
                src="{{ asset('assets/img/shape/team_bg_shape3_4.png') }}"
                alt="img"
            />
        </div>
        <div
            class="shape-mockup team-bg-shape3-5 spin d-xxl-block d-none"
            data-bottom="18%"
            data-left="10%"
        >
            <img
                src="{{ asset('assets/img/shape/team_bg_shape3_5.png') }}"
                alt="img"
            />
        </div>
        <div
            class="shape-mockup team-bg-shape3-6 spin d-xxl-block d-none"
            data-bottom="10%"
            data-right="10%"
        >
            <div class="color-masking">
                <div
                    class="masking-src"
                    data-mask-src="{{
                        asset('assets/img/shape/team_bg_shape3_6.png')
                    }}"
                ></div>
                <img
                    src="{{ asset('assets/img/shape/team_bg_shape3_6.png') }}"
                    alt="img"
                />
            </div>
        </div>
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"
                    ><i class="far fa-heart text-theme"></i> Our Volunteer</span
                >
                <h2 class="sec-title">Meet The Optimistic Volunteer</h2>
            </div>
            <div class="slider-area">
                <div
                    class="swiper th-slider has-shadow"
                    id="teamSlider3"
                    data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'
                >
                    <div class="swiper-wrapper">
                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_1.png'
                                            )
                                        }}"
                                        alt="Team"
                                    />
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a href="{{ route('team') }}"
                                            >Michel Connor</a
                                        >
                                    </h3>
                                    <span class="team-desig">Volunteer</span>
                                    <div class="th-social style2">
                                        <a
                                            target="_blank"
                                            href="https://facebook.com/"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://twitter.com/"
                                            ><i class="fab fa-twitter"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://instagram.com/"
                                            ><i class="fab fa-instagram"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://behance.com/"
                                            ><i class="fab fa-behance"></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_2.png'
                                            )
                                        }}"
                                        alt="Team"
                                    />
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a href="{{ route('team') }}"
                                            >Jessica Lauren</a
                                        >
                                    </h3>
                                    <span class="team-desig">Volunteer</span>
                                    <div class="th-social style2">
                                        <a
                                            target="_blank"
                                            href="https://facebook.com/"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://twitter.com/"
                                            ><i class="fab fa-twitter"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://instagram.com/"
                                            ><i class="fab fa-instagram"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://behance.com/"
                                            ><i class="fab fa-behance"></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_3.png'
                                            )
                                        }}"
                                        alt="Team"
                                    />
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a href="{{ route('team') }}"
                                            >Daniel Thomas</a
                                        >
                                    </h3>
                                    <span class="team-desig">Volunteer</span>
                                    <div class="th-social style2">
                                        <a
                                            target="_blank"
                                            href="https://facebook.com/"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://twitter.com/"
                                            ><i class="fab fa-twitter"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://instagram.com/"
                                            ><i class="fab fa-instagram"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://behance.com/"
                                            ><i class="fab fa-behance"></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_4.png'
                                            )
                                        }}"
                                        alt="Team"
                                    />
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a href="{{ route('team') }}"
                                            >Michel Vetory</a
                                        >
                                    </h3>
                                    <span class="team-desig">Volunteer</span>
                                    <div class="th-social style2">
                                        <a
                                            target="_blank"
                                            href="https://facebook.com/"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://twitter.com/"
                                            ><i class="fab fa-twitter"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://instagram.com/"
                                            ><i class="fab fa-instagram"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://behance.com/"
                                            ><i class="fab fa-behance"></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_5.png'
                                            )
                                        }}"
                                        alt="Team"
                                    />
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a href="{{ route('team') }}"
                                            >Emma Mary</a
                                        >
                                    </h3>
                                    <span class="team-desig">Volunteer</span>
                                    <div class="th-social style2">
                                        <a
                                            target="_blank"
                                            href="https://facebook.com/"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://twitter.com/"
                                            ><i class="fab fa-twitter"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://instagram.com/"
                                            ><i class="fab fa-instagram"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://behance.com/"
                                            ><i class="fab fa-behance"></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_6.png'
                                            )
                                        }}"
                                        alt="Team"
                                    />
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a href="{{ route('team') }}"
                                            >Alexander Joseph</a
                                        >
                                    </h3>
                                    <span class="team-desig">Volunteer</span>
                                    <div class="th-social style2">
                                        <a
                                            target="_blank"
                                            href="https://facebook.com/"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://twitter.com/"
                                            ><i class="fab fa-twitter"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://instagram.com/"
                                            ><i class="fab fa-instagram"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://behance.com/"
                                            ><i class="fab fa-behance"></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_7.png'
                                            )
                                        }}"
                                        alt="Team"
                                    />
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a href="{{ route('team') }}"
                                            >Olivia Patricia</a
                                        >
                                    </h3>
                                    <span class="team-desig">Volunteer</span>
                                    <div class="th-social style2">
                                        <a
                                            target="_blank"
                                            href="https://facebook.com/"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://twitter.com/"
                                            ><i class="fab fa-twitter"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://instagram.com/"
                                            ><i class="fab fa-instagram"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://behance.com/"
                                            ><i class="fab fa-behance"></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card3">
                                <div class="team-img">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/team/team_3_8.png'
                                            )
                                        }}"
                                        alt="Team"
                                    />
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a href="{{ route('team') }}"
                                            >Ethan David</a
                                        >
                                    </h3>
                                    <span class="team-desig">Volunteer</span>
                                    <div class="th-social style2">
                                        <a
                                            target="_blank"
                                            href="https://facebook.com/"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://twitter.com/"
                                            ><i class="fab fa-twitter"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://instagram.com/"
                                            ><i class="fab fa-instagram"></i
                                        ></a>
                                        <a
                                            target="_blank"
                                            href="https://behance.com/"
                                            ><i class="fab fa-behance"></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
    Video Area
    ==============================-->
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
                src="{{ asset('assets/img/normal/video-thumb3-1.png') }}"
                alt="img"
            />
            <a
                href="https://www.youtube.com/watch?v=_sI_Ps7JSEk"
                class="play-btn style7 popup-video"
                ><i class="fa-sharp fa-solid fa-play"></i
            ></a>
        </div>
    </div>

    <!--==============================
    Counter Area
    ==============================-->
    <div class="">
        <div class="container">
            <div class="counter-wrap style2 bg-light">
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white">
                            <span class="counter-number">15</span>k<span
                                class="fw-light"
                                >+</span
                            >
                        </h2>
                        <p class="box-text text-white">Incredible Volunteers</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white">
                            <span class="counter-number">1</span>k<span
                                class="fw-light"
                                >+</span
                            >
                        </h2>
                        <p class="box-text text-white">Successful Campaigns</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white">
                            <span class="counter-number">400</span
                            ><span class="fw-light">+</span>
                        </h2>
                        <p class="box-text text-white">Monthly Donors</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white">
                            <span class="counter-number">35</span>k<span
                                class="fw-light"
                                >+</span
                            >
                        </h2>
                        <p class="box-text text-white">Team Support</p>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </div>

    <!--==============================
    Process Area
    ==============================-->
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
                <h2 class="sec-title">Our Donating Work Process</h2>
            </div>
            <div class="row gy-40 justify-content-center">
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
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-1-1.png'
                                        )
                                    }}"
                                    alt="img"
                                />
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
                            <h3 class="box-title">Awareness & Engagement</h3>
                            <p class="box-text">
                                To inform and engage potential donors and
                                supporters about the charity's mission and the
                                cause it supports. Utilize various channels such
                                as social media.
                            </p>
                        </div>
                    </div>
                </div>
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
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-1-1.png'
                                        )
                                    }}"
                                    alt="img"
                                />
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
                            <h3 class="box-title">Donation Collection</h3>
                            <p class="box-text">
                                Set up a secure and user-friendly online
                                donation platform that accepts multiple payment
                                methods and allows for both one-time and
                                recurring donations.
                            </p>
                        </div>
                    </div>
                </div>
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
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/process/process-card-1-1.png'
                                        )
                                    }}"
                                    alt="img"
                                />
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
                            <h3 class="box-title">Impact and Accountability</h3>
                            <p class="box-text">
                                Allocate funds to specific projects and
                                initiatives that align with the charity's
                                mission, ensuring that resources are used
                                efficiently and effectively.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
    Testimonial Area
    ==============================-->
    <section class="testi-area-1 space" id="testi-sec">
        <div
            class="shape-mockup testi-bg-shape1-1 jump-reverse d-xl-block d-none"
            data-top="5%"
            data-right="0"
        >
            <img
                src="{{ asset('assets/img/shape/footer-bg-shape3.png') }}"
                alt="img"
            />
        </div>
        <div
            class="shape-mockup testi-bg-shape1-2"
            data-top="28%"
            data-left="5%"
        >
            <img
                src="{{ asset('assets/img/shape/testimonial_shape1_1.png') }}"
                alt="img"
            />
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title-area text-center">
                        <span class="sub-title">Testimonials</span>
                        <h2 class="sec-title">
                            What People Say About Our Charity
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row gx-0 justify-content-end">
                <div class="col-lg-5">
                    <div
                        class="swiper th-slider testi-thumb-slider1"
                        data-slider-options='{"effect":"fade","loop":false}'
                    >
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testi-box-img">
                                    <img
                                        class="testi-img"
                                        src="{{
                                            asset(
                                                'assets/img/testimonial/testi_1_1.png'
                                            )
                                        }}"
                                        alt="img"
                                    />
                                    <div class="testi-card_review">
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-box-img">
                                    <img
                                        class="testi-img"
                                        src="{{
                                            asset(
                                                'assets/img/testimonial/testi_1_2.png'
                                            )
                                        }}"
                                        alt="img"
                                    />
                                    <div class="testi-card_review">
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-box-img">
                                    <img
                                        class="testi-img"
                                        src="{{
                                            asset(
                                                'assets/img/testimonial/testi_1_1.png'
                                            )
                                        }}"
                                        alt="img"
                                    />
                                    <div class="testi-card_review">
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-box-img">
                                    <img
                                        class="testi-img"
                                        src="{{
                                            asset(
                                                'assets/img/testimonial/testi_1_2.png'
                                            )
                                        }}"
                                        alt="img"
                                    />
                                    <div class="testi-card_review">
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="testi-slider1">
                        <div
                            class="swiper th-slider testimonial-slider1"
                            id="testiSlide1"
                            data-slider-options='{"loop":false,"paginationType":"progressbar","effect":"fade", "autoHeight": "true", "thumbs":{"swiper":".testi-thumb-slider1"}}'
                        >
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testi-card">
                                        <p class="box-text">
                                            "Stay informed about our upcoming
                                            events and campaigns. Whether it's a
                                            fundraising gala, a charity run, or
                                            a community outreach program, there
                                            are plenty of ways to get involved
                                            and support our cause. Check our
                                            event calendar for details. We
                                            prioritize your security. Our
                                            donation process uses the latest
                                            encryption technology to protect
                                            your personal and financial
                                            information. Donate with confidence
                                            knowing"
                                        </p>
                                        <h3 class="box-title">
                                            Alex Furnandes
                                        </h3>
                                        <p class="box-desig">CEO, Founder</p>
                                        <div
                                            class="quote-icon"
                                            data-mask-src="{{
                                                asset(
                                                    'assets/img/icon/quote2.svg'
                                                )
                                            }}"
                                        ></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card">
                                        <p class="box-text">
                                            "Our donation process uses the
                                            latest encryption technology to
                                            protect your personal and financial
                                            information. Donate with confidence
                                            knowing Stay informed about our
                                            upcoming events and campaigns.
                                            Whether it's a fundraising gala, a
                                            charity run, or a community outreach
                                            program, there are plenty of ways to
                                            get involved and support our cause.
                                            Check our event calendar for
                                            details. We prioritize your
                                            security."
                                        </p>
                                        <h3 class="box-title">Mustafa Kamal</h3>
                                        <p class="box-desig">CEO, Founder</p>
                                        <div
                                            class="quote-icon"
                                            data-mask-src="{{
                                                asset(
                                                    'assets/img/icon/quote2.svg'
                                                )
                                            }}"
                                        ></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card">
                                        <p class="box-text">
                                            "Stay informed about our upcoming
                                            events and campaigns. Whether it's a
                                            fundraising gala, a charity run, or
                                            a community outreach program, there
                                            are plenty of ways to get involved
                                            and support our cause. Check our
                                            event calendar for details. We
                                            prioritize your security. Our
                                            donation process uses the latest
                                            encryption technology to protect
                                            your personal and financial
                                            information. Donate with confidence
                                            knowing"
                                        </p>
                                        <h3 class="box-title">
                                            Alex Furnandes
                                        </h3>
                                        <p class="box-desig">CEO, Founder</p>
                                        <div
                                            class="quote-icon"
                                            data-mask-src="{{
                                                asset(
                                                    'assets/img/icon/quote2.svg'
                                                )
                                            }}"
                                        ></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card">
                                        <p class="box-text">
                                            "Our donation process uses the
                                            latest encryption technology to
                                            protect your personal and financial
                                            information. Donate with confidence
                                            knowing Stay informed about our
                                            upcoming events and campaigns.
                                            Whether it's a fundraising gala, a
                                            charity run, or a community outreach
                                            program, there are plenty of ways to
                                            get involved and support our cause.
                                            Check our event calendar for
                                            details. We prioritize your
                                            security."
                                        </p>
                                        <h3 class="box-title">Mustafa Kamal</h3>
                                        <p class="box-desig">CEO, Founder</p>
                                        <div
                                            class="quote-icon"
                                            data-mask-src="{{
                                                asset(
                                                    'assets/img/icon/quote2.svg'
                                                )
                                            }}"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-pagination"></div>
                            <div class="slider-pagination2"></div>
                        </div>
                        <div class="icon-box">
                            <button
                                data-slider-prev="#testiSlide1"
                                class="slider-arrow default style-border slider-prev"
                            >
                                <i class="far fa-arrow-left"></i>
                            </button>
                            <button
                                data-slider-next="#testiSlide1"
                                class="slider-arrow default style-border slider-next"
                            >
                                <i class="far fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
    Brand Area
    ==============================-->
    <div class="space-bottom overflow-hidden brand-area-1">
        <div class="container">
            <div class="brand-wrap1 p-0 m-0 text-center">
                <h3 class="brand-wrap-title">
                    Trusted by over
                    <span class="text-theme2"
                        ><span class="counter-number">90</span>K+</span
                    >
                    companies worldwide
                </h3>
                <div
                    class="swiper th-slider"
                    id="brandSlider1"
                    data-slider-options='{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"},"1400":{"slidesPerView":"5", "spaceBetween": "90"}}}'
                >
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-1.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-2.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-3.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-4.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-5.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-1.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-2.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-3.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-4.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#" class="brand-box">
                                <img
                                    src="{{
                                        asset('assets/img/brand/brand1-5.svg')
                                    }}"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
