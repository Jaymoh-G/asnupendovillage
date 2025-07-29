<div>


    <!-- Banner Section -->
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner ? $pageBanner->effective_banner_url : '' }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                   {{ $album->name }} Album
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('gallery') }}">{{ $album->name }} Album</a></li>
                    <li>{{ $album->name }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container space-extra-bottom">

        <!-- Gallery Grid -->
        <div class="overflow-hidden space">
            <div class="container">
                <div class="row gy-30 gx-30 filter-active">
                    @forelse($album->images as $image)
                    <div class="col-sm-6 col-md-4 filter-item">
                        <div class="gallery-card">
                            <div class="gallery-img">
                                <img
                                    src="{{ asset('storage/' . $image->path) }}"
                                    alt="{{ $image->alt_text ?? 'Gallery Image' }}"
                                />
                                <a
                                    href="{{ asset('storage/' . $image->path) }}"
                                    class="icon-btn popup-image"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <div class="empty-state">
                            <i
                                class="fas fa-images"
                                style="
                                    font-size: 48px;
                                    color: #ccc;
                                    margin-bottom: 20px;
                                "
                            ></i>
                            <h3>No Images Found</h3>
                            <p>This album doesn't contain any images yet.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
        <style>
        /* Override grayscale filter for gallery images */
        .gallery-section .gallery-card .gallery-img img {
            filter: none !important;
        }
        .gallery-section .gallery-card:hover .gallery-img img {
            filter: none !important;
        }

        /* Album info styling */
        .album-header {
            background: var(--white-color);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .album-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--title-color);
            margin-bottom: 15px;
        }

        .album-description {
            color: var(--body-color);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .album-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            color: var(--body-color);
            background: rgba(0, 0, 0, 0.05);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 500;
        }

        .meta-item i {
            color: var(--theme-color);
            margin-right: 8px;
        }

        .back-to-gallery {
            margin-bottom: 30px;
        }

        .back-to-gallery .th-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Gallery grid styling for 3-column layout */
        .gallery-card {
            background: var(--white-color);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .gallery-card:hover {
            transform: translateY(-3px);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
        }

        .gallery-img {
            position: relative;
            aspect-ratio: 4/3;
            overflow: hidden;
        }

        .gallery-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-card:hover .gallery-img img {
            transform: scale(1.05);
        }

        .gallery-img .icon-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--theme-color);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-card:hover .gallery-img .icon-btn {
            opacity: 1;
        }

        .gallery-img .icon-btn:hover {
            background: var(--theme-color2);
            transform: translate(-50%, -50%) scale(1.1);
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .gallery-img {
                aspect-ratio: 3/2;
            }
        }
    </style>
</div>
