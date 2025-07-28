<div>
    @section('content')
       <!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb-bg.jpg" data-overlay="theme">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Gallery</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li>Gallery</li>
                </ul>
            </div>
        </div>
    </div><!--==============================
Gallery Area
==============================-->
    <div class="overflow-hidden space">
        <div class="container">
            <div class="row gy-30 gx-30 filter-active">
                @forelse($albums as $album)
                <div class="col-md-6 col-xxl-auto col-lg-4 filter-item">
                    <div class="gallery-card">
                        <div class="gallery-img">
                            @if($album->cover_image_url)
                            <img src="{{ $album->cover_image_url }}" alt="{{ $album->name }}">
                            @else
                            <img src="{{ asset('assets/img/gallery/gallery_1_1.png') }}" alt="{{ $album->name }}">
                            @endif
                            <div class="album-info">
                                <h4 class="album-title">{{ $album->name }}</h4>
                                <span class="photo-count">{{ $album->images->count() }} Photos</span>
                            </div>
                            <a href="{{ route('gallery.album', $album->slug) }}" class="icon-btn">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No albums found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <!--==============================
    @endsection

    <style>
        /* Album information overlay styling */
        .gallery-img {
            position: relative;
        }

        .album-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 20px 15px 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-card:hover .album-info {
            opacity: 1;
        }

        .album-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 5px 0;
            color: white;
        }

        .photo-count {
            font-size: 14px;
            opacity: 0.9;
            color: white;
        }

        /* Ensure images are colored */
        .gallery-img img {
            filter: none !important;
        }

        .gallery-card:hover .gallery-img img {
            filter: none !important;
        }
    </style>
</div>
