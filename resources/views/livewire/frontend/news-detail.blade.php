<div>
    <!--==============================
    Breadcumb
============================== -->
    <div
        class="breadcumb-wrapper"
        data-bg-src="assets/img/bg/breadcumb-bg.jpg"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">News Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('news') }}">News</a></li>
                    <li>{{ $news->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!--==============================
    Blog Area
==============================-->
    <section class="th-blog-wrapper blog-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <div class="th-blog blog-single">
                        @if($news->featured_image_url)
                        <div class="blog-img">
                            <img
                                src="{{ $news->featured_image_url }}"
                                alt="{{ $news->title }}"
                            />
                        </div>
                        @endif
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a href="{{ route('news') }}"
                                    ><i class="fas fa-calendar-days"></i
                                    >{{ $news->updated_at->format('M d, Y') }}</a
                                >
                                @if($news->category)
                                <a href="{{ route('news') }}"
                                    ><i class="fas fa-tags"></i
                                    >{{ $news->category }}</a
                                >
                                @endif @if($news->author)
                                <a href="{{ route('news') }}"
                                    ><i class="fas fa-user"></i
                                    >{{ $news->author }}</a
                                >
                                @endif
                            </div>
                            <h2 class="blog-title">{{ $news->title }}</h2>

                            @if($news->excerpt)
                            <p class="lead">{{ $news->excerpt }}</p>
                            @endif

                            <div class="blog-content-text">
                                {!! $news->content !!}
                            </div>

                            <!-- News Image Gallery -->
                            @if($news->images()->count() > 1)
                            <div class="news-images-section mb-45">
                                <h3 class="h4 mb-4">
                                    {{ $news->title }} Images
                                </h3>
                                <div class="row g-3">
                                    @foreach($news->images()->where('featured',
                                    false)->ordered()->get() as $image)
                                    <div class="col-md-6 col-lg-6">
                                        <div class="news-image-item">
                                            <img
                                                src="{{ asset('storage/' . $image->path) }}"
                                                alt="{{ $image->alt_text ?? $news->title }}"
                                                class="img-fluid rounded"
                                                style="
                                                    filter: none !important;
                                                    width: 100%;
                                                    height: 200px;
                                                    object-fit: cover;
                                                "
                                            />
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif @if($news->tags && is_array($news->tags) &&
                            count($news->tags) > 0)
                            <div class="share-links clearfix">
                                <div class="row justify-content-between">
                                    <div class="col-md-auto">
                                        <span class="share-links-title"
                                            >Tags:</span
                                        >
                                        <div class="tagcloud">
                                            @foreach($news->tags as $tag)
                                            <a href="{{ route('news') }}">{{
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
                                                href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}"
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
                        <div class="widget widget_search">
                            <form class="search-form">
                                <input
                                    type="text"
                                    placeholder="Enter Keyword"
                                />
                                <button type="submit">
                                    <i class="far fa-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="widget widget_categories">
                            <h3 class="widget_title">Category</h3>
                            <ul>
                                @php $categories =
                                \App\Models\News::distinct()->pluck('category')->filter();
                                @endphp @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('news') }}">{{
                                        $category
                                    }}</a>
                                    <span
                                        ><i class="fas fa-arrow-right"></i
                                    ></span>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="widget">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                @php $recentNews =
                                \App\Models\News::orderByDesc('updated_at')->limit(3)->get();
                                @endphp @foreach($recentNews as $recent)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a
                                            href="{{ route('news.detail', $recent->slug) }}"
                                        >
                                            @if($recent->featured_image_url)
                                            <img
                                                src="{{ $recent->featured_image_url }}"
                                                alt="{{ $recent->title }}"
                                            />
                                            @else
                                            <img
                                                src="{{
                                                    asset(
                                                        'assets/img/blog/recent-post-1-1.jpg'
                                                    )
                                                }}"
                                                alt="{{ $recent->title }}"
                                            />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="recent-post-meta">
                                            <a href="{{ route('news') }}"
                                                ><i
                                                    class="fas fa-calendar-days"
                                                ></i
                                                >{{ $recent->updated_at->format('d M, Y') }}</a
                                            >
                                        </div>
                                        <h4 class="post-title">
                                            <a
                                                class="text-inherit"
                                                href="{{ route('news.detail', $recent->slug) }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($recent->title, 40) }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="widget widget_tag_cloud">
                            <h3 class="widget_title">Popular Tags</h3>
                            <div class="tagcloud">
                                @php $allTags =
                                \App\Models\News::whereNotNull('tags')->pluck('tags')->flatten()->unique()->take(6);
                                @endphp @foreach($allTags as $tag)
                                <a href="{{ route('news') }}">{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* News Images Styling - Matching Facility Style */
        .news-image-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .news-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .news-image-item img {
            transition: transform 0.3s ease;
        }

        .news-image-item:hover img {
            transform: scale(1.05);
        }

        .news-images-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .news-images-section h3 {
            color: #1a685b;
            border-bottom: 2px solid #ffac00;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>
</div>
