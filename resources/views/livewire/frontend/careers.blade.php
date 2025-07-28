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
            margin-top: 10px;
        }
    </style>
    <div class="container space-top space-extra-bottom">
        <div class="row gy-4 gx-4">
            @forelse($careers as $careerItem)
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="box-content">
                        <div class="content-icon-row">
                            <div class="box-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="content-stack">
                                <h3 class="box-title">
                                    {{ \Illuminate\Support\Str::limit($careerItem->title ?? 'Career', 25) }}
                                </h3>
                                <div class="career-meta">
                                    @if($careerItem->location)
                                    <span class="meta-item">
                                        <i
                                            class="fas fa-map-marker-alt me-2"
                                        ></i>
                                        {{ \Illuminate\Support\Str::limit($careerItem->location, 15) }}
                                    </span>
                                    @endif @if($careerItem->type)
                                    <span class="meta-item">
                                        <i class="fas fa-clock me-2"></i>
                                        {{ \Illuminate\Support\Str::limit($careerItem->type, 12) }}
                                    </span>
                                    @endif @if($careerItem->department)
                                    <span class="meta-item">
                                        <i class="fas fa-building me-2"></i>
                                        {{ \Illuminate\Support\Str::limit($careerItem->department, 15) }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a
                            href="{{ route('careers.detail', $careerItem->slug) }}"
                            class="th-btn btn-sm"
                            >View Details
                            <i class="fas fa-arrow-up-right ms-2"></i
                        ></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                No career opportunities available at the moment.
            </div>
            @endforelse
        </div>
    </div>
</div>
