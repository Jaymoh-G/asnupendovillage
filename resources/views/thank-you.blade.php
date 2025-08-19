@extends('components.layouts.app') @section('content')

<!--==============================
    Thank You Content Section
    ==============================-->
<section class="space-top space-extra-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Card -->
                <div class="card shadow-lg border-0 text-center mb-5">
                    <div class="card-body p-5">
                        <div class="success-icon mb-4">
                            <div class="success-circle">
                                <i class="fas fa-heart text-white"></i>
                            </div>
                        </div>

                        <h2 class="card-title text-success mb-3">
                            Donation Successful!
                        </h2>
                        <p class="card-text text-muted mb-4">
                            Thank you for your generous contribution to ASN
                            Upendo Village. Your donation will help us continue
                            our mission of supporting communities and making a
                            positive impact in people's lives.
                        </p>

                       

                        <div class="next-steps mb-4">
                            <h5 class="text-primary mb-3">
                                What Happens Next?
                            </h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="step-item text-center">
                                        <div class="step-icon mb-3">
                                            <i
                                                class="fas fa-envelope text-primary fa-2x"
                                            ></i>
                                        </div>
                                        <h6>Confirmation Email</h6>
                                        <p class="small text-muted">
                                            You'll receive a confirmation email
                                            with your donation receipt.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="step-item text-center">
                                        <div class="step-icon mb-3">
                                            <i
                                                class="fas fa-chart-line text-success fa-2x"
                                            ></i>
                                        </div>
                                        <h6>Impact Tracking</h6>
                                        <p class="small text-muted">
                                            We'll keep you updated on how your
                                            donation is making a difference.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="step-item text-center">
                                        <div class="step-icon mb-3">
                                            <i
                                                class="fas fa-users text-info fa-2x"
                                            ></i>
                                        </div>
                                        <h6>Community Updates</h6>
                                        <p class="small text-muted">
                                            Stay connected with our community
                                            and future initiatives.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <!-- Social Sharing -->
                <div class="social-sharing text-center">
                    <h5 class="text-primary mb-3">Share Your Generosity</h5>
                    <p class="text-muted mb-4">
                        Help us spread the word about our mission and inspire
                        others to make a difference.
                    </p>
                    <div class="social-buttons">
                        <a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                            target="_blank"
                            class="btn btn-outline-primary me-2 mb-2"
                        >
                            <i class="fab fa-facebook-f me-2"></i>Share on
                            Facebook
                        </a>
                        <a
                            href="https://twitter.com/intent/tweet?text={{
                                urlencode(
                                    'I just made a donation to ASN Upendo Village! Join me in supporting this amazing cause.'
                                )
                            }}&url={{ urlencode(request()->url()) }}"
                            target="_blank"
                            class="btn btn-outline-info me-2 mb-2"
                        >
                            <i class="fab fa-twitter me-2"></i>Share on Twitter
                        </a>
                        <a
                            href="https://wa.me/?text={{ urlencode('I just made a donation to ASN Upendo Village! Join me in supporting this amazing cause. ' . request()->url()) }}"
                            target="_blank"
                            class="btn btn-outline-success me-2 mb-2"
                        >
                            <i class="fab fa-whatsapp me-2"></i>Share on
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<style>
    /* Success Icon Styling */
    .success-icon {
        margin-bottom: 2rem;
    }

    .success-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
        animation: pulse 2s infinite;
    }

    .success-circle i {
        font-size: 3rem;
        animation: bounce 1s ease-in-out;
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

    @keyframes bounce {
        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    /* Card Styling */
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    /* Step Items */
    .step-item {
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .step-item:hover {
        transform: translateY(-3px);
    }

    .step-icon {
        transition: all 0.3s ease;
    }

    .step-item:hover .step-icon {
        transform: scale(1.1);
    }

    /* Impact Cards */
    .impact-card {
        transition: all 0.3s ease;
    }

    .impact-card:hover {
        transform: translateY(-5px);
    }

    .impact-icon {
        transition: all 0.3s ease;
    }

    .impact-card:hover .impact-icon {
        transform: scale(1.1);
    }

    /* Statistics */
    .stat-item {
        transition: all 0.3s ease;
        padding: 1.5rem;
        border-radius: 10px;
    }

    .stat-item:hover {
        transform: translateY(-5px);
        background: white;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-number {
        transition: all 0.3s ease;
    }

    .stat-item:hover .stat-number {
        transform: scale(1.1);
    }

    /* Buttons */
    .th-btn {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .th-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        color: white;
        text-decoration: none;
    }

    .th-btn-outline {
        background: transparent;
        border: 2px solid #007bff;
        color: #007bff;
    }

    .th-btn-outline:hover {
        background: #007bff;
        color: white;
    }

    /* Social Buttons */
    .social-buttons .btn {
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .social-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .success-circle {
            width: 100px;
            height: 100px;
        }

        .success-circle i {
            font-size: 2.5rem;
        }

        .action-buttons .th-btn {
            display: block;
            margin-bottom: 1rem;
            text-align: center;
        }

        .social-buttons .btn {
            display: block;
            margin-bottom: 0.5rem;
            text-align: center;
        }
    }

    /* Hero Section Enhancement */
    .breadcumb-wrapper {
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .breadcumb-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(26, 104, 91, 0.8);
        z-index: 1;
    }

    .breadcumb-content {
        position: relative;
        z-index: 2;
    }

    /* Animation Classes */
    .fade-in {
        animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in-left {
        animation: slideInLeft 1s ease-out;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .slide-in-right {
        animation: slideInRight 1s ease-out;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Add animation classes to elements
        const elements = document.querySelectorAll(
            ".card, .step-item, .impact-card, .stat-item"
        );

        elements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add("fade-in");
            }, index * 100);
        });

        // Add slide animations
        const leftElements = document.querySelectorAll(
            ".col-md-6:first-child .card, .col-md-3:nth-child(odd) .stat-item"
        );
        const rightElements = document.querySelectorAll(
            ".col-md-6:last-child .card, .col-md-3:nth-child(even) .stat-item"
        );

        leftElements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add("slide-in-left");
            }, index * 150);
        });

        rightElements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add("slide-in-right");
            }, index * 150);
        });
    });
</script>
@endsection
