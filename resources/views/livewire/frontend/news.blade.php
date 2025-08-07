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
                    {{ $pageBanner->title ? $pageBanner->title : 'News & Articles' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>News & Articles</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">News & Articles</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>News & Articles</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="container space-top space-extra-bottom">
        <div class="title-area text-center mb-5">
            <span class="sub-title">News & Articles</span>
            <h2 class="sec-title">Our Latest News & Articles</h2>
        </div>
        <div class="row gy-4 gx-4">
            @forelse($news as $item)
            <div class="col-md-4">
                <div class="blog-card">
                    <div class="blog-img">
                        <a href="{{ route('news.detail', $item->slug) }}">
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
                                alt="{{ $item->title }}"
                            />
                            @else
                            <img
                                src="{{
                                    asset('assets/img/blog/blog_1_1.jpg')
                                }}"
                                alt="{{ $item->title }}"
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
                            <a href="{{ route('news') }}"
                                ><i class="fas fa-calendar"></i
                                >{{ $item->updated_at->format('M d, Y') }}</a
                            >
                            <a href="{{ route('news') }}"
                                ><i class="fas fa-tags"></i>News</a
                            >
                        </div>
                        <h3 class="box-title">
                            <a href="{{ route('news.detail', $item->slug) }}">
                                {{ \Illuminate\Support\Str::limit($item->title, 50) }}
                            </a>
                        </h3>
                        <a
                            href="{{ route('news.detail', $item->slug) }}"
                            class="th-btn"
                        >
                            Read More <i class="fas fa-arrow-up-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">No news found.</div>
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $news->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
        /* Override grayscale filter for news images to keep them colored */
        .blog-card .blog-img img {
            filter: none !important;
        }
        .blog-card:hover .blog-img img {
            filter: none !important;
        }
    </style>
</div>
