<div>
    <!--==============================
    Breadcumb
============================== -->
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ asset('assets/img/bg/breadcumb-bg.jpg') }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Project Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li>{{ $project->name }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!--==============================
    Project Details Area
==============================-->
    <section class="donation-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <div class="page-img">
                        @if($project->image_url)
                        <img
                            src="{{ $project->image_url }}"
                            alt="{{ $project->name }}"
                        />
                        @else
                        <img
                            src="{{
                                asset('assets/img/donation/donation-s-1-1.png')
                            }}"
                            alt="{{ $project->name }}"
                        />
                        @endif
                        <div class="tag">
                            {{ $project->program->title ?? 'General' }}
                        </div>
                    </div>
                    <div class="blog-content">
                        <h2 class="h3 page-title mt-n2">
                            {{ $project->name }}
                        </h2>
                        <p class="mb-35">{{ $project->description }}</p>

                        <div class="donation-progress-wrap mb-55">
                            <div class="media-left">
                                <div class="progress">
                                    <div
                                        class="progress-bar"
                                        style="width: 75%"
                                    >
                                        <div class="progress-value">75%</div>
                                    </div>
                                </div>
                                <div class="donation-progress-content">
                                    <span class="donation-card_raise"
                                        >Status:
                                        <span
                                            class="donation-card_raise-number"
                                            >{{ ucfirst($project->status) }}</span
                                        ></span
                                    >
                                    <span class="donation-card_goal"
                                        >Program:
                                        <span
                                            class="donation-card_goal-number"
                                            >{{ $project->program->title ?? 'General' }}</span
                                        ></span
                                    >
                                </div>
                            </div>
                            <div class="btn-wrap">
                                <a
                                    class="th-btn"
                                    href="{{ route('donate-now') }}"
                                    >Support This Project
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                            </div>
                        </div>

                        <h3 class="mb-15">About The Project</h3>
                        <p class="mb-45">{{ $project->description }}</p>

                        <h3 class="mb-15">Project Summary</h3>
                        <p class="mb-45">
                            This project is part of our ongoing efforts to make
                            a positive impact in the community. Through
                            dedicated work and community support, we aim to
                            achieve meaningful results that benefit everyone
                            involved.
                        </p>

                        <h3 class="mb-15">Project Challenge</h3>
                        <p class="mb-35">
                            Every project comes with its own set of challenges.
                            We work diligently to overcome obstacles and ensure
                            successful project completion while maintaining the
                            highest standards of quality and community benefit.
                        </p>

                        <div class="row gx-40 gy-30 align-items-center">
                            <div class="col-xl-6">
                                <div class="page-img mb-0">
                                    @if($project->image_url)
                                    <img
                                        src="{{ $project->image_url }}"
                                        alt="{{ $project->name }}"
                                    />
                                    @else
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/donation/donation-s-1-2.png'
                                            )
                                        }}"
                                        alt="{{ $project->name }}"
                                    />
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="checklist">
                                    <ul>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Community-focused approach
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Sustainable development goals
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Transparent project management
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i>Regular
                                            progress updates
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i>Quality
                                            assurance measures
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i
                                            >Stakeholder engagement
                                        </li>
                                        <li>
                                            <i class="fas fa-check"></i>Impact
                                            assessment
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <p class="mb-40 mt-30">
                            Our commitment to excellence and community service
                            drives every aspect of this project. We believe in
                            creating lasting positive change through dedicated
                            effort and community collaboration.
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
                                    <img
                                        src="{{
                                            asset(
                                                'assets/img/blog/blog-author.jpg'
                                            )
                                        }}"
                                        alt="Program"
                                    />
                                </div>
                                <div class="author-info">
                                    <h4 class="name">
                                        <a
                                            class="text-inherit"
                                            href="#"
                                            >{{ $project->program->title ?? 'General Program' }}</a
                                        >
                                    </h4>
                                    <span class="meta">
                                        <a href="#"
                                            ><i class="fas fa-tags"></i
                                            >{{ $project->program->title ?? 'General' }}</a
                                        >
                                    </span>
                                    <span class="meta">
                                        <a href="#"
                                            ><i
                                                class="fas fa-map-marker-alt"
                                            ></i
                                            >Community Project</a
                                        >
                                    </span>
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
                                <div class="donate-price">$50</div>
                                <h4 class="title">
                                    How Your Support Makes A Difference
                                </h4>
                                <a
                                    class="th-btn"
                                    href="{{ route('donate-now') }}"
                                    >Support Project $50</a
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
                            <h3 class="widget_title">Related Projects</h3>
                            <div class="recent-donate-wrap">
                                @php $relatedProjects =
                                \App\Models\Project::where('id', '!=',
                                $project->id) ->where('status', 'active')
                                ->limit(5) ->get(); @endphp
                                @forelse($relatedProjects as $relatedProject)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a
                                            href="{{ route('projects.detail', $relatedProject->slug) }}"
                                        >
                                            @if($relatedProject->image_url)
                                            <img
                                                src="{{ $relatedProject->image_url }}"
                                                alt="{{ $relatedProject->name }}"
                                            />
                                            @else
                                            <img
                                                src="{{
                                                    asset(
                                                        'assets/img/widget/donor_1_1.jpg'
                                                    )
                                                }}"
                                                alt="{{ $relatedProject->name }}"
                                            />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title">
                                            <a
                                                class="text-inherit"
                                                href="{{ route('projects.detail', $relatedProject->slug) }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($relatedProject->name, 30) }}
                                            </a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            <a
                                                href="{{ route('projects.detail', $relatedProject->slug) }}"
                                                >{{ $relatedProject->program->title ?? 'General' }}</a
                                            >
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="recent-post">
                                    <div class="media-body">
                                        <p>No related projects found.</p>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Override grayscale filter for project images to keep them colored */
        .page-img img {
            filter: none !important;
        }
        .recent-post .media-img img {
            filter: none !important;
        }
    </style>
</div>
