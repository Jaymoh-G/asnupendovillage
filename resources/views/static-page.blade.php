@extends('components.layouts.app') @section('title', $page->meta_title ??
$page->getEffectiveTitleAttribute()) @section('meta')
@if($page->meta_description)
<meta name="description" content="{{ $page->meta_description }}" />
@endif @if($page->meta_keywords)
<meta name="keywords" content="{{ $page->meta_keywords }}" />
@endif @endsection @section('content')
<div class="container space-top space-extra-bottom">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="page-content">
                @if($page->featured_image)
                <div class="page-banner mb-5">
                    <img
                        src="{{ asset('storage/' . $page->featured_image) }}"
                        alt="{{ $page->getEffectiveTitleAttribute() }}"
                        class="img-fluid rounded"
                    />
                </div>
                @endif

                <div class="page-header text-center mb-5">
                    <h1 class="page-title">
                        {{ $page->getEffectiveTitleAttribute() }}
                    </h1>
                </div>

                @if($page->content)
                <div class="page-body">{!! $page->content !!}</div>
                @endif @if($page->images && count($page->images) > 0)
                <div class="page-images mt-5">
                    <h3>Gallery</h3>
                    <div class="row g-4">
                        @foreach($page->images as $image)
                        <div class="col-md-4">
                            <div class="image-item">
                                <img
                                    src="{{ asset('storage/'.$image) }}"
                                    alt="{{ $page->getEffectiveTitleAttribute() }}"
                                    class="img-fluid rounded"
                                />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif @if($page->section1_title || $page->section1_content)
                <div class="page-section mt-5">
                    @if($page->section1_title)
                    <h2>{{ $page->section1_title }}</h2>
                    @endif @if($page->section1_content)
                    <div class="section-content">
                        {!! $page->section1_content !!}
                    </div>
                    @endif @if($page->section1_images &&
                    count($page->section1_images) > 0)
                    <div class="section-images mt-3">
                        <div class="row g-3">
                            @foreach($page->section1_images as $image)
                            <div class="col-md-3">
                                <img
                                    src="{{ asset('storage/'.$image) }}"
                                    alt="{{ $page->section1_title }}"
                                    class="img-fluid rounded"
                                />
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif @if($page->section2_title || $page->section2_content)
                <div class="page-section mt-5">
                    @if($page->section2_title)
                    <h2>{{ $page->section2_title }}</h2>
                    @endif @if($page->section2_content)
                    <div class="section-content">
                        {!! $page->section2_content !!}
                    </div>
                    @endif @if($page->section2_images &&
                    count($page->section2_images) > 0)
                    <div class="section-images mt-3">
                        <div class="row g-3">
                            @foreach($page->section2_images as $image)
                            <div class="col-md-3">
                                <img
                                    src="{{ asset('storage/'.$image) }}"
                                    alt="{{ $page->section2_title }}"
                                    class="img-fluid rounded"
                                />
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif @if($page->section3_title || $page->section3_content)
                <div class="page-section mt-5">
                    @if($page->section3_title)
                    <h2>{{ $page->section3_title }}</h2>
                    @endif @if($page->section3_content)
                    <div class="section-content">
                        {!! $page->section3_content !!}
                    </div>
                    @endif @if($page->section3_images &&
                    count($page->section3_images) > 0)
                    <div class="section-images mt-3">
                        <div class="row g-3">
                            @foreach($page->section3_images as $image)
                            <div class="col-md-3">
                                <img
                                    src="{{ asset('storage/'.$image) }}"
                                    alt="{{ $page->section3_title }}"
                                    class="img-fluid rounded"
                                />
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .page-content {
        max-width: 100%;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .page-banner img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
    }

    .page-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    .page-section h2 {
        font-size: 2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #10b981;
        padding-bottom: 0.5rem;
    }

    .section-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    .section-images img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .section-images img:hover {
        transform: scale(1.05);
    }

    .image-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .image-item img:hover {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .page-section h2 {
            font-size: 1.5rem;
        }

        .page-body,
        .section-content {
            font-size: 1rem;
        }
    }
</style>
@endsection
