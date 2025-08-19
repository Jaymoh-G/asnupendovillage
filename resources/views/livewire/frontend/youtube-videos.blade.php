<div>
    @section('content')
    <style>
        /* Video card styling */
        .video-card {
            background: var(--white-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.12);
        }

        .video-thumbnail {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: #000;
        }

        .video-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .video-card:hover .video-thumbnail img {
            transform: scale(1.05);
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 0, 0, 0.9);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 24px;
        }

        .play-button:hover {
            background: #ff0000;
            transform: translate(-50%, -50%) scale(1.1);
            color: white;
            text-decoration: none;
        }

        .video-duration {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .video-content {
            padding: 20px;
        }

        .video-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--title-color);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .video-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .video-title a:hover {
            color: var(--theme-color);
        }

        .video-description {
            color: var(--body-color);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .video-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
            color: var(--body-color);
        }

        .video-date {
            color: var(--body-color);
            opacity: 0.8;
        }

        .video-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 10px;
        }

        .video-tag {
            background: rgba(0, 0, 0, 0.05);
            color: var(--body-color);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        /* Search and filter styling */
        .search-filter-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 40px;
            border: 1px solid #e9ecef;
        }

        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--theme-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(26, 104, 91, 0.1);
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 20px;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            background: white;
            color: var(--body-color);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--theme-color);
            color: white;
            border-color: var(--theme-color);
            text-decoration: none;
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

        /* Responsive design */
        @media (max-width: 768px) {
            .search-filter-section {
                padding: 20px;
            }

            .filter-buttons {
                justify-content: center;
            }

            .video-thumbnail {
                height: 180px;
            }
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
                    {{ $pageBanner->title ? $pageBanner->title : 'YouTube Videos' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>
                        {{ $pageBanner->title ? $pageBanner->title : 'YouTube Videos' }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">YouTube Videos</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>YouTube Videos</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!--==============================
YouTube Videos Area
==============================-->
    <div class="container space-top space-extra-bottom">
        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Search videos..."
                        class="search-input w-100"
                    />
                </div>
                <div class="col-lg-6">
                    <div class="filter-buttons">
                        <a
                            href="#"
                            wire:click.prevent="$set('filter', 'all')"
                            class="filter-btn {{
                                $filter === 'all' ? 'active' : ''
                            }}"
                        >
                            All Videos
                        </a>
                        <a
                            href="#"
                            wire:click.prevent="$set('filter', 'featured')"
                            class="filter-btn {{
                                $filter === 'featured' ? 'active' : ''
                            }}"
                        >
                            Featured
                        </a>
                        <a
                            href="#"
                            wire:click.prevent="$set('filter', 'recent')"
                            class="filter-btn {{
                                $filter === 'recent' ? 'active' : ''
                            }}"
                        >
                            Recent
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Videos Grid -->
        <div class="row gy-4 gx-4">
            @forelse($videos as $video)
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img
                            src="{{ $video->thumbnail_url }}"
                            alt="{{ $video->title }}"
                        />
                        <a
                            href="{{ $video->video_url }}"
                            target="_blank"
                            class="play-button"
                        >
                            <i class="fas fa-play"></i>
                        </a>
                        @if($video->duration)
                        <span
                            class="video-duration"
                            >{{ $video->duration }}</span
                        >
                        @endif
                    </div>
                    <div class="video-content">
                        <h3 class="video-title">
                            <a href="{{ $video->video_url }}" target="_blank">
                                {{ \Illuminate\Support\Str::limit($video->title, 50) }}
                            </a>
                        </h3>
                        @if($video->description)
                        <p class="video-description">
                            {{ \Illuminate\Support\Str::limit($video->description, 120) }}
                        </p>
                        @endif
                        <div class="video-meta">
                            @if($video->published_at)
                            <span class="video-date">
                                {{ $video->published_at->format('M d, Y') }}
                            </span>
                            @endif @if($video->is_featured)
                            <span class="badge bg-warning text-dark"
                                >Featured</span
                            >
                            @endif
                        </div>
                        @if(!empty($video->tags_array))
                        <div class="video-tags">
                            @foreach(array_slice($video->tags_array, 0, 3) as
                            $tag)
                            <span class="video-tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-video"></i>
                    <h3>No Videos Found</h3>
                    <p>No YouTube videos are available at the moment.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($videos->hasPages())
        <div class="pagination-wrapper">
            {{ $videos->links('vendor.pagination.bootstrap-4') }}
        </div>
        @endif
    </div>
    @endsection
</div>
