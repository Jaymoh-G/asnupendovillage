<div>
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
                    {{ $pageBanner->title ? $pageBanner->title : 'Event Details' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('events') }}">Events</a></li>
                    <li>{{ $event->title }}</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Event Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('events') }}">Events</a></li>
                    <li>{{ $event->title }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!--==============================
    Event Details Area
==============================-->
    <section class="th-blog-wrapper blog-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <div class="th-blog blog-single">
                        @if($event->featured_image_url)
                        <div class="blog-img">
                            <img
                                src="{{ $event->featured_image_url }}"
                                alt="{{ $event->title }}"
                            />
                        </div>
                        @endif
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a href="{{ route('events') }}"
                                    ><i class="fas fa-calendar-days"></i
                                    >{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</a
                                >
                                <a href="{{ route('events') }}"
                                    ><i class="fas fa-clock"></i
                                    >{{ \Carbon\Carbon::parse($event->start_date)->format('g:i A') }}</a
                                >
                                @if($event->location)
                                <a href="{{ route('events') }}"
                                    ><i class="fas fa-map-marker-alt"></i
                                    >{{ $event->location }}</a
                                >
                                @endif
                            </div>
                            <h2 class="blog-title">{{ $event->title }}</h2>

                            @if($event->excerpt)
                            <p class="lead">{{ $event->excerpt }}</p>
                            @endif

                            <div class="blog-content-text">
                                {!! $event->description !!}
                            </div>

                            <!-- Event Image Gallery -->
                            @if($event->images()->count() > 0)
                            <div class="event-images-section mb-45">
                                <h3 class="h4 mb-4">
                                    {{ $event->title }} Event Images
                                </h3>
                                <div class="row g-3">
                                    @foreach($event->images()->ordered()->get()
                                    as $image)
                                    <div class="col-md-6 col-lg-6">
                                        <div class="event-image-item">
                                            <img
                                                src="{{ $image->display_url }}"
                                                alt="{{ $image->alt_text ?? $event->title }}"
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
                                                <i class="fas fa-star"></i>
                                                Featured
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
                            </div>
                            @else
                            <div class="event-images-section mb-45">
                                <h3 class="h4 mb-4">
                                    {{ $event->title }} Event Images
                                </h3>
                                <div class="text-center text-muted">
                                    <i class="fas fa-images fa-3x mb-3"></i>
                                    <p>No additional event images available</p>
                                </div>
                            </div>
                            @endif @if($event->tags && is_array($event->tags) &&
                            count($event->tags) > 0)
                            <div class="share-links clearfix">
                                <div class="row justify-content-between">
                                    <div class="col-md-auto">
                                        <span class="share-links-title"
                                            >Tags:</span
                                        >
                                        <div class="tagcloud">
                                            @foreach($event->tags as $tag)
                                            <a href="{{ route('events') }}">{{
                                                $tag
                                            }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-auto text-xl-end">
                                        <span class="share-links-title"
                                            >Share:</span
                                        >
                                        <div
                                            class="th-social align-items-center"
                                        >
                                            <a
                                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                                target="_blank"
                                                ><i
                                                    class="fab fa-facebook-f"
                                                ></i
                                            ></a>
                                            <a
                                                href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($event->title) }}"
                                                target="_blank"
                                                ><i class="fab fa-twitter"></i
                                            ></a>
                                            <a
                                                href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                                target="_blank"
                                                ><i
                                                    class="fab fa-linkedin-in"
                                                ></i
                                            ></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        <div class="widget widget_categories">
                            <h3 class="widget_title">{{ $event->title }}</h3>
                            <ul>
                                <li>
                                    <strong>Date:</strong>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                </li>
                                <li>
                                    <strong>Time:</strong>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('g:i A') }}
                                </li>
                                @if($event->end_date)
                                <li>
                                    <strong>End Time:</strong>
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('g:i A') }}
                                </li>
                                @endif @if($event->location)
                                <li>
                                    <strong>Location:</strong>
                                    {{ $event->location }}
                                </li>
                                @endif @if($event->organizer)
                                <li>
                                    <strong>Organizer:</strong>
                                    {{ $event->organizer }}
                                </li>
                                @endif
                            </ul>
                        </div>

                        @if($relatedEvents && $relatedEvents->count() > 0)
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Other Events</h3>
                            <div class="related-events">
                                @foreach($relatedEvents as $relatedEvent)
                                <div class="related-event-item">
                                    <div class="event-thumb">
                                        @if($relatedEvent->featured_image_url)
                                        <img
                                            src="{{ $relatedEvent->featured_image_url }}"
                                            alt="{{ $relatedEvent->title }}"
                                        />
                                        @else
                                        <img
                                            src="{{
                                                asset(
                                                    'assets/img/event/event_card1_1-mask.png'
                                                )
                                            }}"
                                            alt="{{ $relatedEvent->title }}"
                                        />
                                        @endif
                                    </div>
                                    <div class="event-info">
                                        <h4 class="event-title">
                                            <a
                                                href="{{ route('event.show', $relatedEvent->slug) }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($relatedEvent->title, 40) }}
                                            </a>
                                        </h4>
                                        <div class="event-meta">
                                            <span class="event-date">
                                                <i class="fas fa-calendar"></i>
                                                {{ \Carbon\Carbon::parse($relatedEvent->start_date)->format('M d, Y') }}
                                            </span>
                                            @if($relatedEvent->location)
                                            <span class="event-location">
                                                <i
                                                    class="fas fa-map-marker-alt"
                                                ></i>
                                                {{ \Illuminate\Support\Str::limit($relatedEvent->location, 25) }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <style>
        .related-events {
            margin-top: 20px;
        }

        .related-event-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .related-event-item:hover {
            border-color: #ffac00;
            box-shadow: 0 4px 12px rgba(255, 172, 0, 0.15);
        }

        .related-event-item:last-child {
            margin-bottom: 0;
        }

        .event-thumb {
            flex-shrink: 0;
            width: 80px;
            height: 60px;
            margin-right: 15px;
            border-radius: 6px;
            overflow: hidden;
        }

        .event-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .event-info {
            flex: 1;
            min-width: 0;
        }

        .event-title {
            margin: 0 0 8px 0;
            font-size: 14px;
            line-height: 1.3;
        }

        .event-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .event-title a:hover {
            color: #ffac00;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .event-meta span {
            font-size: 12px;
            color: #666;
            display: flex;
            align-items: center;
        }

        .event-meta i {
            margin-right: 6px;
            color: #ffac00;
            width: 14px;
        }

        .event-date,
        .event-location {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Event Images Styling */
        .event-image-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .event-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .event-image-item img {
            transition: transform 0.3s ease;
        }

        .event-image-item:hover img {
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

        .event-images-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .event-images-section h3 {
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
    </style>
</div>
