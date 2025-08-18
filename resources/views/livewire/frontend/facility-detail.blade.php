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
                <h1 class="breadcumb-title">{{ $facility->name }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('facilities') }}">Facilities</a></li>
                    <li>{{ $facility->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $facility->name }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('facilities') }}">Facilities</a></li>
                    <li>{{ $facility->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Facility Details Section -->
    <section class="donation-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <!-- Featured Facility Image - At the top -->
                    <div class="page-img mb-4">
                        @if($facility->image_url)
                        <img
                            src="{{ $facility->image_url }}"
                            alt="{{ $facility->name }}"
                            style="filter: none !important"
                        />
                        @php $featuredImage = $facility->featuredImage; @endphp
                        @if($featuredImage && $featuredImage->caption)
                        <div class="featured-image-caption">
                            <p>{{ $featuredImage->caption }}</p>
                        </div>
                        @endif @else
                        <img
                            src="{{
                                asset('assets/img/service/service_card_1_1.png')
                            }}"
                            alt="{{ $facility->name }}"
                        />
                        @endif
                    </div>

                    <div class="blog-content">
                        <h2 class="h3 page-title mt-n2">
                            {{ $facility->name }}
                        </h2>

                        @if($facility->description)
                        <div class="mb-45">{!! $facility->description !!}</div>
                        @endif @if($facility->content)
                        <div class="mb-45">{!! $facility->content !!}</div>
                        @endif

                        <!-- Additional Facility Images Section - At the bottom -->
                        <div class="facility-images-section mb-45">
                            <h3 class="h4 mb-4">
                                {{ $facility->name }} Facility Images
                            </h3>

                            <!-- Debug Information (remove this after testing) -->
                            @if(config('app.debug'))
                            <div
                                class="debug-info mb-3 p-3 bg-light border rounded"
                            >
                                <small class="text-muted">
                                    <strong>Debug Info:</strong><br />
                                    Total Images:
                                    {{ $facility->images()->count() }}<br />
                                    Featured Image:
                                    {{ $facility->featuredImage ? 'Yes' : 'No'
                                    }}<br />
                                    @if($facility->featuredImage) Featured Image
                                    Caption:
                                    {{ $facility->featuredImage->caption ?: 'No caption'
                                    }}<br />
                                    @endif
                                    @foreach($facility->images()->take(3)->get()
                                    as $debugImage) Image
                                    {{ $loop->iteration }}:
                                    {{ $debugImage->caption ?: 'No caption'
                                    }}<br />
                                    @endforeach
                                </small>
                            </div>
                            @endif @if($facility->images()->count() > 0)
                            <div class="row g-3">
                                @foreach($facility->images()->ordered()->get()
                                as $image)
                                <div class="col-md-6 col-lg-6">
                                    <div class="facility-image-item">
                                        <img
                                            src="{{ $image->display_url }}"
                                            alt="{{ $image->alt_text ?? $facility->name }}"
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
                                        <div class="image-caption">
                                            <p>{{ $image->caption }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center text-muted">
                                <i class="fas fa-images fa-3x mb-3"></i>
                                <p>No additional facility images available</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area donation-sidebar">
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Support This Facility</h3>
                            <div class="support-facility-banner">
                                <div class="support-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <h4 class="support-title">Help Us Maintain</h4>
                                <p class="support-description">
                                    Your support helps us maintain and improve
                                    this facility, ensuring it continues to
                                    serve our community with excellence.
                                </p>
                                <div class="support-actions">
                                    <a
                                        class="th-btn support-btn"
                                        href="{{ route('donate-now') }}"
                                    >
                                        <i
                                            class="fas fa-hand-holding-heart"
                                        ></i>
                                        Support Facility
                                    </a>
                                    <a
                                        class="th-btn-outline share-btn"
                                        href="#"
                                        onclick="shareFacility()"
                                    >
                                        <i class="fas fa-share-alt"></i>
                                        Share Facility
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="widget widget_categories">
                            <h3 class="widget_title">Other Facilities</h3>
                            <div class="related-facilities">
                                @forelse($otherFacilities as $otherFacility)
                                <div class="related-facility-item">
                                    <div class="facility-thumb">
                                        @if($otherFacility->image_url)
                                        <img
                                            src="{{ $otherFacility->image_url }}"
                                            alt="{{ $otherFacility->name }}"
                                        />
                                        @else
                                        <img
                                            src="{{
                                                asset(
                                                    'assets/img/widget/donor_1_1.jpg'
                                                )
                                            }}"
                                            alt="{{ $otherFacility->name }}"
                                        />
                                        @endif
                                    </div>
                                    <div class="facility-info">
                                        <h4 class="facility-title">
                                            <a
                                                href="{{ route('facilities.detail', $otherFacility->slug) }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($otherFacility->name, 40) }}
                                            </a>
                                        </h4>
                                        @if($otherFacility->capacity)
                                        <div class="facility-meta">
                                            <span class="facility-capacity">
                                                <i class="fas fa-users"></i>
                                                {{ $otherFacility->capacity }}
                                                people
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="related-facility-item">
                                    <div class="facility-info">
                                        <p class="text-muted">
                                            No related facilities found.
                                        </p>
                                    </div>
                                </div>
                                @endforelse
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
        .donation-progress-wrap {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            border-left: 4px solid #007bff;
        }
        .progress {
            height: 25px;
            background-color: #e9ecef;
            border-radius: 15px;
            overflow: hidden;
        }
        .progress-bar {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border-radius: 15px;
            position: relative;
        }
        .progress-value {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-weight: bold;
            font-size: 12px;
        }
        .donation-progress-content {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-weight: 600;
        }
        .donation-card_raise-number,
        .donation-card_goal-number {
            color: #007bff;
        }
        .recent-post {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }
        .recent-post:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .media-img {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 8px;
            overflow: hidden;
        }
        .media-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .post-title {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .recent-post-meta a {
            color: #6c757d;
            font-size: 12px;
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

        .status-inactive {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            border: 1px solid #6c757d;
        }

        .status-maintenance {
            background: #ffac00;
            color: #212529;
            border: 1px solid #ffac00;
            box-shadow: 0 2px 8px rgba(255, 172, 0, 0.3);
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

        /* Related Facilities Styling */
        .related-facilities {
            margin-top: 20px;
        }

        .related-facility-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .related-facility-item:hover {
            border-color: #ffac00;
            box-shadow: 0 4px 12px rgba(255, 172, 0, 0.25);
            background: rgba(255, 172, 0, 0.02);
        }

        .related-facility-item:last-child {
            margin-bottom: 0;
        }

        .facility-thumb {
            flex-shrink: 0;
            width: 80px;
            height: 60px;
            margin-right: 15px;
            border-radius: 6px;
            overflow: hidden;
        }

        .facility-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: none !important;
        }

        .facility-info {
            flex: 1;
            min-width: 0;
        }

        .facility-title {
            margin: 0 0 8px 0;
            font-size: 14px;
            line-height: 1.3;
        }

        .facility-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .facility-title a:hover {
            color: #ffac00;
            text-shadow: 0 0 8px rgba(255, 172, 0, 0.2);
        }

        .facility-meta {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .facility-meta span {
            font-size: 12px;
            color: #666;
            display: flex;
            align-items: center;
        }

        .facility-meta i {
            margin-right: 6px;
            color: #ffac00;
            width: 14px;
            text-shadow: 0 0 8px rgba(255, 172, 0, 0.3);
        }

        .facility-capacity {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Facility Images Styling */
        .facility-image-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .facility-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .facility-image-item img {
            transition: transform 0.3s ease;
        }

        .facility-image-item:hover img {
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

        .facility-images-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .facility-images-section h3 {
            color: #1a685b;
            border-bottom: 2px solid #ffac00;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Image Caption Styling */
        .image-caption {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 12px;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .image-caption p {
            margin: 0;
            font-size: 14px;
            line-height: 1.4;
            text-align: center;
        }

        /* Featured Image Caption Styling */
        .page-img {
            position: relative;
        }

        .featured-image-caption {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 12px 16px;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }

        .featured-image-caption p {
            margin: 0;
            font-size: 16px;
            line-height: 1.4;
            font-weight: 500;
        }

        /* Debug Info Styling */
        .debug-info {
            font-family: monospace;
            font-size: 12px;
        }
    </style>

    <script>
        function shareFacility() {
            if (navigator.share) {
                navigator.share({
                    title: "{{ $facility->name }}",
                    text: "Check out this amazing facility: {{ $facility->name }}",
                    url: window.location.href,
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                const url = window.location.href;
                const text =
                    "Check out this amazing facility: {{ $facility->name }}";

                // Copy to clipboard
                navigator.clipboard
                    .writeText(`${text}\n${url}`)
                    .then(() => {
                        alert("Facility link copied to clipboard!");
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
