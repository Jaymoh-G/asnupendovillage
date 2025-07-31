<div>
    @section('content')
    <!--==============================
    Breadcumb
============================== -->
    <div
        class="breadcumb-wrapper"
        data-bg-src="assets/img/bg/breadcumb-bg.jpg"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Contact us</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Contact us</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
Contact Area
==============================-->
    <div
        class="space overflow-hidden contact-area-1 position-relative z-index-common"
        id="contact-sec"
    >
        <div class="container">
            <div class="contact-wrap1">
                <div class="row gx-60 gy-40">
                    <div class="col-xl-4 col-lg-5">
                        <div class="contact-feature">
                            <div class="box-icon">
                                <i class="fas fa-map-location-dot"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="box-title">Address</h3>
                                <p class="box-text">
                                    {{ \App\Models\Setting::get('contact_address', '15 Maniel Lane, Front Line Berlin, Germany') }}
                                </p>
                            </div>
                        </div>
                        <div class="contact-feature">
                            <div class="box-icon" data-theme-color="#FFAC00">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="box-title">Phone</h3>
                                <p class="box-text">
                                    <a
                                        href="tel:{{ \App\Models\Setting::get('contact_phone', '+254745607456') }}"
                                    >
                                        {{ \App\Models\Setting::get('contact_phone', '+254745607456') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="contact-feature">
                            <div class="box-icon" data-theme-color="#122F2A">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="box-title">Email</h3>
                                <p class="box-text">
                                    <a
                                        href="mailto:{{ \App\Models\Setting::get('contact_email', 'info@asnupendovillage.org') }}"
                                    >
                                        {{ \App\Models\Setting::get('contact_email', 'info@asnupendovillage.org') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="contact-feature" data-theme-color="#FF5528">
                            <div class="box-icon">
                                <i class="fas fa-comment-question"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="box-title">Have Questions?</h3>
                                <p class="box-text">
                                    Discover more by visiting us or joining our
                                    community
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="contact-map">
                            @if(\App\Models\Setting::get('google_map_link'))
                            <iframe
                                src="{{ \App\Models\Setting::get('google_map_link') }}"
                                allowfullscreen=""
                                loading="lazy"
                            ></iframe>
                            @else
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7310056272386!2d89.2286059153658!3d24.00527418490799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe9b97badc6151%3A0x30b048c9fb2129bc!2sAngfuztheme!5e0!3m2!1sen!2sbd!4v1651028958211!5m2!1sen!2sbd"
                                allowfullscreen=""
                                loading="lazy"
                            ></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-page-form-wrap space-top">
                <div class="row gy-40">
                    <div class="col-xl-6 align-self-end">
                        <div class="contact-thumb1-1">
                            <img
                                src="assets/img/normal/contact_1_1.png"
                                alt="img"
                            />
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <!--==============================
Contact Area
==============================-->
                        <div class="contact-form-v1 contact-page-form">
                            <form
                                action="mail.php"
                                method="POST"
                                class="contact-form style-border ajax-contact"
                            >
                                <div class="row">
                                    <div class="form-group style-border col-12">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            id="name"
                                            placeholder="Your Name"
                                        />
                                    </div>
                                    <div class="form-group style-border col-12">
                                        <input
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            id="email"
                                            placeholder="Email Address"
                                        />
                                    </div>
                                    <div class="form-group style-border col-12">
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="number"
                                            id="number"
                                            placeholder="Phone Number"
                                        />
                                    </div>
                                    <div class="form-group style-border col-12">
                                        <textarea
                                            name="message"
                                            id="message"
                                            cols="30"
                                            rows="3"
                                            class="form-control"
                                            placeholder="Type Your Message"
                                        ></textarea>
                                    </div>
                                    <div class="form-btn col-12">
                                        <button class="th-btn">
                                            Send a Message
                                        </button>
                                    </div>
                                </div>
                                <p class="form-messages mb-0 mt-3"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>
