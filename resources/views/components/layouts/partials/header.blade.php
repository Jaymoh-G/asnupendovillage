<div class="popup-search-box d-none d-lg-block">
    <button class="searchClose"><i class="far fa-times"></i></button>
    <form action="#">
        <input type="text" placeholder="What are you looking for?" />
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
</div>
<!--==============================
    Mobile Menu
  ============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="{{ route('home') }}">
                @if(\App\Models\Setting::get('header_logo'))
                <img
                    src="{{ asset('storage/' . \App\Models\Setting::get('header_logo')) }}"
                    alt="{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}"
                />
                @else
                <img
                    src="{{ asset('assets/img/logo.svg') }}"
                    alt="{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}"
                />
                @endif
            </a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li><a href="{{ route('about-us') }}">About Us</a></li>
                <li class="menu-item-has-children">
                    <a href="#">Donations</a>
                    <ul class="sub-menu">
                        <li><a href="donation.html">Donations</a></li>
                        <li>
                            <a href="donation-details.html">Donation Details</a>
                        </li>
                        <li>
                            <a href="{{ route('donate-now') }}">Donate Now</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Our Programs</a>
                    <ul class="sub-menu">
                        @forelse($programs as $program)
                        <li>
                            <a
                                href="{{ route('programs.detail', $program->slug) }}"
                                >{{ $program->title }}</a
                            >
                        </li>
                        @empty
                        <li>
                            <a href="{{ route('programs') }}">All Programs</a>
                        </li>
                        @endforelse
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="team.html">Volunteers</a></li>
                        <li>
                            <a href="team-details.html">Volunteer Details</a>
                        </li>

                        <li><a href="pricing.html">Pricing</a></li>
                        <li><a href="faq.html">FAQS</a></li>
                        <li>
                            <a href="{{ route('testimonials') }}"
                                >Testimonials</a
                            >
                        </li>
                        <li><a href="error.html">Error Page</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="{{ route('facilities') }}">Facilities</a>
                    <ul class="sub-menu">
                        @forelse($facilities as $facility)
                        <li>
                            <a
                                href="{{ route('facilities.detail', $facility->slug) }}"
                                >{{ $facility->name }}</a
                            >
                        </li>
                        @empty
                        <li>
                            <a href="{{ route('facilities') }}"
                                >All Facilities</a
                            >
                        </li>
                        @endforelse
                    </ul>
                </li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                <li class="menu-item-has-children">
                    <a href="#">Blog</a>
                    <ul class="sub-menu">
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('contact-us') }}">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="color-scheme-wrap active">
    <button class="switchIcon"><i class="fa-solid fa-palette"></i></button>
    <h3 class="color-scheme-wrap-title text-center">Color Switcher</h3>
    <h4 class="color-scheme-wrap-subtitle text-center">Theme Color</h4>
    <div class="color-switch-btns">
        <button data-color="#1A685B">
            <i class="fa-solid fa-droplet"></i>
        </button>
        <button data-color="#f34e3a">
            <i class="fa-solid fa-droplet"></i>
        </button>
        <button data-color="#FF4857">
            <i class="fa-solid fa-droplet"></i>
        </button>
        <button data-color="#3843C1">
            <i class="fa-solid fa-droplet"></i>
        </button>
        <button data-color="#FF7E02">
            <i class="fa-solid fa-droplet"></i>
        </button>
    </div>
    <h4 class="color-scheme-wrap-subtitle mt-20 text-center">
        Secondary Color
    </h4>
    <div class="secondary-color-switch-btns">
        <button data-secondary-color="#FFAC00">
            <i class="fa-solid fa-droplet"></i>
        </button>
        <button data-secondary-color="#F41E1E">
            <i class="fa-solid fa-droplet"></i>
        </button>
        <button data-secondary-color="#f34e3a">
            <i class="fa-solid fa-droplet"></i>
        </button>
        <button data-secondary-color="#FF4857">
            <i class="fa-solid fa-droplet"></i>
        </button>
        <button data-secondary-color="#3843C1">
            <i class="fa-solid fa-droplet"></i>
        </button>
    </div>
</div>
<!--==============================
 Header Area
==============================-->
<header class="th-header header-default">
    <div class="menu-top">
        <div class="container">
            <div
                class="row justify-content-center justify-content-lg-between align-items-center gy-2"
            >
                <div class="d-none d-lg-block col-auto">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            @if(\App\Models\Setting::get('header_logo'))
                            <img
                                src="{{ asset('storage/' . \App\Models\Setting::get('header_logo')) }}"
                                alt="{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}"
                            />
                            @else
                            <img
                                src="{{ asset('assets/img/Asn-upendo.jpg') }}"
                                alt="{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}"
                            />
                            @endif
                        </a>
                    </div>
                </div>
                <div class="d-none d-md-block col-auto">
                    <div class="info-card-wrap">
                        <div class="info-card">
                            <div class="box-icon">
                                <i class="fal fa-map-marker-alt"></i>
                                <div
                                    class="bg-shape1"
                                    data-mask-src="{{ asset('assets/img/shape/info_card_icon_bg_shape_1_1.png')}}"
                                ></div>
                                <div
                                    class="bg-shape2"
                                    data-mask-src="{{asset('assets/img/shape/info_card_icon_bg_shape_1_1.png')}}"
                                ></div>
                            </div>
                            <div class="box-content">
                                <p class="box-text">Locate Address:</p>
                                <h4 class="box-title">
                                    @if(\App\Models\Setting::get('google_map_link'))
                                    <a
                                        href="{{ \App\Models\Setting::get('google_map_link') }}"
                                        target="_blank"
                                    >
                                        {{ \App\Models\Setting::get('contact_address', 'Naivasha, Kenya') }}
                                    </a>
                                    @else
                                    <a href="https://www.google.com/maps">
                                        {{ \App\Models\Setting::get('contact_address', 'Naivasha, Kenya') }}
                                    </a>
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="box-icon">
                                <i class="fal fa-phone"></i>
                                <div
                                    class="bg-shape1"
                                        data-mask-src="{{asset('assets/img/shape/info_card_icon_bg_shape_1_1.png')}}"
                                ></div>
                                <div
                                    class="bg-shape2"
                                    data-mask-src="{{asset('assets/img/shape/info_card_icon_bg_shape_1_1.png')}}"
                                ></div>
                            </div>
                            <div class="box-content">
                                <p class="box-text">Call us any time:</p>
                                <h4 class="box-title">
                                    <a
                                        href="tel:{{ \App\Models\Setting::get('contact_phone', '+254745607456') }}"
                                    >
                                        {{ \App\Models\Setting::get('contact_phone', '+254745607456') }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="box-icon">
                                <i class="fal fa-envelope-open"></i>
                                <div
                                    class="bg-shape1"
                                    data-mask-src="{{
                                        asset(
                                            'assets/img/shape/info_card_icon_bg_shape_1_1.png'
                                        )
                                    }}"
                                ></div>
                                <div
                                    class="bg-shape2"
                                    data-mask-src="{{
                                        asset(
                                            'assets/img/shape/info_card_icon_bg_shape_1_1.png'
                                        )
                                    }}"
                                ></div>
                            </div>
                            <div class="box-content">
                                <p class="box-text">Email us any time:</p>
                                <h4 class="box-title">
                                    <a
                                        href="mailto:{{ \App\Models\Setting::get('contact_email', 'admin@asnupendovillage.com') }}"
                                    >
                                        {{ \App\Models\Setting::get('contact_email', 'admin@asnupendovillage.com') }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-social-col col-auto">
                    <div class="th-social">
                        @if(\App\Models\Setting::get('social_facebook') &&
                        !empty(\App\Models\Setting::get('social_facebook')))
                        <a
                            href="{{ \App\Models\Setting::get('social_facebook') }}"
                            target="_blank"
                        >
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif @if(\App\Models\Setting::get('social_twitter') &&
                        !empty(\App\Models\Setting::get('social_twitter')))
                        <a
                            href="{{ \App\Models\Setting::get('social_twitter') }}"
                            target="_blank"
                        >
                            <i class="fab fa-twitter"></i>
                        </a>
                        @endif @if(\App\Models\Setting::get('social_youtube') &&
                        !empty(\App\Models\Setting::get('social_youtube')))
                        <a
                            href="{{ \App\Models\Setting::get('social_youtube') }}"
                            target="_blank"
                        >
                            <i class="fab fa-youtube"></i>
                        </a>
                        @endif @if(\App\Models\Setting::get('social_linkedin')
                        && !empty(\App\Models\Setting::get('social_linkedin')))
                        <a
                            href="{{ \App\Models\Setting::get('social_linkedin') }}"
                            target="_blank"
                        >
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif @if(\App\Models\Setting::get('social_instagram')
                        && !empty(\App\Models\Setting::get('social_instagram')))
                        <a
                            href="{{ \App\Models\Setting::get('social_instagram') }}"
                            target="_blank"
                        >
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <!-- Main Menu Area -->
        <div class="container">
            <div class="menu-area">
                <div class="menu-area-wrap">
                    <div class="d-inline-block d-lg-none col-auto">
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                @if(\App\Models\Setting::get('header_logo'))
                                <img
                                    src="{{ asset('storage/' . \App\Models\Setting::get('header_logo')) }}"
                                    alt="{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}"
                                />
                                @else
                                <img
                                    src="{{
                                        asset('assets/img/logo-white.svg')
                                    }}"
                                    alt="{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}"
                                />
                                @endif
                            </a>
                        </div>
                    </div>
                    <nav class="main-menu d-none d-lg-block">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('about-us') }}">About Us</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('founder') }}"
                                            >Founder</a
                                        >
                                    </li>
                                    <li>
                                        <a href="{{ route('team') }}"
                                            >Our Team</a
                                        >
                                    </li>
                                    <li>
                                        <a href="{{ route('testimonials') }}"
                                            >Testimonials</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Our Programs</a>
                                <ul class="sub-menu">
                                    @forelse($programs as $program)
                                    <li>
                                        <a
                                            href="{{ route('programs.detail', $program->slug) }}"
                                            >{{ $program->title }}</a
                                        >
                                    </li>
                                    @empty
                                    <li>
                                        <a href="{{ route('programs') }}"
                                            >All Programs</a
                                        >
                                    </li>
                                    @endforelse
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('facilities') }}"
                                    >Facilities</a
                                >
                                <ul class="sub-menu">
                                    @forelse($facilities as $facility)
                                    <li>
                                        <a
                                            href="{{ route('facilities.detail', $facility->slug) }}"
                                            >{{ $facility->name }}</a
                                        >
                                    </li>
                                    @empty
                                    <li>
                                        <a href="{{ route('facilities') }}"
                                            >All Facilities</a
                                        >
                                    </li>
                                    @endforelse
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('projects') }}">Projects</a>
                                <ul class="sub-menu">
                                    @forelse($projects as $project)
                                    <li>
                                        <a
                                            href="{{ route('projects.detail', $project->slug) }}"
                                            >{{ $project->name }}</a
                                        >
                                    </li>
                                    @empty
                                    <li>
                                        <a href="{{ route('projects') }}"
                                            >All Projects</a
                                        >
                                    </li>
                                    @endforelse
                                </ul>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="{{ route('media-centre') }}"
                                    >Media Centre</a
                                >
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ route('news') }}">News</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('events') }}"
                                            >Events</a
                                        >
                                    </li>
                                    <li>
                                        <a href="{{ route('gallery') }}"
                                            >Gallery</a
                                        >
                                    </li>
                                    <li>
                                        <a href="{{ route('careers') }}"
                                            >Careers</a
                                        >
                                    </li>
                                    <li>
                                        <a href="{{ route('downloads') }}"
                                            >Downloads</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('contact-us') }}"
                                    >Contact Us</a
                                >
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-button">
                    <button
                        type="button"
                        class="icon-btn style2 searchBoxToggler d-lg-block d-none"
                    >
                        <i class="far fa-search"></i>
                    </button>

                    <a
                        href="{{ route('donate-now') }}"
                        class="th-btn style3 d-lg-block d-none"
                        ><i class="fas fa-heart me-2"></i> Donate Now</a
                    >
                    <button
                        type="button"
                        class="icon-btn th-menu-toggle d-lg-none"
                    >
                        <i class="far fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Center Font Awesome icons in box-icon containers */
    .box-icon {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        /* important for the icon size */
        width: 35px !important;
        height: 35px !important;
        min-width: 35px !important;
        min-height: 35px !important;
    }

    .box-icon i {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 16px;
    }

    .box-icon .bg-shape1,
    .box-icon .bg-shape2 {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    /* Center social media icons in header */
    .th-social {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .th-social a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--theme-color, #1a685b);
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid var(--theme-color, #1a685b);
    }

    .th-social a:hover {
        background: #fff;
        color: var(--theme-color, #1a685b);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(26, 104, 91, 0.3);
    }

    .th-social i {
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Center social media icons in footer */
    .th-social.style2 {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .th-social.style2 a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .th-social.style2 a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .th-social.style2 i {
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
