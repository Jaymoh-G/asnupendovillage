<div>
    <!--==============================
    Donation Banner Section
    ==============================-->
    @if($pageBanner && $pageBanner->effective_banner_url)
    <section
        class="breadcumb-wrapper"
        data-bg-src="{{ $pageBanner->effective_banner_url }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title text-white">
                    {{ $pageBanner->title ? $pageBanner->title : 'Support Our Mission' }}
                </h1>
                <p class="breadcumb-text text-white-50 mb-4">
                    {{ $pageBanner->description ?? 'Your generous donation helps us continue our work in supporting communities and making a positive impact in people\'s lives.' }}
                </p>
            </div>
        </div>
    </section>
    @else
    <section
        class="breadcumb-wrapper"
        data-bg-src="{{ asset('assets/img/bg/breadcumb-bg.jpg') }}"
        data-overlay="theme"
    >
        <div class="container">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title text-white">Support Our Mission</h1>
                <p class="breadcumb-text text-white-50 mb-4">
                    Your generous donation helps us continue our work in
                    supporting communities and making a positive impact in
                    people's lives.
                </p>
            </div>
        </div>
    </section>
    @endif

    <!--==============================
    Donation Form Section
    ==============================-->
    <section class="space-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @if(session('success'))
                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session("success") }}
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                    @endif @if(session('error'))
                    <div
                        class="alert alert-danger alert-dismissible fade show"
                        role="alert"
                    >
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session("error") }}
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                    @endif

                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4 p-md-5">
                            <div
                                class="alert alert-info mb-4 rounded-3"
                                role="alert"
                            >
                                <i class="fas fa-info-circle me-2"></i>
                                Please fill out this form to
                                <strong>request donation payment details</strong
                                >. Our team will review your request and send
                                <strong
                                    >payment instructions to your email</strong
                                >
                                shortly.
                            </div>
                            <form
                                action="{{ route('donation.request') }}"
                                method="POST"
                            >
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div
                                            class="bg-light p-4 p-md-5 rounded-3"
                                        >
                                            <h4
                                                class="mb-4 d-flex align-items-center"
                                            >
                                                <i
                                                    class="fas fa-user me-2 text-theme"
                                                ></i>
                                                Donation Request Information
                                            </h4>

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label
                                                        for="donor_name"
                                                        class="form-label fw-semibold"
                                                        >Full Name *</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control form-control-lg @error('donor_name') is-invalid @enderror"
                                                        id="donor_name"
                                                        name="donor_name"
                                                        placeholder="Enter your full name"
                                                        required
                                                    />
                                                    @error('donor_name')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label
                                                        for="donor_phone"
                                                        class="form-label fw-semibold"
                                                        >Phone Number *</label
                                                    >
                                                    <input
                                                        type="tel"
                                                        class="form-control form-control-lg @error('donor_phone') is-invalid @enderror"
                                                        id="donor_phone"
                                                        name="donor_phone"
                                                        placeholder="e.g., 0712345678"
                                                        required
                                                    />
                                                    @error('donor_phone')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label
                                                        for="donor_email"
                                                        class="form-label fw-semibold"
                                                        >Email Address *</label
                                                    >
                                                    <input
                                                        type="email"
                                                        class="form-control form-control-lg @error('donor_email') is-invalid @enderror"
                                                        id="donor_email"
                                                        name="donor_email"
                                                        placeholder="Your email address"
                                                        required
                                                    />
                                                    <small class="text-muted"
                                                        >We will send payment
                                                        details to this
                                                        email.</small
                                                    >
                                                    @error('donor_email')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label
                                                        for="preferred_contact_method"
                                                        class="form-label fw-semibold"
                                                        >Preferred Contact
                                                        Method (Optional)</label
                                                    >
                                                    <select
                                                        class="form-select form-select-lg @error('preferred_contact_method') is-invalid @enderror"
                                                        id="preferred_contact_method"
                                                        name="preferred_contact_method"
                                                    >
                                                        <option
                                                            value=""
                                                            selected
                                                        >
                                                            Default (Email)
                                                        </option>
                                                        <option value="email">
                                                            Email
                                                        </option>
                                                        <option value="phone">
                                                            Phone
                                                        </option>
                                                    </select>
                                                    @error('preferred_contact_method')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label
                                                        for="donation_purpose"
                                                        class="form-label fw-semibold"
                                                        >Donation Purpose
                                                        (Optional)</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control form-control-lg @error('donation_purpose') is-invalid @enderror"
                                                        id="donation_purpose"
                                                        name="donation_purpose"
                                                        placeholder="e.g., General support, specific program name"
                                                    />
                                                    @error('donation_purpose')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label
                                                        for="message"
                                                        class="form-label fw-semibold"
                                                        >Additional
                                                        Information</label
                                                    >
                                                    <textarea
                                                        class="form-control form-control-lg @error('message') is-invalid @enderror"
                                                        id="message"
                                                        name="message"
                                                        rows="4"
                                                        placeholder="Share any preference (e.g., purpose of donation, reference, special instructions)"
                                                    ></textarea>
                                                    @error('message')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden defaults required by backend -->
                                <input
                                    type="hidden"
                                    name="preferred_payment_method"
                                    value="other"
                                />
                                <input
                                    type="hidden"
                                    name="currency"
                                    value="KES"
                                />

                                <!-- Submit Button -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="th-btn">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Request Donation Payment Details
                                    </button>
                                    <p
                                        class="text-muted mt-2 mb-0"
                                        style="font-size: 0.9rem"
                                    >
                                        By submitting this form, you agree to be
                                        contacted at the email provided with
                                        donation payment instructions.
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .th-btn {
            background: var(--theme-color, #1a685b);
            border: 1px solid var(--theme-color, #1a685b);
            color: #fff;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .th-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px
                color-mix(in srgb, var(--theme-color, #1a685b) 30%, transparent);
            opacity: 0.95;
        }
        .text-theme {
            color: var(--theme-color, #1a685b);
        }
        .alert-info {
            border-left: 4px solid var(--theme-color2, #ffac00);
        }
        .input-group-text {
            background: color-mix(
                in srgb,
                var(--theme-color, #1a685b) 10%,
                #fff
            );
            color: var(--theme-color, #1a685b);
            border-color: color-mix(
                in srgb,
                var(--theme-color, #1a685b) 25%,
                #ddd
            );
        }
        .form-control:focus,
        .form-select:focus {
            border-color: color-mix(
                in srgb,
                var(--theme-color, #1a685b) 45%,
                #ccc
            );
            box-shadow: 0 0 0 0.2rem
                color-mix(in srgb, var(--theme-color, #1a685b) 20%, transparent);
        }
    </style>
</div>
