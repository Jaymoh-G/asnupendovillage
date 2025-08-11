<div>
    <style>
        /* Enhanced styling for careers feature cards */
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

        .career-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            flex-shrink: 0;
            margin-bottom: 15px;
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

        .deadline-meta-item {
            max-width: 180px !important;
        }

        .meta-item i {
            color: var(--theme-color);
            margin-right: 5px;
        }

        .career-description {
            color: var(--body-color);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .deadline-meta-item {
            color: var(--body-color);
            font-size: 13px;
            font-weight: 500;
        }

        .deadline-meta-item.urgent {
            color: #ff4757;
            font-weight: 600;
            animation: pulse 2s infinite;
        }

        .pdf-meta-item {
            background: linear-gradient(135deg, #2ed573, #1e90ff) !important;
            color: white !important;
            padding: 5px 10px !important;
            min-width: auto !important;
            max-width: none !important;
        }

        .pdf-meta-item a {
            color: white !important;
            text-decoration: none;
        }

        .pdf-meta-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(46, 213, 115, 0.3);
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

        .content-stack .career-meta {
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
            margin-top: auto;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
    <div class="container space-top space-extra-bottom">
        <div class="row gy-4 gx-4">
            @forelse($careers as $careerItem)
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="box-content">
                        <div class="content-icon-row">
                            <div class="box-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="content-stack">
                                <h3 class="box-title">
                                    {{ \Illuminate\Support\Str::limit($careerItem->title ?? 'Career', 30) }}
                                </h3>
                                <div class="career-meta">
                                    @if($careerItem->type)
                                    <span class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        {{ ucfirst(str_replace('-', ' ', $careerItem->type)) }}
                                    </span>
                                    @endif @if($careerItem->pdf_file)
                                    <span class="meta-item pdf-meta-item">
                                        <a
                                            href="{{ $careerItem->pdf_url }}"
                                            target="_blank"
                                            title="View Job Description PDF"
                                        >
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    </span>
                                    @endif @if($careerItem->application_deadline
                                    &&
                                    !$careerItem->application_deadline->isPast())
                                    <span class="meta-item deadline-meta-item">
                                        @if($careerItem->application_deadline->diffInDays(now())
                                        <= 7) Apply by
                                        {{ $careerItem->application_deadline->format('M d') }}
                                        @else
                                        {{ $careerItem->application_deadline->format('M d, Y') }}
                                        @endif
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($careerItem->description)
                        <div class="career-description">
                            {{ \Illuminate\Support\Str::limit($careerItem->description, 120) }}
                        </div>
                        @endif

                        <a
                            href="{{ route('careers.detail', $careerItem->slug ?? $careerItem->id) }}"
                            class="th-btn btn-sm"
                            >View Details
                            <i class="fas fa-arrow-up-right ms-2"></i
                        ></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="py-5">
                    <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">
                        No Career Opportunities Available
                    </h4>
                    <p class="text-muted">
                        Please check back later for new job openings.
                    </p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
