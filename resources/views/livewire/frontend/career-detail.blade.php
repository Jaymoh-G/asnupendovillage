<div>
    <!-- Page Banner -->
    @if($pageBanner)
    <div
        class="page-banner"
        style="background-image: url('{{ $pageBanner->image_url }}');"
    >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner-content text-center">
                        <h1 class="banner-title">{{ $career->title }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('careers') }}">Careers</a>
                                </li>
                                <li
                                    class="breadcrumb-item active"
                                    aria-current="page"
                                >
                                    {{ $career->title }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="container space-top space-extra-bottom">
        <div class="row">
            <div class="col-lg-8">
                <div class="service-card">
                    <div class="box-content">
                        <h1 class="career-title">{{ $career->title }}</h1>

                        <!-- Career Meta Information -->
                        <div class="career-meta-detail mb-4">
                            @if($career->type)
                            <span class="meta-badge">
                                <i class="fas fa-clock me-2"></i>
                                {{ ucfirst(str_replace('-', ' ', $career->type)) }}
                            </span>
                            @endif @if($career->application_deadline &&
                            !$career->application_deadline->isPast())
                            <span
                                class="meta-badge deadline-badge {{
                                $career->application_deadline->diffInDays(now()) <= 7 ? 'urgent' : ''
                            }}"
                            >
                                <i class="fas fa-calendar-alt me-2"></i>
                                @if($career->application_deadline->diffInDays(now())
                                <= 7) Apply by
                                {{ $career->application_deadline->format('M d, Y') }}
                                @else Deadline:
                                {{ $career->application_deadline->format('M d, Y') }}
                                @endif
                            </span>
                            @endif
                        </div>

                        <!-- Rich Content -->
                        @if($career->content)
                        <div class="career-content mb-4">
                            <h5>Job Description</h5>
                            <div class="content-html">
                                {!! $career->content !!}
                            </div>
                        </div>
                        @endif

                        <hr />

                        <!-- Application Section -->
                        <div class="application-section">
                            <h5>How to Apply</h5>
                            @if($career->contact_email)
                            <a
                                href="mailto:{{ $career->contact_email }}?subject=Application for {{ urlencode($career->title) }}"
                                class="th-btn btn-lg me-3"
                            >
                                <i class="fas fa-envelope me-2"></i>
                                Apply via Email
                            </a>
                            @endif @if($career->pdf_file)
                            <a
                                href="{{ $career->pdf_url }}"
                                target="_blank"
                                class="th-btn th-btn-outline btn-lg"
                            >
                                <i class="fas fa-file-pdf me-2"></i>
                                View Job Description
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-widgets">
                    <!-- Quick Actions -->
                    <div class="th-widget">
                        <h4 class="widget-title">Quick Actions</h4>
                        <div class="widget-content">
                            <a
                                href="{{ route('careers') }}"
                                class="th-btn btn-sm w-100 mb-2"
                            >
                                <i class="fas fa-arrow-left me-2"></i>
                                Back to Careers
                            </a>
                            <a
                                href="{{ route('contact-us') }}"
                                class="th-btn th-btn-outline btn-sm w-100"
                            >
                                <i class="fas fa-question-circle me-2"></i>
                                Contact HR
                            </a>
                        </div>
                    </div>

                    <!-- Career Details -->
                    <div class="th-widget">
                        <h4 class="widget-title">Position Details</h4>
                        <div class="widget-content">
                            @if($career->type)
                            <div class="detail-item">
                                <strong>Employment Type:</strong>
                                <span
                                    class="employment-type-badge"
                                    >{{ ucfirst(str_replace('-', ' ', $career->type)) }}</span
                                >
                            </div>
                            @endif @if($career->application_deadline)
                            <div class="detail-item">
                                <strong>Application Deadline:</strong>
                                <span
                                    class="text-{{ $career->application_deadline->isPast() ? 'danger' : 'success' }}"
                                >
                                    {{ $career->application_deadline->format('M d, Y') }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .page-banner {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 80px 0;
            position: relative;
            color: white;
        }

        .page-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .banner-content {
            position: relative;
            z-index: 2;
        }

        .banner-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: white;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.6);
        }

        .career-meta-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
            justify-content: center;
        }

        .meta-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(var(--theme-color-rgb, 0, 0, 0), 0.05);
            color: var(--body-color);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .deadline-badge {
            background: var(--theme-color);
            color: white;
        }

        .deadline-badge.urgent {
            background: var(--theme-color2);
            animation: pulse 2s infinite;
        }

        .career-title {
            font-size: 36px;
            font-weight: 700;
            color: var(--title-color);
            margin-bottom: 25px;
            line-height: 1.2;
        }

        .career-content h5,
        .pdf-download h5,
        .application-section h5 {
            color: var(--title-color);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .content-html {
            line-height: 1.6;
            color: var(--body-color);
        }

        .pdf-download-btn {
            display: inline-flex;
            align-items: center;
            background: var(--theme-color);
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pdf-download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(var(--theme-color-rgb, 0, 0, 0), 0.3);
            color: white;
        }

        .application-section {
            background: rgba(var(--theme-color-rgb, 0, 0, 0), 0.02);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid rgba(var(--theme-color-rgb, 0, 0, 0), 0.1);
        }

        .sidebar-widgets {
            position: sticky;
            top: 20px;
        }

        .th-widget {
            background: var(--white-color);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .th-widget:last-child {
            margin-bottom: 0;
        }

        .widget-title {
            color: var(--title-color);
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 18px;
            position: relative;
            padding-bottom: 15px;
        }

        .widget-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(
                135deg,
                var(--theme-color),
                var(--theme-color2)
            );
            border-radius: 2px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item strong {
            color: var(--title-color);
            font-size: 14px;
        }

        .detail-item a {
            color: var(--theme-color);
            text-decoration: none;
        }

        .detail-item a:hover {
            color: var(--theme-color2);
        }

        .employment-type-badge {
            background: var(--theme-color);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
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
</div>
