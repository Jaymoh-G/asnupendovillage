<div>
    <style>
        /* Enhanced styling for downloads feature cards */
        .feature-card {
            background: var(--white-color);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.12);
        }

        .box-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(
                135deg,
                var(--theme-color),
                var(--theme-color2)
            );
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            flex-shrink: 0;
        }

        .box-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 0;
            color: var(--title-color);
            text-align: left;
        }

        .download-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            flex-shrink: 0;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            font-size: 13px;
            color: var(--body-color);
            background: rgba(0, 0, 0, 0.05);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .meta-item i {
            color: var(--theme-color);
        }

        /* Content and icon side by side layout */
        .content-icon-row {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
        }

        .content-stack {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .content-stack .download-meta {
            margin-bottom: 0;
        }

        /* Ensure uniform card heights */
        .feature-card {
            display: flex;
            flex-direction: column;
        }

        .box-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .th-btn {
            margin-top: 10px;
        }

        /* Reduce breadcrumb banner area by half */
        .breadcumb-wrapper {
            min-height: 200px !important;
            padding: 40px 0 !important;
        }

        .breadcumb-wrapper .breadcumb-content {
            padding: 20px 0 !important;
        }

        .breadcumb-wrapper .breadcumb-title {
            font-size: 2rem !important;
            margin-bottom: 10px !important;
        }

        .breadcumb-wrapper .breadcumb-menu {
            margin-bottom: 0 !important;
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
                    {{ $pageBanner->title ? $pageBanner->title : 'Downloads' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Downloads</li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    <div class="container space-top space-extra-bottom">
        @if(!$pageBanner || !$pageBanner->effective_banner_url)
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="h2 mb-3">Downloads</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Downloads</li>
                    </ol>
                </nav>
            </div>
        </div>
        @endif @if($programs->count() > 0)
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
        @endif
        <div class="row gy-4 gx-4">
            @forelse($downloads as $download)
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="box-content">
                        <div class="content-icon-row">
                            <div class="box-icon">
                                @php $fileExtension =
                                pathinfo($download->file_path,
                                PATHINFO_EXTENSION); $iconClass = 'fas fa-file';
                                if (in_array(strtolower($fileExtension),
                                ['pdf'])) { $iconClass = 'fas fa-file-pdf'; }
                                elseif (in_array(strtolower($fileExtension),
                                ['doc', 'docx'])) { $iconClass = 'fas
                                fa-file-word'; } elseif
                                (in_array(strtolower($fileExtension), ['xls',
                                'xlsx'])) { $iconClass = 'fas fa-file-excel'; }
                                elseif (in_array(strtolower($fileExtension),
                                ['ppt', 'pptx'])) { $iconClass = 'fas
                                fa-file-powerpoint'; } elseif
                                (in_array(strtolower($fileExtension), ['jpg',
                                'jpeg', 'png', 'gif'])) { $iconClass = 'fas
                                fa-file-image'; } @endphp
                                <i class="{{ $iconClass }}"></i>
                            </div>
                            <div class="content-stack">
                                <h3 class="box-title">
                                    {{ \Illuminate\Support\Str::limit($download->title ?? 'Download', 25) }}
                                </h3>
                                <div class="download-meta">
                                    @if($download->program)
                                    <span class="meta-item">
                                        <i class="fas fa-folder me-2"></i>
                                        {{ \Illuminate\Support\Str::limit($download->program->title ?? 'General', 15) }}
                                    </span>
                                    @endif @if($download->file_size)
                                    <span class="meta-item">
                                        <i class="fas fa-weight me-2"></i>
                                        {{ number_format($download->file_size / 1048576, 1)





                                        }}MB
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a
                            href="{{ asset('storage/' . $download->file_path) }}"
                            class="th-btn btn-sm"
                            target="_blank"
                            >Download <i class="fas fa-download ms-2"></i
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
