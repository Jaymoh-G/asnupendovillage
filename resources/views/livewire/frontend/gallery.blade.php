<div>
    @section('content')
    <style>
        /* Override grayscale filter for gallery images */
        .gallery-section .gallery-card .gallery-img img {
            filter: none !important;
        }
        .gallery-section .gallery-card:hover .gallery-img img {
            filter: none !important;
        }

        /* Album card styling */
        .album-card {
            background: var(--white-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .album-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.12);
        }

        .album-img {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .album-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .album-card:hover .album-img img {
            transform: scale(1.05);
        }

        .album-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .album-card:hover .album-overlay {
            opacity: 1;
        }

        .album-overlay .icon-btn {
            background: var(--theme-color);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .album-overlay .icon-btn:hover {
            background: var(--theme-color2);
            transform: scale(1.1);
        }

        .album-content {
            padding: 20px;
        }

        .album-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--title-color);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .album-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .album-title a:hover {
            color: var(--theme-color);
        }

        .album-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            color: var(--body-color);
        }

        .album-count {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(0, 0, 0, 0.05);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .album-count i {
            color: var(--theme-color);
        }

        .album-date {
            color: var(--body-color);
            opacity: 0.8;
        }

        /* Pagination styling */
        .pagination-wrapper {
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 5px;
        }

        .pagination li {
            margin: 0;
        }

        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            background: var(--white-color);
            color: var(--title-color);
            text-decoration: none;
            font-weight: 600;
            border: 2px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover,
        .pagination .page-item.active .page-link {
            background: var(--theme-color);
            color: white;
            border-color: var(--theme-color);
        }

        .pagination .page-item.disabled .page-link {
            background: rgba(0, 0, 0, 0.05);
            color: rgba(0, 0, 0, 0.3);
            cursor: not-allowed;
        }

        /* Override default pagination styles */
        .pagination nav {
            display: contents;
        }

        .pagination ul {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 5px;
        }

        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 64px;
            color: #ccc;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: var(--title-color);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--body-color);
            opacity: 0.8;
        }
    </style>

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
                    {{ $pageBanner->title ? $pageBanner->title : 'Gallery' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>
                        {{ $pageBanner->title ? $pageBanner->title : 'Gallery' }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Gallery</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Gallery</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!--==============================
Gallery Area
==============================-->
    <div class="container space-top space-extra-bottom">
        <div class="row gy-4 gx-4">
            @forelse($albums as $album)
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="album-card">
                    <div class="album-img">
                        @if($album->cover_image_url)
                        <img
                            src="{{ $album->cover_image_url }}"
                            alt="{{ $album->name }}"
                        />
                        @else
                        <img
                            src="{{
                                asset('assets/img/gallery/gallery_1_1.png')
                            }}"
                            alt="{{ $album->name }}"
                        />
                        @endif
                        <div class="album-overlay">
                            <a
                                href="{{ route('gallery.album', $album->slug) }}"
                                class="icon-btn"
                            >
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="album-content">
                        <h3 class="album-title">
                            <a
                                href="{{ route('gallery.album', $album->slug) }}"
                            >
                                {{ \Illuminate\Support\Str::limit($album->name, 30) }}
                            </a>
                        </h3>
                        <div class="album-meta">
                            <span class="album-count">
                                <i class="fas fa-images"></i>
                                {{ $album->images->count() }} Photos
                            </span>
                            <span class="album-date">
                                {{ $album->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-images"></i>
                    <h3>No Albums Found</h3>
                    <p>No photo albums are available at the moment.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($albums->hasPages())
        <div class="pagination-wrapper">
            {{ $albums->links('vendor.pagination.bootstrap-4') }}
        </div>
        @endif
    </div>
    @endsection
</div>
