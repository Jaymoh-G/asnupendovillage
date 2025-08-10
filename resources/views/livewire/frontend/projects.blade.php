<div>
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Projects</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Projects</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="overflow-hidden">
        <div
            class="project-wrap1 space th-radius overflow-hidden"
            data-bg-src="{{ asset('assets/img/bg/gray-bg2.png') }}"
            data-overlay="gray"
            data-opacity="5"
        >
            <div class="container">
                <div
                    class="row justify-content-md-between align-items-center mb-4"
                >
                    <div class="col-lg-5 col-md-6">
                        <div class="title-area">
                            <span class="sub-title before-none"
                                >Complete Projects</span
                            >
                            <h2 class="sec-title">Our Recent Projects</h2>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 gx-4">
                    @forelse($projects as $project)
                    <div class="col-md-4">
                        <div class="donation-card" data-theme-color="#FF5528">
                            <div
                                class="donation-card-shape"
                                data-mask-src="{{
                                    asset(
                                        'assets/img/donation/donation-card-bg-shape1-1.png'
                                    )
                                }}"
                            ></div>
                            <div class="box-thumb">
                                <img
                                    src="{{ $project->image_url ?? asset('assets/img/donation/donation1-3.png') }}"
                                    alt="{{ $project->name }}"
                                />
                                <div class="donation-card-tag">
                                    {{ \Illuminate\Support\Str::limit($project->name, 15) }}
                                </div>
                            </div>
                            <div class="box-content">
                                <h3 class="box-title">
                                    <a
                                        href="#"
                                        >{{ \Illuminate\Support\Str::limit($project->name, 50) }}</a
                                    >
                                </h3>
                                <div class="project-description mb-3">
                                    <p>
                                        @if($project->content) {!!
                                        \Illuminate\Support\Str::limit(strip_tags($project->content),
                                        120) !!} @else
                                        {{ \Illuminate\Support\Str::limit($project->description, 120) }}
                                        @endif
                                    </p>
                                </div>
                                <div class="donation-card_progress-wrap">
                                    <div class="donation-card_progress-content">
                                        <span class="donation-card_goal"
                                            >Program -
                                            {{ $project->program->title ?? 'General' }}</span
                                        >
                                    </div>
                                </div>
                                <a
                                    href="{{ route('projects.detail', $project->slug) }}"
                                    class="th-btn style6"
                                    >View Details
                                    <i class="fas fa-arrow-up-right ms-2"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No projects found.</p>
                    </div>
                    @endforelse
                </div>
                <div class="mt-5 d-flex justify-content-center">
                    {{ $projects->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
    <style>
        /* Override grayscale filter for donation card images to keep them colored */
        .donation-card .box-thumb img {
            filter: none !important;
        }
        .donation-card:hover .box-thumb img {
            filter: none !important;
        }

        /* Project description styling */
        .project-description {
            margin-bottom: 1rem;
        }

        .project-description p {
            color: var(--body-color);
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
            opacity: 0.8;
        }

        /* Ensure proper spacing in donation cards */
        .donation-card .box-content {
            padding: 20px;
        }

        .donation-card .box-title {
            margin-bottom: 15px;
        }

        .donation-card_progress-wrap {
            margin-bottom: 20px;
        }
    </style>
</div>
