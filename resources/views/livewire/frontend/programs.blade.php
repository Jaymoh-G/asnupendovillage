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
                    {{ $pageBanner->title ?? 'Our Programs' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Programs</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Our Programs</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Programs</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Programs Section -->
    <div class="container space-top space-extra-bottom">
        <div class="title-area text-center mb-5">
            <span class="sub-title">Our Programs</span>
            <h2 class="sec-title">Explore Our Comprehensive Programs</h2>
        </div>
        <div class="row gy-4 gx-4">
            @forelse($programs as $program)
            <div class="col-md-4 d-flex">
                <div class="blog-card w-100 d-flex flex-column h-100">
                    <div class="blog-img">
                        <a
                            href="{{ route('programs.detail', $program->slug) }}"
                        >
                            @if($program->image_url)
                            <img
                                src="{{ $program->image_url }}"
                                alt="{{ $program->title }}"
                                style="filter: none !important"
                            />
                            @else
                            <img
                                src="{{
                                    asset(
                                        'assets/img/service/service_card_1_1.png'
                                    )
                                }}"
                                alt="{{ $program->title }}"
                            />
                            @endif
                        </a>
                    </div>
                    <div class="blog-content d-flex flex-column flex-grow-1">
                        <div class="blog-meta">
                            <a href="{{ route('programs') }}"
                                ><i class="fas fa-tags"></i>Program</a
                            >
                            @if($program->featured)
                            <a href="{{ route('programs') }}"
                                ><i class="fas fa-star"></i>Featured</a
                            >
                            @endif
                        </div>
                        <h3 class="box-title">
                            <a
                                href="{{ route('programs.detail', $program->slug) }}"
                                >{{ \Illuminate\Support\Str::limit($program->title, 50) }}</a
                            >
                        </h3>
                        @if($program->excerpt)
                        <p class="blog-text">
                            {{ $program->excerpt }}
                        </p>
                        @elseif($program->content)
                        <p class="blog-text">
                            {{ \Illuminate\Support\Str::limit($program->content, 100) }}
                        </p>
                        @endif
                        <a
                            href="{{ route('programs.detail', $program->slug) }}"
                            class="th-btn mt-auto"
                            >Read More <i class="fas fa-arrow-up-right ms-2"></i
                        ></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">No programs found.</div>
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $programs->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
        /* Override grayscale filter for program images to keep them colored */
        .blog-card .blog-img img {
            filter: none !important;
        }
        .blog-card:hover .blog-img img {
            filter: none !important;
        }
        /* Ensure equal height cards */
        .blog-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .blog-card .blog-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .blog-card .th-btn.mt-auto {
            margin-top: auto;
        }
    </style>
</div>
