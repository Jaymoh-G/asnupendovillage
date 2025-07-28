<div class="popup-search-box d-none d-lg-block">
    <button class="searchClose"><i class="far fa-times"></i></button>
    <form action="#">
        <input type="text" placeholder="What are you looking for?">
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
</div><!--==============================
    Mobile Menu
  ============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="index.html"><img src="{{ asset('assets/img/logo.svg') }}" alt="Donat"></a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>

                </li>
                <li><a href="about.html">About Us</a></li>
                <li class="menu-item-has-children">
                    <a href="#">Donations</a>
                    <ul class="sub-menu">
                        <li><a href="donation.html">Donations</a></li>
                        <li><a href="donation-details.html">Donation Details</a></li>
                        <li><a href="donate-now.html">Donate Now</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Pages</a>
                    <ul class="sub-menu">

                        <li><a href="team.html">Volunteers</a></li>
                        <li><a href="team-details.html">Volunteer Details</a></li>

                        <li><a href="pricing.html">Pricing</a></li>
                        <li><a href="faq.html">FAQS</a></li>
                        <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                        <li><a href="error.html">Error Page</a></li>
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
                    <a href="{{ route('contact-us') }}">Contact Us1</a>
                </li>
                <li>
                    <a href="{{ route('contact-us') }}">Contact Us</a>
                </li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="color-scheme-wrap active">
    <button class="switchIcon"><i class="fa-solid fa-palette"></i></button>
    <h3 class="color-scheme-wrap-title text-center">Color Switcher</h3>
    <h4 class="color-scheme-wrap-subtitle text-center">Theme Color</h4>
    <div class="color-switch-btns">
        <button data-color="#1A685B"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#f34e3a"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#FF4857"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#3843C1"><i class="fa-solid fa-droplet"></i></button>
        <button data-color="#FF7E02"><i class="fa-solid fa-droplet"></i></button>
    </div>
    <h4 class="color-scheme-wrap-subtitle mt-20 text-center">Secondary Color</h4>
    <div class="secondary-color-switch-btns">
        <button data-secondary-color="#FFAC00"><i class="fa-solid fa-droplet"></i></button>
        <button data-secondary-color="#F41E1E"><i class="fa-solid fa-droplet"></i></button>
        <button data-secondary-color="#f34e3a"><i class="fa-solid fa-droplet"></i></button>
        <button data-secondary-color="#FF4857"><i class="fa-solid fa-droplet"></i></button>
        <button data-secondary-color="#3843C1"><i class="fa-solid fa-droplet"></i></button>
    </div>
</div><!--==============================
 Header Area
==============================-->
<header class="th-header header-default">
    <div class="menu-top">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                <div class="d-none d-lg-block col-auto">
                    <div class="header-logo">
                        <a href="index.html"><img src="{{ asset('assets/img/Asn-upendo.jpg') }}" alt="Donat"></a>
                    </div>
                </div>
                <div class="d-none d-md-block col-auto">
                    <div class="info-card-wrap">
                        <div class="info-card">
                            <div class="box-icon">
                                <i class="fal fa-map-marker-alt"></i>
                                <div class="bg-shape1" data-mask-src="assets/img/shape/info_card_icon_bg_shape_1_1.png">
                                </div>
                                <div class="bg-shape2" data-mask-src="assets/img/shape/info_card_icon_bg_shape_1_1.png">
                                </div>
                            </div>
                            <div class="box-content">
                                <p class="box-text">Locate Address:</p>
                                <h4 class="box-title"><a href="https://www.google.com/maps">Naivasha, Kenya</a>
                                </h4>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="box-icon">
                                <i class="fal fa-phone"></i>
                                <div class="bg-shape1" data-mask-src="assets/img/shape/info_card_icon_bg_shape_1_1.png">
                                </div>
                                <div class="bg-shape2" data-mask-src="assets/img/shape/info_card_icon_bg_shape_1_1.png">
                                </div>
                            </div>
                            <div class="box-content">
                                <p class="box-text">Call us any time:</p>
                                <h4 class="box-title"><a href="tel:+254745607456">0745607456</a></h4>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="box-icon">
                                <i class="fal fa-envelope-open"></i>
                                <div class="bg-shape1"
                                    data-mask-src="assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
                                <div class="bg-shape2"
                                    data-mask-src="assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
                            </div>
                            <div class="box-content">
                                <p class="box-text">Email us any time:</p>
                                <h4 class="box-title"><a
                                        href="mailto:admin@asnupendovillage.com">admin@asnupendovillage.com</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-social-col col-auto">
                    <div class="th-social">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
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
                            <a href="index.html"><img src="{{ asset('assets/img/logo-white.svg') }}"
                                    alt="Donat"></a>
                        </div>
                    </div>
                    <nav class="main-menu d-none d-lg-block">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">About Us</a>
                                <ul class="sub-menu">

                                    <li><a href="{{ route('team') }}">Our Team</a></li>
                                    <li><a href="{{ route('team') }}">Testimonials</a></li>
                                    <li><a href="{{ route('faqs') }}">FAQS</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Our Programs</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('donate-now') }}">Medical Care</a></li>
                                    <li><a href="{{ route('donate-now') }}">Nutrition</a></li>
                                    <li><a href="{{ route('donate-now') }}">Education & Sponsorship (CUSP)</a></li>
                                    <li><a href="{{ route('donate-now') }}">Psychosocial Support</a></li>
                                    <li><a href="{{ route('donate-now') }}">PMTCT & HBC</a></li>
                                    <li><a href="{{ route('donate-now') }}">Upendo Farm & Income Generation (CIGAs)</a></li>
                                </ul>
                            </li>
                             <li class="menu-item-has-children">
                                <a href="#">Facilities</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('donate-now') }}">Dispensary/Clinic</a></li>
                                    <li><a href="{{ route('donate-now') }}">Laboratory & Pharmacy</a></li>
                                    <li><a href="{{ route('donate-now') }}">Administration Block</a></li>
                                    <li><a href="{{ route('donate-now') }}">Fountain Valley Water Bottling Plant</a></li>
                                    <li><a href="{{ route('donate-now') }}">Upendo Farm Structures</a></li>
                                    <li><a href="{{ route('donate-now') }}">Community Halls/Meeting Spaces</a></li>
                                </ul>
                            </li>
                             <li class="menu-item-has-children">
                                <a href="#">Projects</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('donate-now') }}">Project 1</a></li>
                                    <li><a href="{{ route('donate-now') }}">Project 2</a></li>
                                    <li><a href="{{ route('donate-now') }}">Project 3</a></li>
                                    <li><a href="{{ route('donate-now') }}">Project 4</a></li>
                                    <li><a href="{{ route('donate-now') }}">Project 5</a></li>
                                    <li><a href="{{ route('donate-now') }}">Project 6</a></li>
                                </ul>
                            </li>



                            <li class="menu-item-has-children">
                                <a href="{{ route('media-centre') }}">Media Centre</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('media-centre') }}">News</a></li>
                                    <li><a href="{{ route('media-centre') }}">Events</a></li>
                                    <li><a href="{{ route('media-centre') }}">Photo Gallery</a></li>
                                    <li><a href="{{ route('media-centre') }}">Video Gallery</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('contact-us') }}">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                 
                </div>
                <div class="header-button">
                    <button type="button" class="icon-btn style2 searchBoxToggler d-lg-block d-none"><i
                            class="far fa-search"></i></button>

                    <a href="contact.html" class="th-btn style3 d-lg-block d-none"><i class="fas fa-heart me-2"></i>
                        Donate Now</a>
                    <button type="button" class="icon-btn th-menu-toggle d-lg-none"><i
                            class="far fa-bars"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>
