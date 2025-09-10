<!--==============================
Footer Area ==============================-->
<footer
    class="footer-wrapper footer-default"
    data-bg-src="{{ asset('assets/img/bg/footer-default-bg-mask.png') }}"
>
    <div class="footer-top">
        <div class="container">
            <div class="subscribe-box">
                <div
                    class="row gy-40 align-items-center justify-content-center"
                >
                    <div class="col-xl-6">
                        <h4 class="subscribe-box_title">
                            Subscribe to Our Newsletter
                        </h4>
                        <p class="subscribe-box_text">
                            Get regular updates and news from us
                        </p>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <form
                            class="newsletter-form"
                            action="{{ route('newsletter.subscribe') }}"
                            method="POST"
                        >
                            @csrf
                            <div class="form-group">
                                <input
                                    class="form-control"
                                    type="email"
                                    placeholder="Enter Email Address"
                                    name="email"
                                    required=""
                                />
                            </div>
                            <button type="submit" class="th-btn style3">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo">
                                <a href="{{ route('home') }}">
                                    @if(\App\Models\Setting::get('footer_logo')
                                    &&
                                    !empty(\App\Models\Setting::get('footer_logo')))
                                    <img
                                        src="{{ asset('storage/' . \App\Models\Setting::get('footer_logo')) }}"
                                        alt="{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset('assets/img/Asn-upendo.jpg')
                                        }}"
                                        alt="{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}"
                                    />
                                    @endif
                                </a>
                            </div>
                            <p class="about-text">
                                {{ \App\Models\Setting::get('footer_about', 'Our secure online donation platform allows you to make contributions quickly and safely. Choose from various payment methods.') }}
                            </p>
                            <a href="{{ route('donate-now') }}" class="th-btn"
                                ><i class="fas fa-heart me-2"></i> Donate Now</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Quick Links</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                @php $quickLinks =
                                \App\Models\Setting::get('footer_quick_links',
                                []); if (is_string($quickLinks)) { $quickLinks =
                                json_decode($quickLinks, true) ?: []; } @endphp
                                @if(!empty($quickLinks) &&
                                is_array($quickLinks)) @foreach($quickLinks as $link)
                                <li>
                                    <a href="{{ $link['url'] ?? '#' }}">{{
                                        $link["title"] ?? "Link"
                                    }}</a>
                                </li>
                                @endforeach @else

                                <li>
                                    <a href="{{ route('contact-us') }}"
                                        >Contact Us</a
                                    >
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Our Service</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li>
                                    <a href="{{ route('programs') }}"
                                        >Our Programs</a
                                    >
                                </li>
                                <li>
                                    <a href="{{ route('facilities') }}"
                                        >Facilities</a
                                    >
                                </li>
                                <li>
                                    <a href="{{ route('projects') }}"
                                        >Projects</a
                                    >
                                </li>
                                <li>
                                    <a href="{{ route('media-centre') }}"
                                        >Media Centre</a
                                    >
                                </li>
                                <li>
                                    <a href="{{ route('contact-us') }}"
                                        >Contact Us</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="th-widget-contact">
                            <h3 class="widget_title">Contact Us</h3>
                            <div class="info-card">
                                <div class="box-icon">
                                    <i class="fal fa-phone"></i>
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
                                    <p class="box-text">Call us any time:</p>
                                    <h4 class="box-title">
                                        <a
                                            href="tel:{{ \App\Models\Setting::get('contact_phone', '+254 700 000 000') }}"
                                            >{{ \App\Models\Setting::get('contact_phone', '+254 700 000 000') }}</a
                                        >
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
                                            href="mailto:{{ \App\Models\Setting::get('contact_email', 'info@asnupendovillage.org') }}"
                                            >{{ \App\Models\Setting::get('contact_email', 'info@asnupendovillage.org') }}</a
                                        >
                                    </h4>
                                </div>
                            </div>
                            <div class="th-social style2">
                                @if(\App\Models\Setting::get('social_facebook')
                                &&
                                !empty(\App\Models\Setting::get('social_facebook')))
                                <a
                                    href="{{ \App\Models\Setting::get('social_facebook') }}"
                                    target="_blank"
                                >
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif
                                @if(\App\Models\Setting::get('social_youtube')
                                &&
                                !empty(\App\Models\Setting::get('social_youtube')))
                                <a
                                    href="{{ \App\Models\Setting::get('social_youtube') }}"
                                    target="_blank"
                                >
                                    <i class="fab fa-youtube"></i>
                                </a>
                                @endif
                                @if(\App\Models\Setting::get('social_linkedin')
                                &&
                                !empty(\App\Models\Setting::get('social_linkedin')))
                                <a
                                    href="{{ \App\Models\Setting::get('social_linkedin') }}"
                                    target="_blank"
                                >
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                @endif
                                @if(\App\Models\Setting::get('social_instagram')
                                &&
                                !empty(\App\Models\Setting::get('social_instagram')))
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
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row justify-content-center gy-3 align-items-center">
                <div class="col-lg-12">
                    <p class="copyright-text text-center">
                        <i class="fal fa-copyright"></i> Copyright
                        {{ date("Y") }}
                        <a
                            href="{{ route('home') }}"
                            >{{ \App\Models\Setting::get('site_name', 'ASN Upendo Village') }}</a
                        >. All Rights Reserved. | Designed by
                        <a target="_blank" href="https://breezetech.co.ke/"
                            >Breezetech
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--********************************
			Code End  Here
	******************************** -->

<!-- Scroll To Top -->
<div class="scroll-top">
    <svg
        class="progress-circle svg-content"
        width="100%"
        height="100%"
        viewBox="-1 -1 102 102"
    >
        <path
            d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
            style="
                transition: stroke-dashoffset 10ms linear 0s;
                stroke-dasharray: 307.919, 307.919;
                stroke-dashoffset: 307.919;
            "
        ></path>
    </svg>
</div>

<!--==============================
    All Js File
============================== -->
