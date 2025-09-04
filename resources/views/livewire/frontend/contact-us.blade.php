<div>
    @section('content')
    <style>
        .contact-feature .box-text {
            max-width: 250px;
        }
    </style>
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
                    {{ $pageBanner->title ? $pageBanner->title : 'Contact us' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Contact us</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
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
    @endif
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
                            @php $mapEmbed =
                            \App\Models\Setting::get('google_map_embed');
                            $mapLink =
                            \App\Models\Setting::get('google_map_link'); @endphp
                            @if(!empty($mapEmbed)) {!! $mapEmbed !!}
                            @elseif(!empty($mapLink))
                            <iframe
                                src="{{ $mapLink }}"
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
                            @if($pageContent && $pageContent->featured_image)
                            <img
                                src="{{ $pageContent->featured_image_url }}"
                                alt="{{ $pageContent->title ?: 'Contact Us' }}"
                            />
                            @else
                            <img
                                src="assets/img/normal/contact_1_1.png"
                                alt="Contact Us"
                            />
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <!--==============================
Contact Area
==============================-->
                        <div class="contact-form-v1 contact-page-form">
                            <div class="contact-form">
                                <div class="contact-form-header">
                                    <h2>
                                        {{ $pageContent && $pageContent->title ? $pageContent->title : 'Get In Touch' }}
                                    </h2>
                                    <p>
                                        We'd love to hear from you. Send us a
                                        message and we'll respond as soon as
                                        possible.
                                    </p>
                                </div>
                                <form
                                    method="post"
                                    action="{{ route('contact.submit') }}"
                                    id="contact-form"
                                >
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="name"
                                                    placeholder="Your Name"
                                                    required
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    name="email"
                                                    placeholder="Your Email"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="subject"
                                            placeholder="Your Subject"
                                            required
                                        />
                                    </div>
                                    <div class="form-group">
                                        <input
                                            type="tel"
                                            class="form-control"
                                            name="phone"
                                            placeholder="Your Phone Number"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <textarea
                                            name="message"
                                            cols="30"
                                            rows="5"
                                            class="form-control"
                                            placeholder="Write Your Message"
                                            required
                                        ></textarea>
                                    </div>
                                    <button type="submit" class="th-btn">
                                        Send Message
                                        <i class="far fa-paper-plane"></i>
                                    </button>
                                    <div class="col-md-12 mt-3">
                                        <div
                                            class="form-messege text-success"
                                        ></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document
            .getElementById("contact-form")
            .addEventListener("submit", function (e) {
                e.preventDefault();

                const form = this;
                const submitBtn = form.querySelector('button[type="submit"]');
                const messageDiv = form.querySelector(".form-messege");

                // Disable submit button and show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    'Sending... <i class="far fa-spinner fa-spin"></i>';

                // Get form data
                const formData = new FormData(form);

                // Get CSRF token from meta tag or form input
                let csrfToken = "";
                const metaTag = document.querySelector(
                    'meta[name="csrf-token"]'
                );
                if (metaTag) {
                    csrfToken = metaTag.getAttribute("content");
                } else {
                    // Fallback: get from form input if meta tag is not found
                    const csrfInput = form.querySelector(
                        'input[name="_token"]'
                    );
                    if (csrfInput) {
                        csrfToken = csrfInput.value;
                    }
                }

                // Send AJAX request
                fetch(form.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                })
                    .then((response) => {
                        // Check if response is JSON
                        const contentType =
                            response.headers.get("content-type");
                        if (
                            contentType &&
                            contentType.includes("application/json")
                        ) {
                            return response.json();
                        } else {
                            throw new Error("Invalid response format");
                        }
                    })
                    .then((data) => {
                        if (data.success) {
                            messageDiv.innerHTML =
                                '<div class="alert alert-success">' +
                                data.message +
                                "</div>";
                            form.reset();
                        } else {
                            messageDiv.innerHTML =
                                '<div class="alert alert-danger">' +
                                data.message +
                                "</div>";
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                        messageDiv.innerHTML =
                            '<div class="alert alert-danger">An error occurred. Please try again.</div>';
                    })
                    .finally(() => {
                        // Re-enable submit button
                        submitBtn.disabled = false;
                        submitBtn.innerHTML =
                            'Send Message <i class="far fa-paper-plane"></i>';
                    });
            });
    });
</script>
