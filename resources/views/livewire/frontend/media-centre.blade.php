        <div>
            @section('content')
    <div class="container space-top space-extra-bottom">
        <div class="row gy-40">
            <!-- Events Section -->
            <div class="col-12">
                <div class="title-area text-center mb-4">
                    <h2 class="sec-title">Events</h2>
                    <a
                        href="{{ url('/events') }}"
                        class="th-btn btn-sm float-end"
                        >View All Events
                        <i class="fas fa-arrow-up-right ms-2"></i
                    ></a>
                </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($events as $event)
                    <div class="col-md-4">
                        <div class="service-card">
                            <div class="box-content">
                                <h3 class="box-title">
                                    {{ $event->title ?? 'Event' }}
                                </h3>
                                <p class="box-text">
                                    {{ \Illuminate\Support\Str::limit($event->description ?? '', 100) }}
                                </p>
                                <a
                                    href="{{ url('/events/' . ($event->slug ?? $event->id)) }}"
                                    class="th-btn btn-sm"
                                    >Read More
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">No events found.</div>
                    @endforelse
                                    </div>
                                </div>
            <!-- News Section -->
            <div class="col-12">
                <div class="title-area text-center mb-4">
                    <h2 class="sec-title">News</h2>
                    <a href="{{ url('/news') }}" class="th-btn btn-sm float-end"
                        >View All News <i class="fas fa-arrow-up-right ms-2"></i
                    ></a>
                                            </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($news as $item)
                    <div class="col-md-4">
                        <div class="service-card">
                            <div class="box-content">
                                <h3 class="box-title">
                                    {{ $item->title ?? 'News' }}
                                </h3>
                                <p class="box-text">
                                    {{ \Illuminate\Support\Str::limit($item->excerpt ?? $item->content ?? '', 100) }}
                                </p>
                                <a
                                    href="{{ url('/news/' . ($item->slug ?? $item->id)) }}"
                                    class="th-btn btn-sm"
                                    >Read More
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                                            </div>
                                        </div>
                                    </div>
                    @empty
                    <div class="col-12 text-center">No news found.</div>
                    @endforelse
                                    </div>
                                </div>
            <!-- Gallery Section -->
            <div class="col-12">
                <div class="title-area text-center mb-4">
                    <h2 class="sec-title">Photo Gallery</h2>
                    <a
                        href="{{ url('/gallery') }}"
                        class="th-btn btn-sm float-end"
                        >View All Photos
                        <i class="fas fa-arrow-up-right ms-2"></i
                    ></a>
                                        </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($gallery as $image)
                    <div class="col-md-4">
                        <div class="service-card">
                            <div class="box-icon mb-2">
                                <img
                                    src="{{ asset('storage/' . ($image->file_path ?? $image->path ?? '')) }}"
                                    alt="Gallery Image"
                                    style="
                                        max-width: 100%;
                                        height: 180px;
                                        object-fit: cover;
                                    "
                                />
                                    </div>
                            <div class="box-content">
                                <h3 class="box-title">
                                    {{ $image->alt_text ?? 'Photo' }}
                                </h3>
                                <a
                                    href="{{ asset('storage/' . ($image->file_path ?? $image->path ?? '')) }}"
                                    class="th-btn btn-sm"
                                    target="_blank"
                                    >View Full
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                            </div>
                                                </div>
                                            </div>
                    @empty
                    <div class="col-12 text-center">No photos found.</div>
                    @endforelse
                                                </div>
                                            </div>
            <!-- Careers Section -->
            <div class="col-12">
                <div class="title-area text-center mb-4">
                    <h2 class="sec-title">Careers</h2>
                    <a
                        href="{{ url('/careers') }}"
                        class="th-btn btn-sm float-end"
                        >View All Careers
                        <i class="fas fa-arrow-up-right ms-2"></i
                    ></a>
                                                </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($careers as $career)
                    <div class="col-md-4">
                        <div class="service-card">
                            <div class="box-content">
                                <h3 class="box-title">
                                    {{ $career->title ?? 'Career' }}
                                </h3>
                                <p class="box-text">
                                    {{ \Illuminate\Support\Str::limit($career->description ?? '', 100) }}
                                </p>
                                <a
                                    href="{{ url('/careers/' . ($career->id)) }}"
                                    class="th-btn btn-sm"
                                    >Read More
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                                                </div>
                                            </div>
                                        </div>
                    @empty
                    <div class="col-12 text-center">No careers found.</div>
                    @endforelse
                                        </div>
                                    </div>
            <!-- Downloads Section -->
            <div class="col-12">
                <div class="title-area text-center mb-4">
                    <h2 class="sec-title">Downloads</h2>
                    <a
                        href="{{ url('/downloads') }}"
                        class="th-btn btn-sm float-end"
                        >View All Downloads
                        <i class="fas fa-arrow-up-right ms-2"></i
                    ></a>
                </div>
                <div class="row gy-4 gx-4 justify-content-center">
                    @forelse($downloads as $download)
                    <div class="col-md-4">
                        <div class="service-card">
                            <div class="box-content">
                                <h3 class="box-title">
                                    {{ $download->title ?? 'Download' }}
                                </h3>
                                <p class="box-text">
                                    {{ \Illuminate\Support\Str::limit($download->description ?? '', 100) }}
                                </p>
                                <a
                                    href="{{ asset('storage/' . $download->file_path) }}"
                                    class="th-btn btn-sm"
                                    target="_blank"
                                    >Download
                                    <i class="fas fa-download ms-2"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">No downloads found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endsection
        </div>
