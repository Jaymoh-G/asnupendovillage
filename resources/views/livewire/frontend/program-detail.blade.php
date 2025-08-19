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
                <h1 class="breadcumb-title">{{ $program->title }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('programs') }}">Programs</a></li>
                    <li>{{ $program->title }}</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $program->title }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('programs') }}">Programs</a></li>
                    <li>{{ $program->title }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Program Details Section -->
    <section class="donation-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <!-- Featured Program Image - At the top -->
                    <div class="page-img mb-4">
                        @if($program->image_url)
                        <img
                            src="{{ $program->image_url }}"
                            alt="{{ $program->title }}"
                            style="filter: none !important"
                        />
                        @else
                        <img
                            src="{{
                                asset('assets/img/service/service_card_1_1.png')
                            }}"
                            alt="{{ $program->title }}"
                        />
                        @endif
                        <div class="tag">Program</div>
                    </div>

                    <div class="blog-content">
                        <h2 class="h3 page-title mt-n2">
                            {{ $program->title }}
                        </h2>

                        @if($program->excerpt)
                        <div class="mb-45">
                            <p class="lead">{{ $program->excerpt }}</p>
                        </div>
                        @endif @if($program->content)
                        <div class="mb-45">{!! $program->content !!}</div>
                        @endif

                        <!-- Additional Program Images Section - At the bottom -->
                        <div class="program-images-section mb-45">
                            <h3 class="h4 mb-4">
                                {{ $program->title }} Program Images
                            </h3>
                            @if($program->images()->count() > 0)
                            <div class="row g-3">
                                @foreach($program->images()->ordered()->get() as $image)
                                <div class="col-md-6 col-lg-6">
                                    <div class="program-image-item">
                                        <img
                                            src="{{ $image->display_url }}"
                                            alt="{{ $image->alt_text ?? $program->title }}"
                                            class="img-fluid rounded"
                                            style="
                                                filter: none !important;
                                                width: 100%;
                                                height: 200px;
                                                object-fit: cover;
                                            "
                                        />
                                        @if($image->featured)
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </div>
                                        @endif @if($image->caption)
                                        <div class="image-caption mt-2">
                                            <p
                                                class="text-muted small text-center mb-0"
                                            >
                                                {{ $image->caption }}
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center text-muted">
                                <i class="fas fa-images fa-3x mb-3"></i>
                                <p>No additional program images available</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area donation-sidebar">
                        <!-- Program Information Widget -->
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Program Information</h3>
                            <ul>
                                @if($program->featured)
                                <li>
                                    <strong>Status:</strong>
                                    <span class="status-badge status-active"
                                        >Featured Program</span
                                    >
                                </li>
                                @endif @if($program->excerpt)
                                <li>
                                    <strong>Description:</strong>
                                    {{ \Illuminate\Support\Str::limit($program->excerpt, 100) }}
                                </li>
                                @endif
                                <li>
                                    <strong>Category:</strong>
                                    <span class="program-category"
                                        >Community Development</span
                                    >
                                </li>
                            </ul>
                        </div>

                        <!-- Support Widget -->
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Support This Program</h3>
                            <div class="support-facility-banner">
                                <div class="support-icon">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <h4 class="support-title">Help Us Maintain</h4>
                                <p class="support-description">
                                    Your support helps us maintain and improve
                                    this program, ensuring it continues to serve
                                    our community with excellence.
                                </p>
                                <div class="support-actions">
                                    <a
                                        class="th-btn support-btn"
                                        href="{{ route('donate-now') }}"
                                    >
                                        <i
                                            class="fas fa-hand-holding-heart"
                                        ></i>
                                        Support Program
                                    </a>
                                    <a
                                        class="th-btn-outline share-btn"
                                        href="#"
                                        onclick="shareProgram()"
                                    >
                                        <i class="fas fa-share-alt"></i>
                                        Share Program
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Related Programs Widget -->
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Other Programs</h3>
                            <div class="related-programs">
                                @forelse($otherPrograms as $otherProgram)
                                <div class="related-program-item">
                                    <div class="program-thumb">
                                        @if($otherProgram->image_url)
                                        <img
                                            src="{{ $otherProgram->image_url }}"
                                            alt="{{ $otherProgram->title }}"
                                        />
                                        @else
                                        <img
                                            src="{{
                                                asset(
                                                    'assets/img/widget/donor_1_1.jpg'
                                                )
                                            }}"
                                            alt="{{ $otherProgram->title }}"
                                        />
                                        @endif
                                    </div>
                                    <div class="program-info">
                                        <h4 class="program-title">
                                            <a
                                                href="{{ route('programs.detail', $otherProgram->slug) }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($otherProgram->title, 40) }}
                                            </a>
                                        </h4>
                                        <div class="program-meta">
                                            @if($otherProgram->featured)
                                            <span class="program-status">
                                                <i class="fas fa-star"></i>
                                                Featured
                                            </span>
                                            @endif @if($otherProgram->excerpt)
                                            <span class="program-excerpt">
                                                {{ \Illuminate\Support\Str::limit($otherProgram->excerpt, 60) }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="related-program-item">
                                    <div class="program-info">
                                        <p class="text-muted">
                                            No related programs found.
                                        </p>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Quick Actions Widget -->
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Quick Actions</h3>
                            <div class="quick-actions">
                                <a
                                    class="th-btn w-100 mb-3"
                                    href="{{ route('programs') }}"
                                >
                                    <i class="fas fa-list"></i>
                                    View All Programs
                                </a>
                                <a
                                    class="th-btn-outline w-100"
                                    href="{{ route('contact-us') }}"
                                >
                                    <i class="fas fa-envelope"></i>
                                    Contact Us
                                </a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <style>
        .page-img img {
            transition: transform 0.3s ease;
        }
        .page-img img:hover {
            transform: scale(1.02);
        }
        .checklist ul li {
            margin-bottom: 10px;
        }
        .checklist ul li i {
            color: #28a745;
            margin-right: 10px;
        }

        /* Program Images Styling */
        .program-image-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .program-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .program-image-item img {
            transition: transform 0.3s ease;
        }

        .program-image-item:hover img {
            transform: scale(1.05);
        }

        .featured-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, #ffac00, #ff8c00);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(255, 172, 0, 0.3);
        }

        .featured-badge i {
            margin-right: 4px;
            color: white;
        }

        .program-images-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .program-images-section h3 {
            color: #1a685b;
            border-bottom: 2px solid #ffac00;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Image Caption Styling */
        .image-caption {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 6px;
            padding: 8px 12px;
            margin-top: 8px;
        }

        .image-caption p {
            font-size: 13px;
            line-height: 1.4;
            color: #6c757d;
            margin: 0;
        }

        /* Status Badge Styling */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: #1a685b;
            color: white;
            border: 1px solid #1a685b;
            box-shadow: 0 2px 8px rgba(26, 104, 91, 0.3);
        }

        .program-category {
            color: #ffac00;
            font-weight: 600;
        }

        /* Support Facility Banner Styling */
        .support-facility-banner {
            text-align: center;
            padding: 25px 20px;
            background: #1a685b;
            border-radius: 12px;
            color: white;
            margin-bottom: 20px;
        }

        .support-icon {
            margin-bottom: 15px;
        }

        .support-icon i {
            font-size: 2.5rem;
            color: #ffac00;
            animation: pulse 2s infinite;
            text-shadow: 0 0 20px rgba(255, 172, 0, 0.5);
        }

        .support-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: white;
        }

        .support-description {
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.9);
        }

        .support-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .support-btn {
            background: #ffac00 !important;
            color: white !important;
            border: 2px solid #ffac00 !important;
            font-weight: 600;
            padding: 12px 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 172, 0, 0.3);
        }

        .support-btn:hover {
            background: white !important;
            color: #ffac00 !important;
            border-color: #ffac00 !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 172, 0, 0.4);
        }

        .share-btn {
            background: transparent !important;
            color: white !important;
            border: 2px solid rgba(255, 172, 0, 0.8) !important;
            font-weight: 600;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            background: rgba(255, 172, 0, 0.1) !important;
            color: #ffac00 !important;
            border-color: #ffac00 !important;
            transform: translateY(-2px);
        }

        .support-btn i,
        .share-btn i {
            margin-right: 8px;
        }

        /* Related Programs Styling */
        .related-programs {
            margin-top: 20px;
        }

        .related-program-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .related-program-item:hover {
            border-color: #ffac00;
            box-shadow: 0 4px 12px rgba(255, 172, 0, 0.25);
            background: rgba(255, 172, 0, 0.02);
        }

        .related-program-item:last-child {
            margin-bottom: 0;
        }

        .program-thumb {
            flex-shrink: 0;
            width: 80px;
            height: 60px;
            margin-right: 15px;
            border-radius: 6px;
            overflow: hidden;
        }

        .program-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: none !important;
        }

        .program-info {
            flex: 1;
            min-width: 0;
        }

        .program-title {
            margin: 0 0 8px 0;
            font-size: 14px;
            line-height: 1.3;
        }

        .program-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .program-title a:hover {
            color: #ffac00;
            text-shadow: 0 0 8px rgba(255, 172, 0, 0.2);
        }

        .program-meta {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .program-meta span {
            font-size: 12px;
            color: #666;
            display: flex;
            align-items: center;
        }

        .program-meta i {
            margin-right: 6px;
            color: #ffac00;
            width: 14px;
            text-shadow: 0 0 8px rgba(255, 172, 0, 0.3);
        }

        .program-status,
        .program-excerpt {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Quick Actions Styling */
        .quick-actions {
            margin-top: 20px;
        }

        .quick-actions .th-btn,
        .quick-actions .th-btn-outline {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .quick-actions .th-btn i,
        .quick-actions .th-btn-outline i {
            margin: 0;
        }

        /* Lead paragraph styling */
        .lead {
            font-size: 1.1rem;
            font-weight: 500;
            color: #1a685b;
            line-height: 1.6;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>

    <script>
        function shareProgram() {
            if (navigator.share) {
                navigator.share({
                    title: "{{ $program->title }}",
                    text: "Check out this amazing program: {{ $program->title }}",
                    url: window.location.href,
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                const url = window.location.href;
                const text =
                    "Check out this amazing program: {{ $program->title }}";

                // Copy to clipboard
                navigator.clipboard
                    .writeText(`${text}\n${url}`)
                    .then(() => {
                        alert("Program link copied to clipboard!");
                    })
                    .catch(() => {
                        // Fallback: open in new window
                        window.open(
                            `https://twitter.com/intent/tweet?text=${encodeURIComponent(
                                text
                            )}&url=${encodeURIComponent(url)}`,
                            "_blank"
                        );
                    });
            }
        }
    </script>
</div>
