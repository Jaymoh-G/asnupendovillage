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
                    {{ $pageBanner->title ?? 'Our Team' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Our Team</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="breadcumb-wrapper" style="background-color: #000000">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Our Team</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Our Team</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Team Area -->
    <section class="space" id="team-sec">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"
                    ><i class="far fa-heart text-theme"></i> Our Team</span
                >
                <h2 class="sec-title">Meet Our Dedicated Team Members</h2>
            </div>
            <div class="row gy-40">
                @forelse($teams as $team)
                <!-- Single Item -->
                <div class="col-lg-3 col-md-6">
                    <div class="th-team team-card3">
                        <div class="team-img">
                            @if($team->image_url)
                            <img
                                src="{{ $team->image_url }}"
                                alt="{{ $team->name }}"
                                style="filter: none !important"
                            />
                            @else
                            <img
                                src="{{
                                    asset('assets/img/team/team_3_1.png')
                                }}"
                                alt="{{ $team->name }}"
                            />
                            @endif
                        </div>
                        <div class="team-card-content">
                            <h3 class="box-title">
                                <a
                                    href="{{ route('team.detail', $team->slug) }}"
                                    >{{ $team->name }}</a
                                >
                            </h3>
                            <span
                                class="team-desig"
                                >{{ $team->position ?? 'Team Member' }}</span
                            >
                            <div class="th-social style2">
                                @if($team->facebook)
                                <a target="_blank" href="{{ $team->facebook }}"
                                    ><i class="fab fa-facebook-f"></i
                                ></a>
                                @endif @if($team->twitter)
                                <a target="_blank" href="{{ $team->twitter }}"
                                    ><i class="fab fa-twitter"></i
                                ></a>
                                @endif @if($team->instagram)
                                <a target="_blank" href="{{ $team->instagram }}"
                                    ><i class="fab fa-instagram"></i
                                ></a>
                                @endif @if($team->linkedin)
                                <a target="_blank" href="{{ $team->linkedin }}"
                                    ><i class="fab fa-linkedin-in"></i
                                ></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No team members found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        /* Override grayscale filter for team images to keep them colored */
        .team-card3 .team-img img {
            filter: none !important;
        }
        .team-card3:hover .team-img img {
            filter: none !important;
        }
    </style>
</div>
