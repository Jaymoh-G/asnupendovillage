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
                <h1 class="breadcumb-title">{{ $project->name }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li>{{ $project->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $project->name }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li>{{ $project->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Project Details Section -->
    <section class="donation-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <!-- Featured Project Image - At the top -->
                    <div class="page-img mb-4">
                        @if($project->image_url)
                        <img
                            src="{{ $project->image_url }}"
                            alt="{{ $project->name }}"
                            style="filter: none !important"
                        />
                        @else
                        <img
                            src="{{
                                asset('assets/img/donation/donation-s-1-1.png')
                            }}"
                            alt="{{ $project->name }}"
                        />
                        @endif @if($project->program)
                        <div class="tag">
                            {{ $project->program->title }}
                        </div>
                        @endif
                    </div>

                    <div class="blog-content">
                        <h2 class="h3 page-title mt-n2">
                            {{ $project->name }}
                        </h2>

                        @if($project->excerpt)
                        <div class="mb-45">
                            <p class="lead">{{ $project->excerpt }}</p>
                        </div>
                        @endif @if($project->content)
                        <div class="mb-45 project-content">
                            {!! $project->content !!}
                        </div>
                        @endif

                        <!-- Additional Project Images Section - At the bottom -->
                        <div class="project-images-section mb-45">
                            <h3 class="h4 mb-4">
                                {{ $project->name }} Project Images
                            </h3>
                            @if($project->images()->count() > 0)
                            <div class="row g-3">
                                @foreach($project->images()->ordered()->get() as $image)
                                <div class="col-md-6 col-lg-6">
                                    <div class="project-image-item">
                                        <img
                                            src="{{ $image->display_url }}"
                                            alt="{{ $image->alt_text ?? $project->name }}"
                                            class="img-fluid rounded"
                                            style="
                                                filter: none !important;
                                                width: 100%;
                                                height: 200px;
                                                object-fit: cover;
                                            "
                                        />
                                        @if($image->featured)
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center text-muted">
                                <i class="fas fa-images fa-3x mb-3"></i>
                                <p>No additional project images available</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area donation-sidebar">
                        @if($project->program)
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Program Information</h3>
                            <ul>
                                <li>
                                    <strong
                                        >This project is under the
                                        program:</strong
                                    >
                                    <a
                                        href="{{ route('programs.detail', $project->program->slug) }}"
                                    >
                                        {{ $project->program->title }}
                                    </a>
                                </li>
                                @if($project->program->excerpt)
                                <li>
                                    <strong>Description:</strong>
                                    {{ \Illuminate\Support\Str::limit($project->program->excerpt, 100) }}
                                </li>
                                @endif
                            </ul>
                        </div>
                        @endif

                        <!-- Support Project Banner -->
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Support This Project</h3>
                            <div class="support-facility-banner">
                                <div class="support-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h4 class="support-title">Help Us Maintain</h4>
                                <p class="support-description">
                                    Your support helps us maintain and improve
                                    this project, ensuring it continues to serve
                                    our community with excellence.
                                </p>
                                <div class="support-actions">
                                    <a
                                        class="th-btn support-btn"
                                        href="{{ route('donate-now') }}"
                                    >
                                        <i
                                            class="fas fa-hand-holding-heart"
                                        ></i>
                                        Support Project
                                    </a>
                                    <a
                                        class="th-btn-outline share-btn"
                                        href="#"
                                        onclick="shareProject()"
                                    >
                                        <i class="fas fa-share-alt"></i>
                                        Share Project
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Related Projects Widget -->
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Other Projects</h3>
                            <div class="related-projects">
                                @php $relatedProjects =
                                \App\Models\Project::where('id', '!=',
                                $project->id) ->where('status', 'active')
                                ->where('program_id', $project->program_id)
                                ->limit(5) ->get(); @endphp
                                @forelse($relatedProjects as $relatedProject)
                                <div class="related-project-item">
                                    <div class="project-thumb">
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
                                    </div>
                                    <div class="project-info">
                                        <h4 class="project-title">
                                            <a
                                                href="{{ route('projects.detail', $relatedProject->slug) }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($relatedProject->name, 40) }}
                                            </a>
                                        </h4>
                                        @if($relatedProject->program)
                                        <div class="project-meta">
                                            <span class="project-program">
                                                <i class="fas fa-tags"></i>
                                                {{ $relatedProject->program->title }}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="related-project-item">
                                    <div class="project-info">
                                        <p class="text-muted">
                                            No related projects found.
                                        </p>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Quick Actions Widget -->
                        <div class="widget widget_categories">
                            <h3 class="widget_title">Quick Actions</h3>
                            <div class="quick-actions">
                                <a
                                    class="th-btn w-100 mb-3"
                                    href="{{ route('projects') }}"
                                >
                                    <i class="fas fa-list"></i>
                                    View All Projects
                                </a>
                                <a
                                    class="th-btn-outline w-100"
                                    href="{{ route('contact-us') }}"
                                >
                                    <i class="fas fa-envelope"></i>
                                    Contact Us
                                </a>
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

        /* Rich content styling */
        .project-content {
            line-height: 1.6;
        }

        .project-content h2,
        .project-content h3,
        .project-content h4 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .project-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .project-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .project-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .project-content p {
            margin-bottom: 1rem;
        }

        .project-content ul,
        .project-content ol {
            margin-bottom: 1rem;
            padding-left: 2rem;
        }

        .project-content li {
            margin-bottom: 0.5rem;
        }

        .project-content blockquote {
            border-left: 4px solid #007bff;
            padding-left: 1rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #666;
        }

        .project-content a {
            color: #007bff;
            text-decoration: none;
        }

        .project-content a:hover {
            text-decoration: underline;
        }

        .project-content img {
            max-width: 100%;
            height: auto;
            margin: 1rem 0;
            border-radius: 8px;
        }

        .project-content .code-block {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 4px;
            font-family: monospace;
            margin: 1rem 0;
        }

        /* Project Images Styling */
        .project-image-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .project-image-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .project-image-item img {
            transition: transform 0.3s ease;
        }

        .project-image-item:hover img {
            transform: scale(1.05);
        }

        .featured-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, #ffac00, #ff8c00);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(255, 172, 0, 0.3);
        }

        .featured-badge i {
            margin-right: 4px;
            color: white;
        }

        .project-images-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .project-images-section h3 {
            color: #1a685b;
            border-bottom: 2px solid #ffac00;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Support Facility Banner Styling */
        .support-facility-banner {
            text-align: center;
            padding: 25px 20px;
            background: #1a685b;
            border-radius: 12px;
            color: white;
            margin-bottom: 20px;
        }

        .support-icon {
            margin-bottom: 15px;
        }

        .support-icon i {
            font-size: 2.5rem;
            color: #ffac00;
            animation: pulse 2s infinite;
            text-shadow: 0 0 20px rgba(255, 172, 0, 0.5);
        }

        .support-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: white;
        }

        .support-description {
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.9);
        }

        .support-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .support-btn {
            background: #ffac00 !important;
            color: white !important;
            border: 2px solid #ffac00 !important;
            font-weight: 600;
            padding: 12px 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 172, 0, 0.3);
        }

        .support-btn:hover {
            background: white !important;
            color: #ffac00 !important;
            border-color: #ffac00 !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 172, 0, 0.4);
        }

        .share-btn {
            background: transparent !important;
            color: white !important;
            border: 2px solid rgba(255, 172, 0, 0.8) !important;
            font-weight: 600;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            background: rgba(255, 172, 0, 0.1) !important;
            color: #ffac00 !important;
            border-color: #ffac00 !important;
            transform: translateY(-2px);
        }

        .support-btn i,
        .share-btn i {
            margin-right: 8px;
        }

        /* Related projects styling */
        .related-projects {
            margin-top: 20px;
        }

        .related-project-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .related-project-item:hover {
            border-color: #ffac00;
            box-shadow: 0 4px 12px rgba(255, 172, 0, 0.25);
            background: rgba(255, 172, 0, 0.02);
        }

        .related-project-item:last-child {
            margin-bottom: 0;
        }

        .project-thumb {
            flex-shrink: 0;
            width: 80px;
            height: 60px;
            margin-right: 15px;
            border-radius: 6px;
            overflow: hidden;
        }

        .project-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: none !important;
        }

        .project-info {
            flex: 1;
            min-width: 0;
        }

        .project-title {
            margin: 0 0 8px 0;
            font-size: 14px;
            line-height: 1.3;
        }

        .project-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .project-title a:hover {
            color: #ffac00;
            text-shadow: 0 0 8px rgba(255, 172, 0, 0.2);
        }

        .project-meta {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .project-meta span {
            font-size: 12px;
            color: #666;
            display: flex;
            align-items: center;
        }

        .project-meta i {
            margin-right: 6px;
            color: #ffac00;
            width: 14px;
            text-shadow: 0 0 8px rgba(255, 172, 0, 0.3);
        }

        .project-program {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Quick Actions Styling */
        .quick-actions {
            margin-top: 20px;
        }

        .quick-actions .th-btn,
        .quick-actions .th-btn-outline {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .quick-actions .th-btn i,
        .quick-actions .th-btn-outline i {
            margin: 0;
        }

        /* Lead paragraph styling */
        .lead {
            font-size: 1.1rem;
            font-weight: 500;
            color: #1a685b;
            line-height: 1.6;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>

    <script>
        function shareProject() {
            if (navigator.share) {
                navigator.share({
                    title: "{{ $project->name }}",
                    text: "Check out this amazing project: {{ $project->name }}",
                    url: window.location.href,
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                const url = window.location.href;
                const text =
                    "Check out this amazing project: {{ $project->name }}";

                // Copy to clipboard
                navigator.clipboard
                    .writeText(`${text}\n${url}`)
                    .then(() => {
                        alert("Project link copied to clipboard!");
                    })
                    .catch(() => {
                        // Fallback: open in new window
                        window.open(
                            `https://twitter.com/intent/tweet?text=${encodeURIComponent(
                                text
                            )}&url=${encodeURIComponent(url)}`,
                            "_blank"
                        );
                    });
            }
        }
    </script>
</div>
