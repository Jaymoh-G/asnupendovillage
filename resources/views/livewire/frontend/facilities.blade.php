<div>
    <!-- Banner Section -->
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Our Facilities</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Facilities</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container space-top space-extra-bottom">
        <div class="title-area text-center mb-5">
            <span class="sub-title">Our Facilities</span>
            <h2 class="sec-title">Explore Our Modern Facilities</h2>
        </div>
        <div class="row gy-4 gx-4">
            @forelse($facilities as $facility)
            <div class="col-md-4 d-flex">
                <div class="blog-card w-100 d-flex flex-column h-100">
                    <div class="blog-img">
                        <a
                            href="{{ route('facilities.detail', $facility->slug) }}"
                        >
                            @if($facility->featured_image_url)
                            <img
                                src="{{ $facility->featured_image_url }}"
                                alt="{{ $facility->name }}"
                            />
                            @else
                            <img
                                src="{{
                                    asset(
                                        'assets/img/service/service_card_1_1.png'
                                    )
                                }}"
                                alt="{{ $facility->name }}"
                            />
                            @endif
                        </a>
                    </div>
                    <div class="blog-content d-flex flex-column flex-grow-1">
                        <div class="blog-meta">
                            <a href="{{ route('facilities') }}"
                                ><i class="fas fa-building"></i>Facility</a
                            >
                            @if($facility->capacity)
                            <a href="{{ route('facilities') }}"
                                ><i class="fas fa-users"></i>Capacity:
                                {{ $facility->capacity }}</a
                            >
                            @endif
                        </div>
                        <h3 class="box-title">
                            <a
                                href="{{ route('facilities.detail', $facility->slug) }}"
                            >
                                {{ \Illuminate\Support\Str::limit($facility->name, 50) }}
                            </a>
                        </h3>
                        @if($facility->description)
                        <p class="blog-text">
                            {{ \Illuminate\Support\Str::limit($facility->description, 100) }}
                        </p>
                        @endif
                        <a
                            href="{{ route('facilities.detail', $facility->slug) }}"
                            class="th-btn mt-auto"
                        >
                            View Details
                            <i class="fas fa-arrow-up-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">No facilities found.</div>
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $facilities->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
        /* Override grayscale filter for facility images to keep them colored */
        .blog-card .blog-img img {
            filter: none !important;
        }
        .blog-card:hover .blog-img img {
            filter: none !important;
        }
        /* Equal height cards */
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
