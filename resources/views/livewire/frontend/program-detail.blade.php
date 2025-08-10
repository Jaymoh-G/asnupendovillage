<div>
    <!-- Banner Section -->
    @if($pageBanner && $pageBanner->effective_banner_url)
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner->effective_banner_url }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                    {{ $pageBanner->title ?? 'Program Details' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('programs') }}">Programs</a></li>
                    <li>{{ $program->title }}</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Program Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('programs') }}">Programs</a></li>
                    <li>{{ $program->title }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Program Details Section -->
    <section class="donation-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <div class="page-img">
                        @if($program->image_url)
                        <img
                            src="{{ $program->image_url }}"
                            alt="{{ $program->title }}"
                            style="filter: none !important"
                        />
                        @else
                        <img
                            src="{{
                                asset('assets/img/service/service_card_1_1.png')
                            }}"
                            alt="{{ $program->title }}"
                        />
                        @endif
                        <div class="tag">Program</div>
                    </div>
                    <div class="blog-content">
                        <h2 class="h3 page-title mt-n2">
                            {{ $program->title }}
                        </h2>

                        @if($program->content)
                        <p class="mb-35">{{ $program->content }}</p>
                        @endif

                        <div class="donation-progress-wrap mb-55">
                            <div class="media-left">
                                @if($program->featured)
                                <div class="donation-progress-content">
                                    <span class="donation-card_goal"
                                        >Featured:
                                        <span class="donation-card_goal-number"
                                            >Yes</span
                                        ></span
                                    >
                                </div>
                                @endif
                            </div>
                            <div class="btn-wrap">
                                <a class="th-btn" href="{{ route('programs') }}"
                                    >View All Programs
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                            </div>
                        </div>

                        <h3 class="mb-15">About This Program</h3>
                        <p class="mb-45">
                            {{ $program->content ?? 'This program is designed to provide essential services and support to our community. Our dedicated team works tirelessly to ensure this program meets the highest standards of quality and effectiveness.' }}
                        </p>

                        <h3 class="mb-15">Program Objectives</h3>
                        <p class="mb-45">
                            Our program focuses on delivering measurable
                            outcomes and creating lasting positive impact in the
                            communities we serve. We maintain high standards of
                            excellence and continuously evaluate our
                            effectiveness.
                        </p>

                        <h3 class="mb-15">Impact & Results</h3>
                        <p class="mb-35">
                            We are committed to transparency and accountability
                            in all our programs. Regular monitoring and
                            evaluation ensure that we achieve our goals and make
                            a meaningful difference in people's lives.
                        </p>

                        <div class="row gx-40 gy-30 align-items-center">
                            <div class="col-xl-6">
                                <div class="page-img mb-0">
                                    @if($program->image_url)
                                    <img
                                        src="{{ $program->image_url }}"
                                        alt="{{ $program->title }}"
                                        style="filter: none !important"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/service/service_card_1_2.png'
                                            )
                                        }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="checklist">
                                    <ul>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Evidence-based program design
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Professional staff and volunteers
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i>Regular
                                            monitoring and evaluation
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Community-focused approach
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Sustainable impact creation
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Transparent reporting
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Continuous improvement
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <p class="mb-40 mt-30">
                            Our program is more than just a service - it's a
                            commitment to positive change and community
                            development. We regularly assess our impact and
                            adapt our approaches to ensure maximum effectiveness
                            and reach.
                        </p>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area donation-sidebar">
                        <div
                            class="widget"
                            data-bg-src="{{
                                asset('assets/img/bg/gray-bg2.png')
                            }}"
                            data-overlay="gray"
                            data-opacity="5"
                        >
                            <div class="author-widget-wrap">
                                <div class="author-tag">Program:</div>
                                <div class="avater">
                                    @if($program->image_url)
                                    <img
                                        src="{{ $program->image_url }}"
                                        alt="{{ $program->title }}"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/blog/blog-author.jpg'
                                            )
                                        }}"
                                        alt="Program"
                                    />
                                    @endif
                                </div>
                                <div class="author-info">
                                    <h4 class="name">
                                        <a
                                            class="text-inherit"
                                            href="#"
                                            >{{ $program->title }}</a
                                        >
                                    </h4>
                                    <span class="meta">
                                        <a href="#"
                                            ><i class="fas fa-tags"></i
                                            >Program</a
                                        >
                                    </span>
                                    @if($program->featured)
                                    <span class="meta">
                                        <a href="#"
                                            ><i class="fas fa-star"></i>Featured
                                            Program</a
                                        >
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div
                            class="widget"
                            data-bg-src="{{
                                asset('assets/img/bg/gray-bg2.png')
                            }}"
                            data-overlay="gray"
                            data-opacity="5"
                        >
                            <div class="widget-donation-wrap">
                                <div class="btn-wrap">
                                    <a
                                        class="th-btn"
                                        href="{{ route('programs') }}"
                                        >View All Programs</a
                                    >
                                </div>
                            </div>
                        </div>
                        <div
                            class="widget"
                            data-bg-src="{{
                                asset('assets/img/bg/gray-bg2.png')
                            }}"
                            data-overlay="gray"
                            data-opacity="5"
                        >
                            <h3 class="widget_title">Other Programs</h3>
                            <div class="recent-donate-wrap">
                                @foreach($otherPrograms as $otherProgram)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a
                                            href="{{ route('programs.detail', $otherProgram->slug) }}"
                                        >
                                            @if($otherProgram->image_url)
                                            <img
                                                src="{{ $otherProgram->image_url }}"
                                                alt="{{ $otherProgram->title }}"
                                                style="filter: none !important"
                                            />
                                            @else
                                            <img
                                                src="{{
                                                    asset(
                                                        'assets/img/widget/donor_1_1.jpg'
                                                    )
                                                }}"
                                                alt="{{ $otherProgram->title }}"
                                            />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title">
                                            <a
                                                class="text-inherit"
                                                href="{{ route('programs.detail', $otherProgram->slug) }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($otherProgram->title, 25) }}
                                            </a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            @if($otherProgram->featured)
                                            <a href="#"
                                                ><i class="fas fa-star"></i>
                                                Featured</a
                                            >
                                            @else
                                            <a href="#"
                                                ><i class="fas fa-tags"></i>
                                                Program</a
                                            >
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <style>
        .page-img img {
            transition: transform 0.3s ease;
        }
        .page-img img:hover {
            transform: scale(1.02);
        }
        .checklist ul li {
            margin-bottom: 10px;
        }
        .checklist ul li i {
            color: #28a745;
            margin-right: 10px;
        }
        .donation-progress-wrap {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            border-left: 4px solid #007bff;
        }
        .progress {
            height: 25px;
            background-color: #e9ecef;
            border-radius: 15px;
            overflow: hidden;
        }
        .progress-bar {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border-radius: 15px;
            position: relative;
        }
        .progress-value {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-weight: bold;
            font-size: 12px;
        }
        .donation-progress-content {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-weight: 600;
        }
        .donation-card_raise-number,
        .donation-card_goal-number {
            color: #007bff;
        }
        .recent-post {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }
        .recent-post:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .media-img {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 8px;
            overflow: hidden;
        }
        .media-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .post-title {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .recent-post-meta a {
            color: #6c757d;
            font-size: 12px;
        }
    </style>
</div>
