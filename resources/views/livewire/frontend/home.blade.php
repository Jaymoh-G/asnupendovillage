<div>
    @section('content')

    <!--==============================
Hero Area
==============================-->
    <livewire:frontend.home-slider-component />
    <!--======== / Hero Section ========-->
    <!--==============================
Service Area
==============================-->
    <section
        class="overflow-hidden space"
        id="service-sec"
        data-bg-src="{{ asset('assets/img/bg/gray-bg1.png') }}"
        data-overlay="gray"
        data-opacity="6"
    >
        <div
            class="shape-mockup service-bg-shape1-1 d-xxl-inline-block d-none"
            data-top="15%"
            data-left="0"
        >
            <div class="color-masking">
                <div
                    class="masking-src"
                    data-mask-src="{{
                        asset('assets/img/shape/hand-shape1.png')
                    }}"
                ></div>
                <img
                    src="{{ asset('assets/img/shape/hand-shape1.png') }}"
                    alt="img"
                />
            </div>
        </div>
        <div
            class="shape-mockup service-bg-shape1-2 d-xxl-inline-block d-none"
            data-top="35%"
            data-left="0"
        >
            <div class="color-masking">
                <div
                    class="masking-src"
                    data-mask-src="{{
                        asset('assets/img/shape/hand-shape2.png')
                    }}"
                ></div>
                <img
                    src="{{ asset('assets/img/shape/hand-shape2.png') }}"
                    alt="img"
                />
            </div>
        </div>
        <div class="service-bg-shape1-3 d-xxl-inline-block d-none"></div>
        <div class="service-bg-shape1-4 d-xxl-inline-block d-none"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="title-area text-center">
                        <span class="sub-title">Our Programs</span>
                        <h2 class="sec-title">
                            We Do it for all People Humanist Services
                        </h2>
                    </div>
                </div>
            </div>
            <div class="slider-area">
                <div
                    class="swiper th-slider has-shadow"
                    id="programSlider1"
                    data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}}, "autoHeight": "true"}'
                >
                    <div class="swiper-wrapper">
                        @if($latestPrograms && $latestPrograms->count() > 0)
                        @foreach($latestPrograms as $program)
                        <div class="swiper-slide">
                            <div class="service-card">
                                <div class="box-icon">
                                    @if(str_contains(strtolower($program->title),
                                    'food') ||
                                    str_contains(strtolower($program->title),
                                    'healthy'))
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/icon/service-icon/service-card-icon1-1.svg'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @elseif(str_contains(strtolower($program->title),
                                    'education') ||
                                    str_contains(strtolower($program->title),
                                    'learn'))
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/icon/service-icon/service-card-icon1-2.svg'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @elseif(str_contains(strtolower($program->title),
                                    'medical') ||
                                    str_contains(strtolower($program->title),
                                    'health'))
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/icon/service-icon/service-card-icon1-3.svg'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @elseif(str_contains(strtolower($program->title),
                                    'community') ||
                                    str_contains(strtolower($program->title),
                                    'development'))
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/icon/service-icon/service-card-icon1-1.svg'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @elseif(str_contains(strtolower($program->title),
                                    'housing') ||
                                    str_contains(strtolower($program->title),
                                    'home'))
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/icon/service-icon/service-card-icon1-2.svg'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @elseif(str_contains(strtolower($program->title),
                                    'youth') ||
                                    str_contains(strtolower($program->title),
                                    'empowerment'))
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/icon/service-icon/service-card-icon1-3.svg'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @elseif(str_contains(strtolower($program->title),
                                    'emergency') ||
                                    str_contains(strtolower($program->title),
                                    'relief'))
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/icon/service-icon/service-card-icon1-1.svg'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/icon/service-icon/service-card-icon1-1.svg'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @endif
                                </div>
                                <div class="box-content">
                                    <h3 class="box-title">
                                        <a
                                            href="{{ route('programs.detail', $program->slug) }}"
                                            >{{ $program->title }}</a
                                        >
                                    </h3>
                                    <p class="box-text">
                                        {!! Str::limit($program->content, 120) !!}
                                    </p>
                                    <a
                                        href="{{ route('programs.detail', $program->slug) }}"
                                        class="th-btn"
                                        >Learn More<i
                                            class="fas fa-arrow-up-right ms-2"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        @endforeach @else
                        <div class="swiper-slide">
                            <div class="service-card">
                                <div class="box-content text-center">
                                    <p class="text-muted">
                                        No programs available at the moment.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <button
                    data-slider-prev="#programSlider1"
                    class="slider-arrow slider-prev"
                >
                    <i class="far fa-arrow-left"></i>
                </button>
                <button
                    data-slider-next="#programSlider1"
                    class="slider-arrow slider-next"
                >
                    <i class="far fa-arrow-right"></i>
                </button>
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
                                src="{{asset('assets/img/shape/about_shape1_1.png')}}"
                                alt="img"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="about-wrap1">
                        <div class="title-area mb-30">
                            @if($homePageContent->has('about-us'))
                                @php $aboutUs = $homePageContent['about-us']; @endphp
                                @if($aboutUs->subtitle)
                                    <span class="sub-title before-none">{{ $aboutUs->subtitle }}</span>
                                @endif
                                @if($aboutUs->title)
                                    <h2 class="sec-title">{{ $aboutUs->title }}</h2>
                                @endif
                                @if($aboutUs->description)
                                    <p class="">{{ $aboutUs->description }}</p>
                                @endif
                            @else
                                <span class="sub-title before-none">About Us</span>
                                <h2 class="sec-title">We Believe that We can Save More Life's with you</h2>
                                <p class="">Donet is the largest global crowdfunding community connecting nonprofits, donors, and companies in nearly every country. We help nonprofits from Afghanistan to Zimbabwe (and hundreds of places in between) access the tools, training, and support they need to be more effective and make our world a better place.</p>
                            @endif
                        </div>
                        <div class="checklist style2 list-two-column">
                            <ul>
                                @if($homePageContent->has('about-us') && !empty($homePageContent['about-us']->checklist_items))
                                    @foreach($homePageContent['about-us']->checklist_items as $item)
                                        <li @if($item['color']) data-theme-color="{{ $item['color'] }}" @endif>{{ $item['text'] }}</li>
                                    @endforeach
                                @else
                                    <li>Charity For Foods</li>
                                    <li data-theme-color="var(--theme-color2)">Charity For Water</li>
                                    <li data-theme-color="#FF5528">Charity For Education</li>
                                    <li data-theme-color="#122F2A">Charity For Medical</li>
                                @endif
                            </ul>
                        </div>
                        <div class="btn-wrap mt-40">
                            @if($homePageContent->has('about-us') && $homePageContent['about-us']->button_text)
                                <a href="{{ $homePageContent['about-us']->button_url ?? 'about.html' }}" class="th-btn">
                                    {{ $homePageContent['about-us']->button_text }}<i class="fas fa-arrow-up-right ms-2"></i>
                                </a>
                            @else
                                <a href="about.html" class="th-btn">About More<i class="fas fa-arrow-up-right ms-2"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
Cta Area
==============================-->
    <div class="cta-area-1">
        <div
            class="container z-index-common"
            data-pos-for="#donation-sec"
            data-sec-pos="bottom-half"
        ></div>
    </div>
    <!--==============================
Donation Area
==============================-->

    <!--==============================
Cta Area
==============================-->
    <section
        class="cta-area-2 space overflow-hidden bg-theme-dark"
        id="contact-sec"
    >
        <div
            class="cta-bg-shape2-1 shape-mockup jump d-lg-block d-none"
            data-top="-22%"
            data-left="2%"
        >
            <img src="{{ asset('assets/img/shape/cta_shape2_1.png') }}" alt="img" />
        </div>
        <div
            class="cta-bg-shape2-2 shape-mockup jump-reverse d-lg-block d-none"
            data-top="-12%"
            data-right="-5%"
        >
            <img src="{{ asset('assets/img/shape/cta_shape2_2.png') }}" alt="img" />
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="title-area text-center mb-0">
                        @if($homePageContent->has('cta-section'))
                            @php $ctaSection = $homePageContent['cta-section']; @endphp
                            @if($ctaSection->title)
                                <h2 class="sec-title text-white">{{ $ctaSection->title }}</h2>
                            @endif
                            @if($ctaSection->button_text)
                                <a href="{{ $ctaSection->button_url ?? 'contact.html' }}" class="th-btn style5 mt-40">
                                    {{ $ctaSection->button_text }}<i class="fas fa-arrow-up-right ms-2"></i>
                                </a>
                            @endif
                        @else
                            <h2 class="sec-title text-white">Our Door Are Always Open to More People Who Want to Support Each Others!</h2>
                            <a href="contact.html" class="th-btn style5 mt-40">Get Involved<i class="fas fa-arrow-up-right ms-2"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==============================
Story Area
==============================-->
    <div class="story-area-1 overflow-hidden space">
        <div class="container">
            <div
                class="row gy-40 justify-content-between flex-row-reverse align-items-center"
            >
                <div class="col-xl-7">
                    <div class="story-img-box1">
                        <div class="box-wrap d-inline-block">
                            <div class="img1">
                                <img
                                    src="assets/img/normal/story_1_1.png"
                                    alt="img"
                                />
                            </div>
                            <div class="story-shape1-1 jump-reverse">
                                <img
                                    src="{{ asset('assets/img/shape/story_shape1_1.png') }}"
                                    alt="img"
                                />
                            </div>
                            <div class="story-card movingX">
                                <h5 class="box-title">Adam Cruz</h5>
                                <p class="box-text">
                                    Our success stories highlight the real life
                                    impact of your donations & the resilience of
                                    those we help. These narratives showcase the
                                    power of compassion.
                                </p>
                                <div
                                    class="quote-icon"
                                    data-mask-src="{{ asset('assets/img/icon/quote.svg') }}"
                                ></div>
                            </div>
                            <div class="year-counter">
                                <p class="year-counter_text">
                                    Years of <span>Experience</span>
                                </p>
                                <div class="year-counter_number">
                                    <span class="counter-number">16</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="story-wrap1">
                        <div class="title-area mb-0">
                            @if($homePageContent->has('story-section'))
                                @php $storySection = $homePageContent['story-section']; @endphp
                                @if($storySection->subtitle)
                                    <span class="sub-title before-none">{{ $storySection->subtitle }}</span>
                                @endif
                                @if($storySection->title)
                                    <h2 class="sec-title">{{ $storySection->title }}</h2>
                                @endif
                                @if($storySection->description)
                                    <p class="mt-30">{{ $storySection->description }}</p>
                                @endif
                                @if($storySection->button_text)
                                    <div class="btn-wrap mt-35">
                                        <a href="{{ $storySection->button_url ?? 'about.html' }}" class="th-btn style-border">
                                            {{ $storySection->button_text }}<i class="fas fa-arrow-up-right ms-2"></i>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <span class="sub-title before-none">Success Story</span>
                                <h2 class="sec-title">We Help Fellow Nonprofits Access the Funding Tools, Training</h2>
                                <p class="mt-30">Our secure online donation platform allows you to make contributions quickly and safely. Choose from various payment methods and set up one-time.exactly.</p>
                                <div class="btn-wrap mt-35">
                                    <a href="about.html" class="th-btn style-border">Our Success Story<i class="fas fa-arrow-up-right ms-2"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
Team Area
==============================-->
    <section class="space-bottom team-area-1">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title">Our Volunteer</span>
                <h2 class="sec-title">Meet The Optimistic Volunteer</h2>
            </div>
            @if($latestTeamMembers && $latestTeamMembers->count() > 0)
            <div class="slider-area">
                <div
                    class="swiper th-slider has-shadow team-slider1"
                    id="teamSlider1"
                    data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}, "autoHeight": "true"}'
                >
                    <div class="swiper-wrapper">
                        @foreach($latestTeamMembers as $teamMember)
                        <!-- Single Item -->
                        <div class="swiper-slide">
                            <div class="th-team team-card">
                                <div class="img-wrap">
                                    <div class="team-img">
                                        <img
                                            src="{{ $teamMember->image_url ?? asset('assets/img/team/team_1_1.png') }}"
                                            alt="{{ $teamMember->name }}"
                                        />
                                    </div>
                                    <div class="team-social-hover">
                                        <a
                                            href="#"
                                            class="team-social-hover_btn"
                                        >
                                            <i class="far fa-plus"></i>
                                        </a>
                                        <div class="th-social">
                                            @if($teamMember->twitter)
                                            <a
                                                target="_blank"
                                                href="{{ $teamMember->twitter }}"
                                                ><i class="fab fa-twitter"></i
                                            ></a>
                                            @endif @if($teamMember->facebook)
                                            <a
                                                target="_blank"
                                                href="{{ $teamMember->facebook }}"
                                                ><i
                                                    class="fab fa-facebook-f"
                                                ></i
                                            ></a>
                                            @endif @if($teamMember->instagram)
                                            <a
                                                target="_blank"
                                                href="{{ $teamMember->instagram }}"
                                                ><i class="fab fa-instagram"></i
                                            ></a>
                                            @endif @if($teamMember->linkedin)
                                            <a
                                                target="_blank"
                                                href="{{ $teamMember->linkedin }}"
                                                ><i class="fab fa-linkedin"></i
                                            ></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="team-card-content">
                                    <h3 class="box-title">
                                        <a
                                            href="{{ route('team.detail', $teamMember->slug) }}"
                                            >{{ $teamMember->name }}</a
                                        >
                                    </h3>
                                    <span
                                        class="team-desig"
                                        >{{ $teamMember->position }}</span
                                    >
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button
                    data-slider-prev="#teamSlider1"
                    class="slider-arrow slider-prev"
                >
                    <i class="far fa-arrow-left"></i>
                </button>
                <button
                    data-slider-next="#teamSlider1"
                    class="slider-arrow slider-next"
                >
                    <i class="far fa-arrow-right"></i>
                </button>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-6">
                    <div class="text-center">
                        <a href="{{ route('team') }}" class="th-btn"
                            >View All Team Members<i
                                class="fas fa-arrow-up-right ms-2"
                            ></i
                        ></a>
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">
                    No team members available at the moment.
                </p>
            </div>
            @endif
        </div>
    </section>
    <!--==============================
Video Area
==============================-->
    <div class="video-area-1 space bg-theme overflow-hidden">
        <div class="shape-mockup video-bg-shape1-1" data-top="0" data-left="0">
            <img src="{{ asset('assets/img/shape/video_shape1_1.png') }}" alt="img" />
        </div>
        <div
            class="shape-mockup video-bg-shape1-2"
            data-bottom="0"
            data-right="0"
        >
            <img src="{{ asset('assets/img/shape/video_shape1_2.png') }}" alt="img" />
        </div>
        <div class="container">
            <div class="row gy-40 justify-content-between">
                <div class="col-xl-5">
                    <div class="title-area mb-35">
                        @if($homePageContent->has('statistics'))
                            @php $statisticsSection = $homePageContent['statistics']; @endphp
                            @if($statisticsSection->title)
                                <h2 class="sec-title text-white">{{ $statisticsSection->title }}</h2>
                            @endif
                            @if($statisticsSection->description)
                                <p class="text-white">{{ $statisticsSection->description }}</p>
                            @endif
                        @else
                            <h2 class="sec-title text-white">We Always Help The Needy People</h2>
                            <p class="text-white">Discover the inspiring stories of individuals and communities transformed by our programs. Our success stories highlight the real-life impact of your donations.</p>
                        @endif
                    </div>
                    <div class="row">
                        @if($homePageContent->has('statistics') && !empty($homePageContent['statistics']->statistics))
                            @foreach($homePageContent['statistics']->statistics as $statistic)
                                <div class="col-sm-6 counter-card-wrap">
                                    <div class="counter-card">
                                        <h2 class="box-number @if($statistic['color']) text-theme2 @else text-white @endif">
                                            <span class="counter-number">{{ $statistic['number'] }}</span>{{ $statistic['suffix'] ?? '' }}
                                        </h2>
                                        <p class="box-text text-white">{{ $statistic['label'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-6 counter-card-wrap">
                                <div class="counter-card">
                                    <h2 class="box-number text-theme2"><span class="counter-number">15</span>k<span class="fw-light">+</span></h2>
                                    <p class="box-text text-white">Incredible Volunteers</p>
                                </div>
                            </div>
                            <div class="col-sm-6 counter-card-wrap">
                                <div class="counter-card">
                                    <h2 class="box-number text-white"><span class="counter-number">1</span>k<span class="fw-light">+</span></h2>
                                    <p class="box-text text-white">Successful Campaigns</p>
                                </div>
                            </div>
                            <div class="col-sm-6 counter-card-wrap">
                                <div class="counter-card">
                                    <h2 class="box-number text-white"><span class="counter-number">400</span><span class="fw-light">+</span></h2>
                                    <p class="box-text text-white">Monthly Donors</p>
                                </div>
                            </div>
                            <div class="col-sm-6 counter-card-wrap">
                                <div class="counter-card">
                                    <h2 class="box-number text-theme2"><span class="counter-number">35</span>k<span class="fw-light">+</span></h2>
                                    <p class="box-text text-white">Team Support</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="video-thumb1-1 video-box-center">
                        @if($homePageContent->has('statistics') && $homePageContent['statistics']->image)
                            <img
                                src="{{ $homePageContent['statistics']->image_url ?? asset('assets/img/normal/video-thumb1-1.png') }}"
                                alt="Statistics Section Image"
                                class="img-fluid"
                            />
                        @elseif($homePageContent->has('statistics') && $homePageContent['statistics']->video_url)
                            @php
                                // Extract YouTube video ID from URL
                                $videoUrl = $homePageContent['statistics']->video_url;
                                $videoId = null;
                                if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]+)/', $videoUrl, $matches)) {
                                    $videoId = $matches[1];
                                }
                            @endphp
                            @if($videoId)
                                <img
                                    src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg"
                                    alt="YouTube Video Thumbnail"
                                    class="img-fluid"
                                    onerror="this.src='https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg'"
                                />
                            @else
                                <img
                                    src="{{ asset('assets/img/normal/video-thumb1-1.png') }}"
                                    alt="Default Image"
                                    class="img-fluid"
                                />
                            @endif
                        @elseif($homePageContent->has('video-section') && $homePageContent['video-section']->video_url)
                            <img
                                src="{{ $homePageContent['video-section']->video_thumbnail_url ?? asset('assets/img/normal/video-thumb1-1.png') }}"
                                alt="Video Thumbnail"
                                class="img-fluid"
                            />
                        @else
                            <img
                                src="{{ asset('assets/img/normal/video-thumb1-1.png') }}"
                                alt="Default Image"
                                class="img-fluid"
                            />
                        @endif

                        @if($homePageContent->has('video-section') && $homePageContent['video-section']->video_url)
                            <a href="{{ $homePageContent['video-section']->video_url }}" class="play-btn style2 popup-video">
                                <i class="fa-sharp fa-solid fa-play"></i>
                            </a>
                        @elseif($homePageContent->has('statistics') && $homePageContent['statistics']->video_url)
                            <a href="{{ $homePageContent['statistics']->video_url }}" class="play-btn style2 popup-video">
                                <i class="fa-sharp fa-solid fa-play"></i>
                            </a>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==============================

    <div class="overflow-hidden brand-area-1">
        <div class="container">
            <div class="brand-wrap1 bg-gray text-center" data-mask-src="{{ asset('assets/img/shape/brand-bg-shape1.png') }}">
                <h3 class="brand-wrap-title">Trusted by over <span class="text-theme2"><span class="counter-number">90</span>K+</span> companies worldwide</h3>
                <div class="swiper th-slider" id="brandSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"},"1400":{"slidesPerView":"5", "spaceBetween": "90"}}}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-1.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-2.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-3.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-4.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-5.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-1.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-2.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-3.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-4.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-5.svg" alt="Brand Logo">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    Project Area
==============================-->
    <section
        class="space bg-gray"
        data-bg-src="{{ asset('assets/img/bg/donation-bg1-1.png') }}"
        id="project-sec"
    >
        <div
            class="shape-mockup donation-bg-shape1-1"
            data-bottom="0"
            data-right="0"
        >
            <img src="{{ asset('assets/img/shape/donation-shape1-1.png') }}" alt="shape" />
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="title-area text-center">
                        <span class="sub-title">Complete Projects</span>
                        <h2 class="sec-title">Our Recent Projects</h2>
                    </div>
                </div>
            </div>
            @if($latestProjects && $latestProjects->count() > 0)
            <div class="slider-area">
                <div
                    class="swiper th-slider has-shadow"
                    id="ProjectSlider1"
                    data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}, "autoHeight": "true"}'
                >
                    <div class="swiper-wrapper">
                        @foreach($latestProjects as $project)
                        <div class="swiper-slide">
                            <div class="donation-card" data-theme-color="">
                                <div
                                    class="donation-card-shape"
                                    data-mask-src="assets/img/donation/donation-card-bg-shape1-1.png"
                                ></div>
                                <div class="box-thumb">
                                    <img
                                        src="{{ $project->image_url ?? asset('assets/img/project/project_1_1.png') }}"
                                        alt="{{ $project->name }}"
                                    />
                                </div>
                                <div class="box-content">
                                    <h3 class="box-title">
                                        <a
                                            href="{{ route('projects.detail', $project->slug) }}"
                                            >{{ $project->name }}</a
                                        >
                                    </h3>
                                    <p class="project-subtitle">
                                        {{ $project->program ? $project->program->title : 'Project' }}
                                    </p>
                                    <a
                                        href="{{ route('projects.detail', $project->slug) }}"
                                        class="th-btn style6"
                                        >View Project
                                        <i
                                            class="fas fa-arrow-up-right ms-2"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">No projects available at the moment.</p>
            </div>
            @endif
        </div>
    </section>
    <!--==============================

Blog Area
==============================-->
    <section class="space" id="blog-sec">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title">News & Articles</span>
                <h2 class="sec-title">Our Latest News & Articles</h2>
            </div>
            @if($latestNews && $latestNews->count() > 0)
            <div class="slider-area">
                <div
                    class="swiper th-slider has-shadow"
                    id="blogSlider1"
                    data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}, "autoHeight": "true"}'
                >
                    <div class="swiper-wrapper">
                        @foreach($latestNews as $news)
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <div class="blog-img">
                                    <a
                                        href="{{ route('news.detail', $news->slug) }}"
                                    >
                                        <div
                                            class="blog-img-shape1"
                                            data-mask-src="{{
                                                asset(
                                                    'assets/img/blog/blog-card-bg-shape1-2.png'
                                                )
                                            }}"
                                        ></div>
                                        <img
                                            src="{{ $news->featured_image_url ?? asset('assets/img/blog/blog_1_1.jpg') }}"
                                            alt="{{ $news->title }}"
                                        />
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div
                                        class="blog-card-shape"
                                        data-mask-src="{{
                                            asset(
                                                'assets/img/blog/blog-card-bg-shape1-1.png'
                                            )
                                        }}"
                                    ></div>
                                    <div class="blog-meta">
                                        <a href="{{ route('news') }}"
                                            ><i class="fas fa-calendar"></i
                                            >{{ $news->published_at ? $news->published_at->format('F j, Y') : $news->created_at->format('F j, Y') }}</a
                                        >
                                        @if($news->category)
                                        <a href="{{ route('news') }}"
                                            ><i class="fas fa-tags"></i
                                            >{{ $news->category }}</a
                                        >
                                        @endif
                                    </div>
                                    <h3 class="box-title">
                                        <a
                                            href="{{ route('news.detail', $news->slug) }}"
                                            >{{ $news->title }}</a
                                        >
                                    </h3>
                                    <a
                                        href="{{ route('news.detail', $news->slug) }}"
                                        class="th-btn"
                                        >Read More
                                        <i
                                            class="fas fa-arrow-up-right ms-2"
                                        ></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button
                    data-slider-prev="#blogSlider1"
                    class="slider-arrow slider-prev"
                >
                    <i class="far fa-arrow-left"></i>
                </button>
                <button
                    data-slider-next="#blogSlider1"
                    class="slider-arrow slider-next"
                >
                    <i class="far fa-arrow-right"></i>
                </button>
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">
                    No news articles available at the moment.
                </p>
            </div>
            @endif
        </div>
    </section>
    @endsection
</div>
