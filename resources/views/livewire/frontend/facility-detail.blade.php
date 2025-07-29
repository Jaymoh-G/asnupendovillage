<div>
    <!-- Banner Section -->
    @if($pageBanner)
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner->effective_banner_url }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                    {{ $pageBanner->title ?? 'Facility Details' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('facilities') }}">Facilities</a></li>
                    <li>{{ $facility->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Facility Details Section -->
    <section class="donation-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <div class="page-img">
                        @if($facility->image_url)
                        <img
                            src="{{ $facility->image_url }}"
                            alt="{{ $facility->name }}"
                            style="filter: none !important"
                        />
                        @else
                        <img
                            src="{{
                                asset('assets/img/service/service_card_1_1.png')
                            }}"
                            alt="{{ $facility->name }}"
                        />
                        @endif @if($facility->program)
                        <div class="tag">{{ $facility->program->title }}</div>
                        @endif
                    </div>
                    <div class="blog-content">
                        <h2 class="h3 page-title mt-n2">
                            {{ $facility->name }}
                        </h2>

                        @if($facility->description)
                        <p class="mb-35">{{ $facility->description }}</p>
                        @endif

                        <div class="donation-progress-wrap mb-55">
                            <div class="media-left">
                                <div class="progress">
                                    <div
                                        class="progress-bar"
                                        style="width: {{ $facility->status === 'active' ? '100' : '50' }}%;"
                                    >
                                        <div class="progress-value">
                                            {{ $facility->status === 'active' ? '100' : '50'

                                            }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="donation-progress-content">
                                    <span class="donation-card_raise"
                                        >Status:
                                        <span
                                            class="donation-card_raise-number"
                                            >{{ ucfirst($facility->status) }}</span
                                        ></span
                                    >
                                    @if($facility->capacity)
                                    <span class="donation-card_goal"
                                        >Capacity:
                                        <span class="donation-card_goal-number"
                                            >{{ $facility->capacity }}
                                            people</span
                                        ></span
                                    >
                                    @endif
                                </div>
                            </div>
                            <div class="btn-wrap">
                                <a
                                    class="th-btn"
                                    href="{{ route('facilities') }}"
                                    >View All Facilities
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                            </div>
                        </div>

                        @if($facility->program)
                        <h3 class="mb-15">About The Program</h3>
                        <p class="mb-45">
                            This facility is part of our
                            {{ $facility->program->title }} program, designed to
                            provide essential services and support to our
                            community. Our dedicated team works tirelessly to
                            ensure this facility meets the highest standards of
                            quality and accessibility.
                        </p>
                        @endif

                        <h3 class="mb-15">Facility Features</h3>
                        <p class="mb-45">
                            Our facility is equipped with modern amenities and
                            is staffed by trained professionals who are
                            committed to providing excellent service. We
                            maintain high standards of cleanliness and safety to
                            ensure a comfortable environment for all users.
                        </p>

                        <h3 class="mb-15">Accessibility</h3>
                        <p class="mb-35">
                            We are committed to making our facilities accessible
                            to everyone. Our facility is designed to accommodate
                            individuals with different needs and abilities,
                            ensuring that all members of our community can
                            benefit from our services.
                        </p>

                        <div class="row gx-40 gy-30 align-items-center">
                            <div class="col-xl-6">
                                <div class="page-img mb-0">
                                    @if($facility->image_url)
                                    <img
                                        src="{{ $facility->image_url }}"
                                        alt="{{ $facility->name }}"
                                        style="filter: none !important"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/service/service_card_1_2.png'
                                            )
                                        }}"
                                        alt="{{ $facility->name }}"
                                    />
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="checklist">
                                    <ul>
                                        <li>
                                            <i class="fas fa-check"></i>Modern
                                            and well-maintained facilities
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i>Trained
                                            and professional staff
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i>Safe and
                                            secure environment
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Accessible to all community members
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i>Regular
                                            maintenance and updates
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Emergency response protocols
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Community-focused services
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <p class="mb-40 mt-30">
                            Our facility is more than just a building - it's a
                            hub of community activity and support. We regularly
                            host events, workshops, and programs that bring
                            people together and strengthen our community bonds.
                            Your support helps us maintain and improve these
                            essential community resources.
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
                                    @if($facility->program &&
                                    $facility->program->image_url)
                                    <img
                                        src="{{ $facility->program->image_url }}"
                                        alt="{{ $facility->program->title }}"
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
                                            >{{ $facility->program->title ?? 'General' }}</a
                                        >
                                    </h4>
                                    <span class="meta">
                                        <a href="#"
                                            ><i class="fas fa-building"></i
                                            >Facility</a
                                        >
                                    </span>
                                    @if($facility->capacity)
                                    <span class="meta">
                                        <a href="#"
                                            ><i class="fas fa-users"></i
                                            >Capacity:
                                            {{ $facility->capacity }}</a
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
                                <div class="donate-price">
                                    {{ ucfirst($facility->status) }}
                                </div>
                                <h4 class="title">Facility Status</h4>
                                <a
                                    class="th-btn"
                                    href="{{ route('facilities') }}"
                                    >View All Facilities</a
                                >
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
                            <h3 class="widget_title">Other Facilities</h3>
                            <div class="recent-donate-wrap">
                                @foreach($otherFacilities as $otherFacility)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a
                                            href="{{ route('facilities.detail', $otherFacility->slug) }}"
                                        >
                                            @if($otherFacility->image_url)
                                            <img
                                                src="{{ $otherFacility->image_url }}"
                                                alt="{{ $otherFacility->name }}"
                                                style="filter: none !important"
                                            />
                                            @else
                                            <img
                                                src="{{
                                                    asset(
                                                        'assets/img/widget/donor_1_1.jpg'
                                                    )
                                                }}"
                                                alt="{{ $otherFacility->name }}"
                                            />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title">
                                            <a
                                                class="text-inherit"
                                                href="{{ route('facilities.detail', $otherFacility->slug) }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($otherFacility->name, 25) }}
                                            </a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            @if($otherFacility->program)
                                            <a
                                                href="#"
                                                >{{ $otherFacility->program->title }}</a
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
