<div>
    @section('content')

    <!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">FAQ'S</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>FAQ'S</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
        Faq Area
==============================-->
    <div class="space-top space-extra2-bottom">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-start">
                <div class="col-xl-4">
                    <div class="title-area mb-35">
                        <span class="sub-title after-none before-none"
                            ><i class="far fa-heart text-theme"></i> Frequently
                            Asked Questions</span
                        >
                        <h2 class="sec-title">Have Any Question For Us?</h2>
                        <p>
                            Partner with us to make a greater impact. Our
                            corporate sponsorship program offers businesses the
                            opportunity to support our mission while gaining
                            visibility and fulfilling corporate social
                            responsibility goals.
                        </p>
                    </div>
                    <div
                        class="widget"
                        data-bg-src="assets/img/bg/gray-bg2.png"
                        data-overlay="gray"
                        data-opacity="5"
                    >
                        <h3 class="widget_title">Have any Question</h3>
                        <form
                            action="mail.php"
                            method="POST"
                            class="widget-contact-form ajax-contact"
                        >
                            <div class="row">
                                <div class="form-group col-12">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="name"
                                        placeholder="Your Name"
                                    />
                                </div>
                                <div class="form-group col-12">
                                    <textarea
                                        name="message"
                                        id="message"
                                        cols="30"
                                        rows="3"
                                        class="form-control"
                                        placeholder="Write Message..."
                                    ></textarea>
                                </div>
                                <div class="form-btn col-12">
                                    <button class="th-btn w-100">
                                        Ask Question Now
                                    </button>
                                </div>
                            </div>
                            <p class="form-messages mb-0 mt-3"></p>
                        </form>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="accordion mb-40" id="faqAccordion">
                        <div class="accordion-card style3 active">
                            <div class="accordion-header" id="collapse-item-1">
                                <button
                                    class="accordion-button"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-1"
                                    aria-expanded="true"
                                    aria-controls="collapse-1"
                                >
                                    What motivates you to donate to our charity?
                                </button>
                            </div>
                            <div
                                id="collapse-1"
                                class="accordion-collapse collapse show"
                                aria-labelledby="collapse-item-1"
                                data-bs-parent="#faqAccordion"
                            >
                                <div class="accordion-body">
                                    <p class="faq-text">
                                        Explore the variety of volunteer
                                        opportunities available. From event
                                        planning and fundraising to fieldwork
                                        and administrative support, there are
                                        many ways to lend your talents. Find the
                                        perfect fit for your skills and
                                        interests.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-card style3">
                            <div class="accordion-header" id="collapse-item-2">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-2"
                                    aria-expanded="false"
                                    aria-controls="collapse-2"
                                >
                                    How did you hear about our organization?
                                </button>
                            </div>
                            <div
                                id="collapse-2"
                                class="accordion-collapse collapse"
                                aria-labelledby="collapse-item-2"
                                data-bs-parent="#faqAccordion"
                            >
                                <div class="accordion-body">
                                    <p class="faq-text">
                                        Explore the variety of volunteer
                                        opportunities available. From event
                                        planning and fundraising to fieldwork
                                        and administrative support, there are
                                        many ways to lend your talents. Find the
                                        perfect fit for your skills and
                                        interests.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-card style3">
                            <div class="accordion-header" id="collapse-item-3">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-3"
                                    aria-expanded="false"
                                    aria-controls="collapse-3"
                                >
                                    How frequently do you prefer to volunteer?
                                </button>
                            </div>
                            <div
                                id="collapse-3"
                                class="accordion-collapse collapse"
                                aria-labelledby="collapse-item-3"
                                data-bs-parent="#faqAccordion"
                            >
                                <div class="accordion-body">
                                    <p class="faq-text">
                                        Explore the variety of volunteer
                                        opportunities available. From event
                                        planning and fundraising to fieldwork
                                        and administrative support, there are
                                        many ways to lend your talents. Find the
                                        perfect fit for your skills and
                                        interests.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-card style3">
                            <div class="accordion-header" id="collapse-item-4">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-4"
                                    aria-expanded="false"
                                    aria-controls="collapse-4"
                                >
                                    How easy was it to navigate our online
                                    donation platform?
                                </button>
                            </div>
                            <div
                                id="collapse-4"
                                class="accordion-collapse collapse"
                                aria-labelledby="collapse-item-4"
                                data-bs-parent="#faqAccordion"
                            >
                                <div class="accordion-body">
                                    <p class="faq-text">
                                        Explore the variety of volunteer
                                        opportunities available. From event
                                        planning and fundraising to fieldwork
                                        and administrative support, there are
                                        many ways to lend your talents. Find the
                                        perfect fit for your skills and
                                        interests.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-card style3">
                            <div class="accordion-header" id="collapse-item-5">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-5"
                                    aria-expanded="false"
                                    aria-controls="collapse-5"
                                >
                                    How likely are you to recommend our charity
                                    to others?
                                </button>
                            </div>
                            <div
                                id="collapse-5"
                                class="accordion-collapse collapse"
                                aria-labelledby="collapse-item-5"
                                data-bs-parent="#faqAccordion"
                            >
                                <div class="accordion-body">
                                    <p class="faq-text">
                                        Explore the variety of volunteer
                                        opportunities available. From event
                                        planning and fundraising to fieldwork
                                        and administrative support, there are
                                        many ways to lend your talents. Find the
                                        perfect fit for your skills and
                                        interests.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-card style3">
                            <div class="accordion-header" id="collapse-item-6">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-6"
                                    aria-expanded="false"
                                    aria-controls="collapse-6"
                                >
                                    What skills or expertise do you bring to our
                                    volunteer team?
                                </button>
                            </div>
                            <div
                                id="collapse-6"
                                class="accordion-collapse collapse"
                                aria-labelledby="collapse-item-6"
                                data-bs-parent="#faqAccordion"
                            >
                                <div class="accordion-body">
                                    <p class="faq-text">
                                        Explore the variety of volunteer
                                        opportunities available. From event
                                        planning and fundraising to fieldwork
                                        and administrative support, there are
                                        many ways to lend your talents. Find the
                                        perfect fit for your skills and
                                        interests.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-1.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-2.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-3.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-4.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-5.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-1.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-2.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-3.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-4.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img
                                    src="assets/img/brand/brand1-5.svg"
                                    alt="Brand Logo"
                                />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
</div>
