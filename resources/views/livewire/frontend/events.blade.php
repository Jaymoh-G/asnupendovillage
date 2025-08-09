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
                    {{ $pageBanner->title ? $pageBanner->title : 'Events' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Events</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Events</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Events</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="container space-top space-extra-bottom">
        <div class="title-area text-center mb-5">
            <span class="sub-title">Events</span>
            <h2 class="sec-title">Our Latest Events</h2>
        </div>
        <div class="row gy-4 gx-4">
            @forelse($events as $event)
            <div class="col-md-4">
                <div class="blog-card">
                    <div class="blog-img">
                        <a href="#">
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
                                alt="{{ $event->title }}"
                            />
                            @else
                            <img
                                src="{{
                                    asset(
                                        'assets/img/event/event_card1_1-mask.png'
                                    )
                                }}"
                                alt="{{ $event->title }}"
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
                            <a href="{{ route('events') }}"
                                ><i class="fas fa-calendar"></i
                                >{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}</a
                            >
                            <a href="{{ route('events') }}"
                                ><i class="fas fa-clock"></i
                                >{{ \Carbon\Carbon::parse($event->start_date)->format('g:i A') }}</a
                            >
                        </div>
                        <h3 class="box-title">
                            <a href="{{ route('event.show', $event->slug) }}">
                                {{ \Illuminate\Support\Str::limit($event->title, 50) }}
                            </a>
                        </h3>
                        <a
                            href="{{ route('event.show', $event->slug) }}"
                            class="th-btn"
                        >
                            Read More <i class="fas fa-arrow-up-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">No events found.</div>
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $events->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
        /* Override grayscale filter for events images to keep them colored */
        .blog-card .blog-img img {
            filter: none !important;
        }
        .blog-card:hover .blog-img img {
            filter: none !important;
        }
    </style>
</div>
