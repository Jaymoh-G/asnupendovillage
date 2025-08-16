<div>
    <!-- Banner Section -->
    @if($pageBanner)
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner->effective_banner_url }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                    {{ $pageBanner->title ?? 'Testimonial Details' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>
                        <a href="{{ route('testimonials') }}">Testimonials</a>
                    </li>
                    <li>{{ $testimonial->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Testimonial Details Area -->
    <section class="space">
        <div class="container">
            <div class="testimonial-details-wrap mb-80">
                <div class="row gx-60 gy-40">
                    <div class="col-xl-5">
                        <div class="about-card-img">
                            @if($testimonial->image_url)
                            <img
                                src="{{ $testimonial->image_url }}"
                                alt="{{ $testimonial->name }}"
                                style="filter: none !important"
                            />
                            @else
                            <img
                                src="{{
                                    asset(
                                        'assets/img/testimonial/testi_3_1.png'
                                    )
                                }}"
                                alt="{{ $testimonial->name }}"
                            />
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="about-card">
                            <div class="about-card-title-wrap">
                                <div class="media-left">
                                    <h2 class="h3 about-card_title mt-n2">
                                        {{ $testimonial->name }}
                                    </h2>
                                    <p class="about-card_desig">
                                        {{ $testimonial->program->title ?? 'General Testimonial' }}
                                    </p>
                                    <div class="testimonial-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="rating-text">5.0</span>
                                    </div>
                                </div>
                                <div class="quote-icon-large">
                                    <i class="fal fa-quote-right"></i>
                                </div>
                            </div>

                            <div class="testimonial-content">
                                <div class="testimonial-text">
                                    {!! $testimonial->content !!}
                                </div>
                            </div>
                            <div class="testimonial-details-info">
                                @if($testimonial->pdf_file)
                                <div class="about-contact">
                                    <div class="icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="media-left">
                                        <h6 class="about-contact-title">PDF</h6>
                                        <a
                                            href="{{ $testimonial->pdf_url }}"
                                            target="_blank"
                                            class="about-contact-text"
                                        >
                                            View or Download PDF
                                        </a>
                                    </div>
                                </div>
                                @endif @if($testimonial->program)
                                <div class="about-contact">
                                    <div class="icon">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="media-left">
                                        <h6 class="about-contact-title">
                                            Program
                                        </h6>
                                        <p class="about-contact-text">
                                            {{ $testimonial->program->title }}
                                        </p>
                                    </div>
                                </div>
                                @endif
                                <div class="about-contact">
                                    <div class="icon">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div class="media-left">
                                        <h6 class="about-contact-title">
                                            Date
                                        </h6>
                                        <p class="about-contact-text">
                                            {{ $testimonial->created_at->format('F j, Y') }}
                                        </p>
                                    </div>
                                </div>

                                @if($testimonial->tags &&
                                is_array($testimonial->tags) &&
                                count($testimonial->tags) > 0)
                                <div class="about-contact">
                                    <div class="icon">
                                        <i class="fas fa-tags"></i>
                                    </div>
                                    <div class="media-left">
                                        <h6 class="about-contact-title">
                                            Tags
                                        </h6>
                                        <div class="about-contact-text">
                                            @foreach($testimonial->tags as $tag)
                                            <span class="detail-tag">{{
                                                $tag
                                            }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($otherTestimonials->isNotEmpty())
    <section class="space-bottom">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"
                    ><i class="far fa-heart text-theme"></i> Other
                    Testimonials</span
                >
                <h2 class="sec-title">What Others Are Saying</h2>
            </div>
            <div class="row gy-30">
                @foreach($otherTestimonials as $otherTestimonial)
                <div class="col-lg-6">
                    <div class="testi-card3">
                        <div
                            class="testi-card-shape"
                            data-mask-src="{{
                                asset(
                                    'assets/img/shape/testi-card-bg-shape3-1.png'
                                )
                            }}"
                        ></div>
                        <div class="testi-card_review">
                            <i class="fas fa-star"></i>
                            {{ $otherTestimonial->rating ?? '5.0' }}
                        </div>
                        <div class="testi-card_profile">
                            <div class="box-thumb">
                                @if($otherTestimonial->image_url)
                                <img
                                    src="{{ $otherTestimonial->image_url }}"
                                    alt="{{ $otherTestimonial->name }}"
                                    style="filter: none !important"
                                />
                                @else
                                <img
                                    src="{{
                                        asset(
                                            'assets/img/testimonial/testi_3_1.png'
                                        )
                                    }}"
                                    alt="{{ $otherTestimonial->name }}"
                                />
                                @endif
                                <div class="quote-icon">
                                    <i class="fal fa-quote-right"></i>
                                </div>
                            </div>
                            <div class="media-left">
                                <h3 class="testi-card_name">
                                    <a
                                        href="{{ route('testimonials.detail', $otherTestimonial->slug) }}"
                                        >{{ $otherTestimonial->name }}</a
                                    >
                                </h3>
                                <span
                                    class="testi-card_desig"
                                    >{{ $otherTestimonial->program->title ?? 'General Testimonial' }}</span
                                >
                            </div>
                        </div>
                        <div class="testi-card_text">
                            @if($otherTestimonial->excerpt) {!!
                            $otherTestimonial->excerpt !!} @else {!!
                            Str::limit(strip_tags($otherTestimonial->content),
                            150) !!} @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <style>
        /* Override grayscale filter for testimonial images to keep them colored */
        .about-card-img img,
        .testi-card3 .box-thumb img {
            filter: none !important;
        }
        .testi-card3:hover .box-thumb img {
            filter: none !important;
        }
        .about-card-title-wrap {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        .testimonial-rating {
            margin-top: 10px;
        }
        .testimonial-rating i {
            color: #ffac00;
            margin-right: 2px;
        }
        .rating-text {
            margin-left: 10px;
            font-weight: bold;
            color: #ffac00;
        }
        .quote-icon-large {
            width: 60px;
            height: 60px;
            background: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }
        .testimonial-content {
            margin-bottom: 30px;
        }
        .testimonial-text {
            font-size: 18px;
            line-height: 1.8;
            color: #555;
            margin: 0;
        }
        .testimonial-text p {
            margin-bottom: 15px;
        }
        .testimonial-text p:last-child {
            margin-bottom: 0;
        }
        .about-contact {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .about-contact .icon {
            width: 50px;
            height: 50px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #007bff;
        }
        .about-contact-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        .about-contact-text {
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        .testi-card3 {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .testi-card3:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .testi-card_review {
            color: #ffac00;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .testi-card_review i {
            margin-right: 5px;
        }
        .quote-icon {
            position: absolute;
            bottom: -10px;
            right: -10px;
            width: 30px;
            height: 30px;
            background: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
        }
        .box-thumb {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }
        .box-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .testi-card_profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .testi-card_name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }
        .testi-card_name a {
            color: #333;
            text-decoration: none;
        }
        .testi-card_name a:hover {
            color: #007bff;
        }
        .testi-card_desig {
            color: #666;
            font-size: 14px;
        }
        .testi-card_text {
            line-height: 1.6;
            color: #555;
            margin: 0;
        }
        .testi-card_text p {
            margin-bottom: 10px;
        }
        .testi-card_text p:last-child {
            margin-bottom: 0;
        }

        /* Detail Tags Styling */
        .detail-tag {
            display: inline-block;
            background: var(--theme-color, #007bff);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
            margin-right: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        .detail-tag:hover {
            background: var(--theme-color2, #0056b3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }
    </style>
</div>
