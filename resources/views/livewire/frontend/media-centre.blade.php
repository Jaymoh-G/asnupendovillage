<div>
    @section('content')
    <style>
        /* Override grayscale filter for gallery images */
        .gallery-section .project-card .project-img img {
            filter: none !important;
        }
        .gallery-section .project-card:hover .project-img img {
            filter: none !important;
        }

        /* Override grayscale filter for news and events images */
        .news-section .blog-card .blog-img img {
            filter: none !important;
        }
        .news-section .blog-card:hover .blog-img img {
            filter: none !important;
        }

        .events-section .blog-card .blog-img img {
            filter: none !important;
        }
        .events-section .blog-card:hover .blog-img img {
            filter: none !important;
        }

        /* Enhanced styling for careers and downloads sections */
        .careers-section .feature-card,
        .downloads-section .feature-card {
            background: var(--white-color);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .careers-section .feature-card:hover,
        .downloads-section .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.12);
        }

        .careers-section .box-icon,
        .downloads-section .box-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(
                135deg,
                var(--theme-color),
                var(--theme-color2)
            );
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
        }

        .careers-section .box-title,
        .downloads-section .box-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--title-color);
        }

        .careers-section .box-text,
        .downloads-section .box-text {
            color: var(--body-color);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .career-meta,
        .download-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            font-size: 13px;
            color: var(--body-color);
            background: rgba(0, 0, 0, 0.05);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .meta-item i {
            color: var(--theme-color);
        }

        .careers-section .th-btn,
        .downloads-section .th-btn {
            margin-top: 10px;
        }

        /* Ensure uniform card heights and prevent overflow */
        .careers-section .feature-card,
        .downloads-section .feature-card {
            display: flex;
            flex-direction: column;
        }

        .careers-section .box-content,
        .downloads-section .box-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .careers-section .box-text,
        .downloads-section .box-text {
            flex-grow: 1;
            min-height: 0;
        }

        .career-meta,
        .download-meta {
            flex-shrink: 0;
        }

        .meta-item {
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Content and icon side by side layout */
        .content-icon-row {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
        }

        .content-icon-row .box-icon {
            width: 50px;
            height: 50px;
            margin-bottom: 0;
            flex-shrink: 0;
        }

        .content-stack {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .content-stack .box-title {
            margin-bottom: 0;
            text-align: left;
        }

        .content-stack .career-meta,
        .content-stack .download-meta {
            margin-bottom: 0;
        }
    </style>
    <!-- Banner Section -->
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner ? $pageBanner->effective_banner_url : '' }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                    {{ $pageBanner && $pageBanner->title ? $pageBanner->title : 'Media Centre' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>
                        {{ $pageBanner && $pageBanner->title ? $pageBanner->title : 'Media Centre' }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container space-top space-extra-bottom">
        <div class="row gy-40 gx-40">
            <!-- Events Section -->
            <div class="col-12 mb-5 events-section">
                <div class="title-area mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <span class="sub-title">Events & Activities</span>
                            <h2 class="sec-title">
                                Our Latest Events & Activities
                            </h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ url('/events') }}" class="th-btn btn-sm"
                                >View All Events
                                <i class="fas fa-arrow-up-right ms-2"></i
                            ></a>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($events as $event)
                    <div class="col-md-4">
                        <div class="blog-card">
                            <div class="blog-img">
                                <a
                                    href="{{ url('/events/' . ($event->slug ?? $event->id)) }}"
                                >
                                    <div
                                        class="blog-img-shape1"
                                        data-mask-src="{{
                                            asset(
                                                'assets/img/blog/blog-card-bg-shape1-2.png'
                                            )
                                        }}"
                                    ></div>
                                    @if($event->featured_image_url)
                                    <img
                                        src="{{ $event->featured_image_url }}"
                                        alt="{{ $event->title ?? 'Event Image' }}"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/blog/blog_1_2.jpg'
                                            )
                                        }}"
                                        alt="{{ $event->title ?? 'Event Image' }}"
                                    />
                                    @endif
                                </a>
                            </div>
                            <div class="blog-content">
                                <div
                                    class="blog-card-shape"
                                    data-mask-src="{{
                                        asset(
                                            'assets/img/blog/blog-card-bg-shape1-1.png'
                                        )
                                    }}"
                                ></div>
                                <div class="blog-meta">
                                    <a href="{{ url('/events') }}"
                                        ><i class="fas fa-calendar"></i
                                        >{{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('M d, Y') : 'TBD' }}</a
                                    >
                                    <a href="{{ url('/events') }}"
                                        ><i class="fas fa-clock"></i
                                        >{{ $event->event_time ? $event->event_time : 'TBD' }}</a
                                    >
                                </div>
                                <h3 class="box-title">
                                    <a
                                        href="{{ url('/events/' . ($event->slug ?? $event->id)) }}"
                                    >
                                        {{ \Illuminate\Support\Str::limit($event->title ?? 'Event', 50) }}
                                    </a>
                                </h3>
                                <a
                                    href="{{ url('/events/' . ($event->slug ?? $event->id)) }}"
                                    class="th-btn"
                                >
                                    Read More
                                    <i class="fas fa-arrow-up-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">No events found.</div>
                    @endforelse
                </div>
            </div>
            <!-- News Section -->
            <div class="col-12 mb-5 news-section">
                <div class="title-area mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <span class="sub-title">News & Articles</span>
                            <h2 class="sec-title">
                                Our Latest News & Articles
                            </h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ url('/news') }}" class="th-btn btn-sm"
                                >View All News
                                <i class="fas fa-arrow-up-right ms-2"></i
                            ></a>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($news as $item)
                    <div class="col-md-4">
                        <div class="blog-card">
                            <div class="blog-img">
                                <a
                                    href="{{ url('/news/' . ($item->slug ?? $item->id)) }}"
                                >
                                    <div
                                        class="blog-img-shape1"
                                        data-mask-src="{{
                                            asset(
                                                'assets/img/blog/blog-card-bg-shape1-2.png'
                                            )
                                        }}"
                                    ></div>
                                    @if($item->featured_image_url)
                                    <img
                                        src="{{ $item->featured_image_url }}"
                                        alt="{{ $item->title ?? 'News Image' }}"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/blog/blog_1_1.jpg'
                                            )
                                        }}"
                                        alt="{{ $item->title ?? 'News Image' }}"
                                    />
                                    @endif
                                </a>
                            </div>
                            <div class="blog-content">
                                <div
                                    class="blog-card-shape"
                                    data-mask-src="{{
                                        asset(
                                            'assets/img/blog/blog-card-bg-shape1-1.png'
                                        )
                                    }}"
                                ></div>
                                <div class="blog-meta">
                                    <a href="{{ url('/news') }}"
                                        ><i class="fas fa-calendar"></i
                                        >{{ $item->updated_at ? $item->updated_at->format('M d, Y') : 'Recent' }}</a
                                    >
                                    <a href="{{ url('/news') }}"
                                        ><i class="fas fa-tags"></i>News</a
                                    >
                                </div>
                                <h3 class="box-title">
                                    <a
                                        href="{{ url('/news/' . ($item->slug ?? $item->id)) }}"
                                    >
                                        {{ \Illuminate\Support\Str::limit($item->title ?? 'News', 50) }}
                                    </a>
                                </h3>
                                <a
                                    href="{{ url('/news/' . ($item->slug ?? $item->id)) }}"
                                    class="th-btn"
                                >
                                    Read More
                                    <i class="fas fa-arrow-up-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">No news found.</div>
                    @endforelse
                </div>
            </div>
            <!-- Gallery Section -->
            <div class="col-12 mb-5 gallery-section">
                <div class="title-area mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <span class="sub-title">Photo Gallery</span>
                            <h2 class="sec-title">
                                Our Photo Gallery & Visual Content
                            </h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a
                                href="{{ url('/gallery') }}"
                                class="th-btn btn-sm"
                                >View All Photos
                                <i class="fas fa-arrow-up-right ms-2"></i
                            ></a>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($gallery as $image)
                    <div class="col-md-4">
                        <div class="project-card">
                            <div class="project-img">
                                <img
                                    src="{{ asset('storage/' . ($image->file_path ?? $image->path ?? '')) }}"
                                    alt="{{ $image->alt_text ?? 'Gallery Image' }}"
                                />
                            </div>
                            <div class="project-content">
                                <div
                                    class="project-card-bg-shape"
                                    data-mask-src="{{
                                        asset(
                                            'assets/img/shape/project-card-bg-shape1-1.png'
                                        )
                                    }}"
                                ></div>
                                <h3 class="project-title">
                                    <a
                                        href="{{ asset('storage/' . ($image->file_path ?? $image->path ?? '')) }}"
                                        target="_blank"
                                    >
                                        {{ \Illuminate\Support\Str::limit($image->alt_text ?? 'Photo', 30) }}
                                    </a>
                                </h3>
                                <p class="project-subtitle">Gallery Image</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">No photos found.</div>
                    @endforelse
                </div>
            </div>
            <!-- Careers Section -->
            <div class="col-12 mb-5 careers-section">
                <div class="title-area mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <span class="sub-title">Career Opportunities</span>
                            <h2 class="sec-title">Join Our Dedicated Team</h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a
                                href="{{ url('/careers') }}"
                                class="th-btn btn-sm"
                                >View All Careers
                                <i class="fas fa-arrow-up-right ms-2"></i
                            ></a>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($careers as $career)
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="box-content">
                                <div class="content-icon-row">
                                    <div class="box-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="content-stack">
                                        <h3 class="box-title">
                                            {{ \Illuminate\Support\Str::limit($career->title ?? 'Career', 25) }}
                                        </h3>
                                        <div class="career-meta">
                                            @if($career->location)
                                            <span class="meta-item"
                                                ><i
                                                    class="fas fa-map-marker-alt me-2"
                                                ></i
                                                >{{ \Illuminate\Support\Str::limit($career->location, 15) }}</span
                                            >
                                            @endif @if($career->type)
                                            <span class="meta-item"
                                                ><i
                                                    class="fas fa-clock me-2"
                                                ></i
                                                >{{ \Illuminate\Support\Str::limit($career->type, 12) }}</span
                                            >
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <a
                                    href="{{ url('/careers/' . ($career->id)) }}"
                                    class="th-btn btn-sm"
                                    >View Details
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">No careers found.</div>
                    @endforelse
                </div>
            </div>
            <!-- Downloads Section -->
            <div class="col-12 mb-5 downloads-section">
                <div class="title-area mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <span class="sub-title">Resources & Downloads</span>
                            <h2 class="sec-title">
                                Access Our Resources & Materials
                            </h2>
                        </div>
                        <div class="col-md-4 text-end">
                            <a
                                href="{{ url('/downloads') }}"
                                class="th-btn btn-sm"
                                >View All Downloads
                                <i class="fas fa-arrow-up-right ms-2"></i
                            ></a>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($downloads as $download)
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="box-content">
                                <div class="content-icon-row">
                                    <div class="box-icon">
                                        @php $fileExtension =
                                        pathinfo($download->file_path,
                                        PATHINFO_EXTENSION); $iconClass = 'fas
                                        fa-file'; if
                                        (in_array(strtolower($fileExtension),
                                        ['pdf'])) { $iconClass = 'fas
                                        fa-file-pdf'; } elseif
                                        (in_array(strtolower($fileExtension),
                                        ['doc', 'docx'])) { $iconClass = 'fas
                                        fa-file-word'; } elseif
                                        (in_array(strtolower($fileExtension),
                                        ['xls', 'xlsx'])) { $iconClass = 'fas
                                        fa-file-excel'; } elseif
                                        (in_array(strtolower($fileExtension),
                                        ['ppt', 'pptx'])) { $iconClass = 'fas
                                        fa-file-powerpoint'; } elseif
                                        (in_array(strtolower($fileExtension),
                                        ['jpg', 'jpeg', 'png', 'gif'])) {
                                        $iconClass = 'fas fa-file-image'; }
                                        @endphp
                                        <i class="{{ $iconClass }}"></i>
                                    </div>
                                    <div class="content-stack">
                                        <h3 class="box-title">
                                            {{ \Illuminate\Support\Str::limit($download->title ?? 'Download', 25) }}
                                        </h3>
                                        <div class="download-meta">
                                            @if($download->program)
                                            <span class="meta-item"
                                                ><i
                                                    class="fas fa-folder me-2"
                                                ></i
                                                >{{ \Illuminate\Support\Str::limit($download->program->title ?? 'General', 15) }}</span
                                            >
                                            @endif
                                            <span class="meta-item"
                                                ><i class="fas fa-file me-2"></i
                                                >{{
                                                    strtoupper($fileExtension)
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                                <a
                                    href="{{ asset('storage/' . $download->file_path) }}"
                                    class="th-btn btn-sm"
                                    target="_blank"
                                    >Download
                                    <i class="fas fa-download ms-2"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">No downloads found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>
