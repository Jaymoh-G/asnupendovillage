<div>
    <!-- Banner Section -->
    @if($pageBanner && $pageBanner->effective_banner_url)
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner->effective_banner_url }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                    {{ $pageBanner->title ?? 'Testimonials' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Testimonials</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Testimonials</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Testimonials</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Testimonial Area -->
    <section class="overflow-hidden space">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"
                    ><i class="far fa-heart text-theme"></i>Testimonials</span
                >
                <h2 class="sec-title">Success Stories</h2>
            </div>

            <div class="row gy-30">
                @forelse($testimonials as $testimonial)
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
                            <div class="review-left">
                                <i class="fas fa-star"></i>
                                {{ $testimonial->rating ?? '5.0' }}
                            </div>
                            @if($testimonial->pdf_file)
                            <div class="review-right">
                                <a
                                    href="{{ $testimonial->pdf_url }}"
                                    target="_blank"
                                    class="pdf-link"
                                    title="View PDF"
                                >
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="testi-card_profile">
                            <div class="box-thumb">
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
                                <div class="quote-icon">
                                    <i class="fal fa-quote-right"></i>
                                </div>
                            </div>
                            <div class="media-left">
                                <h3 class="testi-card_name">
                                    <a
                                        href="{{ route('testimonials.detail', $testimonial->slug) }}"
                                        >{{ $testimonial->name }}</a
                                    >
                                </h3>
                                <span class="testi-card_desig">
                                    {{ $testimonial->program->title ?? 'General Testimonial' }}
                                </span>
                            </div>
                        </div>
                        <p class="testi-card_text">
                            "{{ Str::limit($testimonial->content ?? 'Stay informed about our upcoming events and campaigns. Whether it\'s a fundraising gala, a charity run, or a community outreach program, there are plenty of ways to get involved and support our cause. Check our event calendar for details.', 200)


                            }}"
                        </p>

                        @if($testimonial->tags && is_array($testimonial->tags)
                        && count($testimonial->tags) > 0)
                        <div class="testi-card_tags">
                            @foreach($testimonial->tags as $tag)
                            <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No testimonials found.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($testimonials->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="th-pagination text-center pt-50">
                        {{ $testimonials->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    <style>
        /* Override grayscale filter for testimonial images to keep them colored */
        .testi-card3 .box-thumb img {
            filter: none !important;
        }
        .testi-card3:hover .box-thumb img {
            filter: none !important;
        }
        .testi-card3 {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .testi-card3:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .testi-card_review {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .review-left {
            color: #ffac00;
            font-weight: bold;
        }
        .review-left i {
            margin-right: 5px;
        }
        .review-right {
            display: flex;
            align-items: center;
        }
        .pdf-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: var(--theme-color, #007bff);
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(var(--theme-color-rgb, 0, 123, 255), 0.3);
        }
        .pdf-link:hover {
            background: var(--theme-color2, #0056b3);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px
                rgba(var(--theme-color-rgb, 0, 123, 255), 0.4);
        }
        .pdf-link i {
            font-size: 14px;
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
            font-style: italic;
            line-height: 1.6;
            color: #555;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 6.4em; /* 4 lines * 1.6 line-height */
        }

        /* Tags Styling */
        .testi-card_tags {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .tag {
            background: var(--theme-color, #007bff);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
            transition: all 0.3s ease;
        }
        .tag:hover {
            background: var(--theme-color2, #0056b3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        /* Pagination Styling */
        .th-pagination {
            margin-top: 50px;
        }
        .th-pagination nav {
            display: flex;
            justify-content: center;
        }
        .th-pagination .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 5px;
        }
        .th-pagination .page-item {
            margin: 0;
        }
        .th-pagination .page-link {
            border: 1px solid #e9ecef;
            color: #333;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            text-decoration: none;
            background-color: #fff;
            display: block;
        }
        .th-pagination .page-link:hover {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            text-decoration: none;
        }
        .th-pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .th-pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #fff;
            border-color: #e9ecef;
            cursor: not-allowed;
        }
        .th-pagination .page-item.disabled .page-link:hover {
            background-color: #fff;
            border-color: #e9ecef;
            color: #6c757d;
        }
        .th-pagination .small {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .th-pagination .fw-semibold {
            font-weight: 600;
        }

        /* Additional pagination improvements */
        .th-pagination .pagination {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .th-pagination .page-link {
            border: none;
            margin: 0;
            border-radius: 0;
        }
        .th-pagination .page-item:first-child .page-link {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .th-pagination .page-item:last-child .page-link {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .th-pagination .page-link:focus {
            box-shadow: none;
            outline: none;
        }

        /* Style the results text */
        .th-pagination .text-muted {
            color: #666 !important;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .th-pagination .d-flex {
            flex-direction: column;
            align-items: center;
        }
        .th-pagination .justify-content-between {
            justify-content: center !important;
        }
    </style>
</div>
