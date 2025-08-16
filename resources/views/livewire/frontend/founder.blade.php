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
                    {{ $pageBanner && $pageBanner->title ? $pageBanner->title : 'Our Founder' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                    <li>Our Founder</li>
                </ul>
            </div>
        </div>
    </div>

    <!--==============================
    Founder Area
    ==============================-->
    @if($pageContent && ($pageContent->section1_title ||
    $pageContent->section1_content))
    <section class="space">
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
                                src="{{ isset($pageContent->section1_image_urls[0]) ? $pageContent->section1_image_urls[0] : asset('assets/img/normal/about_1_1.png') }}"
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
                                >Founder & CEO</span
                            >
                            <h2 class="sec-title">
                                {{ $pageContent->section1_title }}
                            </h2>

                            {!! $pageContent->section1_content !!}
                        </div>

                        <div class="btn-wrap mt-40">
                            <a href="{{ route('contact-us') }}" class="th-btn"
                                >Get In Touch<i
                                    class="fas fa-arrow-up-right ms-2"
                                ></i
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--==============================
    Founder's Story Area
    ==============================-->
    @if($pageContent && ($pageContent->section2_title ||
    $pageContent->section2_content))
    <section
        class="space"
        data-bg-src="{{ asset('assets/img/bg/gray-bg2.png') }}"
    >
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="title-area mb-30">
                        <span
                            class="sub-title"
                            >{{ $pageContent->section2_title }}</span
                        >
                        @if($pageContent->section2_content)
                        <h2 class="sec-title">
                            {{ $pageContent->section2_title }}
                        </h2>
                        {!! $pageContent->section2_content !!} @endif
                    </div>
                </div>
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
                                    isset($pageContent->section2_image_urls[0]) ? $pageContent->section2_image_urls[0] : asset('assets/img/normal/about_1_1.png')
                                }}"
                                alt="John's Journey"
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
            </div>
        </div>
    </section>
    @endif @if($pageContent && ($pageContent->section3_title ||
    $pageContent->section3_content))
    <section class="space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="sec-title">
                        {{ $pageContent->section3_title }}
                    </h2>
                    {!! $pageContent->section3_content !!}
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
    </style>
</div>
