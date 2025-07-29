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
                    {{ $pageBanner->title ?? 'Team Member Details' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('team') }}">Our Team</a></li>
                    <li>{{ $team->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Team Details Area -->
    <section class="space">
        <div class="container">
            <div class="team-details-wrap mb-80">
                <div class="row gx-60 gy-40">
                    <div class="col-xl-5">
                        <div class="about-card-img">
                            @if($team->image_url)
                            <img
                                src="{{ $team->image_url }}"
                                alt="{{ $team->name }}"
                                style="filter: none !important"
                            />
                            @else
                            <img
                                src="{{
                                    asset('assets/img/team/team_inner_1.png')
                                }}"
                                alt="{{ $team->name }}"
                            />
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="about-card">
                            <div class="about-card-title-wrap">
                                <div class="media-left">
                                    <h2 class="h3 about-card_title mt-n2">
                                        {{ $team->name }}
                                    </h2>
                                    <p class="about-card_desig">
                                        {{ $team->position ?? 'Team Member' }}
                                    </p>
                                </div>
                                <div class="th-social style4">
                                    @if($team->facebook)
                                    <a
                                        target="_blank"
                                        href="{{ $team->facebook }}"
                                        ><i class="fab fa-facebook-f"></i
                                    ></a>
                                    @endif @if($team->twitter)
                                    <a
                                        target="_blank"
                                        href="{{ $team->twitter }}"
                                        ><i class="fab fa-twitter"></i
                                    ></a>
                                    @endif @if($team->instagram)
                                    <a
                                        target="_blank"
                                        href="{{ $team->instagram }}"
                                        ><i class="fab fa-instagram"></i
                                    ></a>
                                    @endif @if($team->linkedin)
                                    <a
                                        target="_blank"
                                        href="{{ $team->linkedin }}"
                                        ><i class="fab fa-linkedin-in"></i
                                    ></a>
                                    @endif
                                </div>
                            </div>

                            @if($team->bio)
                            <p class="about-card_text">{{ $team->bio }}</p>

                            @endif

                          

                        </div>
                    </div>
                </div>
            </div>
             @if($team->bio)
            <div class="row gy-40">
                <div class="col-xl-12">
                    <h3 class="title mt-n2 mb-25">From the {{ $team->position }}</h3>

                    <p>{{ $team->bio }}</p>


                </div>

            </div>
            @endif
        </div>
    </section>

    <!-- Other Team Members Section -->
    @if($otherTeams->count() > 0)
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"
                    ><i class="far fa-heart text-theme"></i> Our Team</span
                >
                <h2 class="sec-title">Meet Other Team Members</h2>
            </div>
            <div class="row gy-40">
                @foreach($otherTeams as $otherTeam)
                <div class="col-lg-3 col-md-6">
                    <div class="th-team team-card3">
                        <div class="team-img">
                            @if($otherTeam->image_url)
                            <img
                                src="{{ $otherTeam->image_url }}"
                                alt="{{ $otherTeam->name }}"
                                style="filter: none !important"
                            />
                            @else
                            <img
                                src="{{
                                    asset('assets/img/team/team_3_1.png')
                                }}"
                                alt="{{ $otherTeam->name }}"
                            />
                            @endif
                        </div>
                        <div class="team-card-content">
                            <h3 class="box-title">
                                <a
                                    href="{{ route('team.detail', $otherTeam->slug) }}"
                                    >{{ $otherTeam->name }}</a
                                >
                            </h3>
                            <span
                                class="team-desig"
                                >{{ $otherTeam->position ?? 'Team Member' }}</span
                            >
                            <div class="th-social style2">
                                @if($otherTeam->facebook)
                                <a
                                    target="_blank"
                                    href="{{ $otherTeam->facebook }}"
                                    ><i class="fab fa-facebook-f"></i
                                ></a>
                                @endif @if($otherTeam->twitter)
                                <a
                                    target="_blank"
                                    href="{{ $otherTeam->twitter }}"
                                    ><i class="fab fa-twitter"></i
                                ></a>
                                @endif @if($otherTeam->instagram)
                                <a
                                    target="_blank"
                                    href="{{ $otherTeam->instagram }}"
                                    ><i class="fab fa-instagram"></i
                                ></a>
                                @endif @if($otherTeam->linkedin)
                                <a
                                    target="_blank"
                                    href="{{ $otherTeam->linkedin }}"
                                    ><i class="fab fa-linkedin-in"></i
                                ></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <style>
        /* Override grayscale filter for team images to keep them colored */
        .about-card-img img,
        .team-card3 .team-img img {
            filter: none !important;
        }
        .team-card3:hover .team-img img {
            filter: none !important;
        }
        .about-card-title-wrap {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        .th-social.style4 a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            color: #333;
            border-radius: 50%;
            margin-left: 10px;
            transition: all 0.3s ease;
        }
        .th-social.style4 a:hover {
            background: #007bff;
            color: white;
        }
        .about-contact {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .about-contact .icon {
            width: 50px;
            height: 50px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #007bff;
        }
        .about-contact-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        .about-contact-text {
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        .about-contact-text a {
            color: #007bff;
            text-decoration: none;
        }
        .about-contact-text a:hover {
            text-decoration: underline;
        }
    </style>
</div>
