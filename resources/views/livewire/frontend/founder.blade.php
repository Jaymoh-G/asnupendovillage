<div>
    <!--==============================
    Breadcumb
============================== -->
    <div
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner ? $pageBanner->effective_banner_url : asset('assets/img/bg/breadcumb-bg.jpg') }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">
                    {{ $pageBanner && $pageBanner->title ? $pageBanner->title : 'Our Founder' }}
                </h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                    <li>Our Founder</li>
                </ul>
            </div>
        </div>
    </div>

    @if($pageContent)
    <!--==============================
    Dynamic Content Area
    ==============================-->
    <section class="space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="title-area text-center mb-50">
                        <h1 class="sec-title">{{ $pageContent->effective_title }}</h1>
                        @if($pageContent->excerpt)
                        <p class="sec-text">{{ $pageContent->excerpt }}</p>
                        @endif
                    </div>
                    <div class="content-area">
                        {!! $pageContent->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--==============================
    Founder Area
    ==============================-->
    <section class="space">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="img-box1">
                        <div
                            class="img1"
                            data-mask-src="{{
                                asset('assets/img/normal/about_1_1-mask.png')
                            }}"
                        >
                            <img
                                src="{{
                                    asset('assets/img/team/team_3_1.png')
                                }}"
                                alt="Founder"
                            />
                        </div>
                        <div class="about-shape1-1 jump">
                            <img
                                src="{{
                                    asset('assets/img/shape/about_shape1_1.png')
                                }}"
                                alt="img"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-wrap1">
                        <div class="title-area mb-30">
                            <span class="sub-title before-none"
                                >Founder & CEO</span
                            >
                            <h2 class="sec-title">John Doe</h2>
                            <p class="mb-4">
                                John Doe is the visionary founder and CEO of ASN
                                Upendo Village. With over 15 years of experience
                                in community development and charitable work,
                                John has dedicated his life to making a positive
                                impact in the lives of others.
                            </p>
                            <p class="mb-4">
                                Born and raised in the local community, John
                                witnessed firsthand the challenges faced by
                                families and individuals in need. This
                                experience inspired him to establish ASN Upendo
                                Village in 2010, with the mission to provide
                                support, resources, and hope to those who need
                                it most.
                            </p>
                            <p class="mb-4">
                                Under John's leadership, ASN Upendo Village has
                                grown from a small local initiative to a
                                comprehensive community support organization,
                                serving thousands of individuals and families
                                each year.
                            </p>
                        </div>
                        <div class="checklist style2">
                            <ul>
                                <li>
                                    15+ Years of Community Development
                                    Experience
                                </li>
                                <li>Master's Degree in Social Work</li>
                                <li>
                                    Certified Non-Profit Management Professional
                                </li>
                                <li>
                                    Recipient of Community Service Excellence
                                    Award
                                </li>
                            </ul>
                        </div>
                        <div class="btn-wrap mt-40">
                            <a href="{{ route('contact-us') }}" class="th-btn"
                                >Get In Touch<i
                                    class="fas fa-arrow-up-right ms-2"
                                ></i
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
    Vision & Mission Area
    ==============================-->
    <section
        class="space"
        data-bg-src="{{ asset('assets/img/bg/gray-bg2.png') }}"
    >
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="feature-card">
                        <div class="feature-card-bg-shape">
                            <img
                                src="{{
                                    asset(
                                        'assets/img/shape/feature-card-bg-shape1-1.png'
                                    )
                                }}"
                                alt="img"
                            />
                        </div>
                        <div class="box-icon">
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-1.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Our Vision</h3>
                        <p class="box-text">
                            To create a world where every individual has access
                            to the resources, support, and opportunities they
                            need to thrive and reach their full potential.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-card">
                        <div class="feature-card-bg-shape">
                            <img
                                src="{{
                                    asset(
                                        'assets/img/shape/feature-card-bg-shape1-1.png'
                                    )
                                }}"
                                alt="img"
                            />
                        </div>
                        <div class="box-icon">
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-2.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Our Mission</h3>
                        <p class="box-text">
                            To empower communities through education,
                            healthcare, and social support programs, fostering
                            sustainable development and positive change.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
    Values Area
    ==============================-->
    <section class="space">
        <div class="container">
            <div class="title-area text-center mb-50">
                <span class="sub-title">Our Values</span>
                <h2 class="sec-title">The Principles That Guide Us</h2>
            </div>
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card text-center">
                        <div class="box-icon">
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-1.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Compassion</h3>
                        <p class="box-text">
                            We approach every individual with empathy,
                            understanding, and genuine care for their
                            well-being.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card text-center">
                        <div class="box-icon">
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-2.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Integrity</h3>
                        <p class="box-text">
                            We maintain the highest standards of honesty,
                            transparency, and ethical behavior in all our
                            actions.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card text-center">
                        <div class="box-icon">
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-1.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Excellence</h3>
                        <p class="box-text">
                            We strive for excellence in everything we do,
                            continuously improving our programs and services.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card text-center">
                        <div class="box-icon">
                            <img
                                src="{{
                                    asset('assets/img/icon/feature-icon1-2.svg')
                                }}"
                                alt="icon"
                            />
                        </div>
                        <h3 class="box-title">Community</h3>
                        <p class="box-text">
                            We believe in the power of community and work
                            together to create lasting positive change.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
    Founder's Story Area
    ==============================-->
    <section class="space" data-bg-src="{{ asset('assets/img/bg/gray-bg2.png') }}">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="title-area mb-30">
                        <span class="sub-title">The Journey</span>
                        <h2 class="sec-title">John's Story: From Vision to Reality</h2>
                        <p class="mb-4">
                            John's journey began in the heart of our community, where he grew up witnessing the struggles and triumphs of his neighbors. As a young boy, he would often accompany his mother to deliver meals to elderly residents who couldn't leave their homes. These early experiences planted the seeds of compassion and service that would later blossom into ASN Upendo Village.
                        </p>
                        <p class="mb-4">
                            After completing his education in social work, John worked with various non-profit organizations, gaining valuable experience in community development and social services. However, he always felt that more could be done to address the specific needs of his hometown community. The turning point came in 2008 when a devastating economic downturn left many families struggling to make ends meet.
                        </p>
                        <p class="mb-4">
                            "I remember sitting in my living room, watching the news about families losing their homes and children going hungry," John recalls. "That's when I realized I had to do something. I couldn't just stand by and watch my community suffer."
                        </p>
                        <p class="mb-4">
                            With just $500 in savings and a dream to make a difference, John started ASN Upendo Village from his garage. The first program was a simple food bank that served 15 families. Today, that same organization serves over 5,000 individuals annually through comprehensive programs in education, healthcare, housing assistance, and community development.
                        </p>
                        <p class="mb-4">
                            "The name 'Upendo' means 'love' in Swahili," John explains. "I chose this name because love is at the core of everything we do. When you approach people with genuine love and respect, you can overcome any obstacle and create lasting change."
                        </p>
                    </div>
                    <div class="checklist style2">
                        <ul>
                            <li>Started with just $500 and a dream</li>
                            <li>First program served 15 families</li>
                            <li>Now serves 5,000+ individuals annually</li>
                            <li>Expanded to 12 different programs</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="img-box1">
                        <div class="img1" data-mask-src="{{ asset('assets/img/normal/about_1_1-mask.png') }}">
                            <img src="{{ asset('assets/img/team/team_3_1.png') }}" alt="John's Journey" />
                        </div>
                        <div class="about-shape1-1 jump">
                            <img src="{{ asset('assets/img/shape/about_shape1_1.png') }}" alt="img" />
                        </div>
                        <div class="experience-box">
                            <div class="experience-box-inner">
                                <h3 class="experience-box-title">15+ Years</h3>
                                <p class="experience-box-text">Of Dedicated Service</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
