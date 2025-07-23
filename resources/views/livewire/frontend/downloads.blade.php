<div>
    Breadcumb ============================== -->
    <div
        class="breadcumb-wrapper"
        data-bg-src="assets/img/bg/breadcumb-bg.jpg"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Downloads</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Downloads</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container space-top space-extra-bottom">
        <div class="row mb-4 justify-content-center">
            <div class="col-md-12 text-center">
                <div class="btn-group" role="group" aria-label="Program Filter">
                    <a
                        href="{{ route('downloads') }}"
                        class="th-btn btn-sm mb-2 mx-1 {{
                            !$selectedProgram ? 'active' : ''
                        }}"
                        >All Programs</a
                    >
                    @foreach($programs as $program)
                    <a
                        href="{{ route('downloads.by-program', $program->slug) }}"
                        class="th-btn btn-sm mb-2 mx-1 {{ $selectedProgram == $program->id ? 'active' : '' }}"
                        >{{ $program->title }}</a
                    >
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row gy-4 gx-4 justify-content-center">
            @forelse($downloads as $download)
            <div class="col-6 col-md-4 col-lg-3">
                <div
                    class="service-card h-100 d-flex flex-column justify-content-between p-2"
                    style="min-height: 180px"
                >
                    <div class="box-content">
                        <h3
                            class="box-title"
                            style="
                                font-size: 1rem;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                max-width: 100%;
                            "
                        >
                            {{ \Illuminate\Support\Str::limit($download->title ?? 'Download', 22) }}
                        </h3>
                        <p
                            class="box-text mb-1"
                            style="
                                font-size: 0.9rem;
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                            "
                        >
                            {{ \Illuminate\Support\Str::limit($download->description ?? '', 90) }}
                        </p>

                        @if($download->file_size)
                        <div class="small text-muted mb-2">
                            Size:
                            {{ number_format($download->file_size / 1048576, 2) }}
                            MB
                        </div>
                        @endif
                        <a
                            href="{{ asset('storage/' . $download->file_path) }}"
                            class="th-btn btn-xs mt-2"
                            target="_blank"
                            >View <i class="fas fa-download ms-2"></i
                        ></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">No downloads found.</div>
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $downloads->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
