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
    Donation Page Header
    ==============================-->


    <!--==============================
    Donation Form Section
    ==============================-->
    <section class="space-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div>
                        @if($showSuccess)
                        <div
                            class="alert alert-success alert-dismissible fade show"
                            role="alert"
                        >
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Thank you!</strong> Your donation has been
                            successfully processed. You will receive a
                            confirmation email shortly.
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                            ></button>
                        </div>
                        @endif @if($showError)
                        <div
                            class="alert alert-danger alert-dismissible fade show"
                            role="alert"
                        >
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Error!</strong> {{ $errorMessage }}
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                            ></button>
                        </div>
                        @endif

                        <div class="card shadow-lg">
                            <div class="card-body p-5">
                                <form
                                    wire:submit.prevent="donate"
                                    method="POST"
                                >
                                    <div class="row">
                                        <!-- Personal Information -->
                                        <div class="col-md-8">
                                            <h4 class="mb-4">
                                                Personal Information
                                            </h4>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label
                                                        for="donor_name"
                                                        class="form-label"
                                                        >Full Name *</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control @error('donor_name') is-invalid @enderror"
                                                        id="donor_name"
                                                        wire:model="donor_name"
                                                        placeholder="Enter your full name"
                                                    />
                                                    @error('donor_name')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <label
                                                        for="donor_email"
                                                        class="form-label"
                                                        >Email Address *</label
                                                    >
                                                    <input
                                                        type="email"
                                                        class="form-control @error('donor_email') is-invalid @enderror"
                                                        id="donor_email"
                                                        wire:model="donor_email"
                                                        placeholder="Your email address"
                                                    />
                                                    @error('donor_email')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <label
                                                        for="donor_phone"
                                                        class="form-label"
                                                        >Phone Number *</label
                                                    >
                                                    <input
                                                        type="tel"
                                                        class="form-control @error('donor_phone') is-invalid @enderror"
                                                        id="donor_phone"
                                                        wire:model="donor_phone"
                                                        placeholder="Your phone number"
                                                    />
                                                    @error('donor_phone')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label
                                                        for="message"
                                                        class="form-label"
                                                        >Message
                                                        (Optional)</label
                                                    >
                                                    <textarea
                                                        class="form-control @error('message') is-invalid @enderror"
                                                        id="message"
                                                        wire:model="message"
                                                        rows="3"
                                                        placeholder="Leave a message with your donation..."
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

                                        <!-- Donation Details -->
                                        <div class="col-md-4">
                                            <h4 class="mb-4">
                                                Donation Details
                                            </h4>

                                            <div class="form-group mb-3">
                                                <label
                                                    for="amount"
                                                    class="form-label"
                                                    >Donation Amount *</label
                                                >
                                                <div class="input-group">
                                                    <span
                                                        class="input-group-text"
                                                        >{{ $currency }}</span
                                                    >
                                                    <input
                                                        type="number"
                                                        class="form-control @error('amount') is-invalid @enderror"
                                                        id="amount"
                                                        wire:model="amount"
                                                        placeholder="Enter amount"
                                                        min="1"
                                                        step="0.01"
                                                    />
                                                </div>
                                                @error('amount')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label"
                                                    >Payment Method *</label
                                                >
                                                <div
                                                    wire:loading
                                                    wire:target="payment_method"
                                                    class="text-muted small mb-2"
                                                >
                                                    <i
                                                        class="fas fa-spinner fa-spin me-1"
                                                    ></i
                                                    >Loading instructions...
                                                </div>
                                                <div
                                                    class="payment-methods p-3 rounded"
                                                    style="
                                                        background: linear-gradient(
                                                            135deg,
                                                            #f8f9fa 0%,
                                                            #ffffff 100%
                                                        );
                                                        border: 1px solid
                                                            #dee2e6;
                                                    "
                                                >
                                                    <div
                                                        class="form-check mb-2"
                                                    >
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            wire:model.live="payment_method"
                                                            value="mpesa"
                                                            id="mpesa"
                                                        />
                                                        <label
                                                            class="form-check-label"
                                                            for="mpesa"
                                                        >
                                                            <i
                                                                class="fas fa-mobile-alt text-success me-2"
                                                            ></i>
                                                            M-Pesa
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="form-check mb-2"
                                                    >
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            wire:model.live="payment_method"
                                                            value="paypal"
                                                            id="paypal"
                                                        />
                                                        <label
                                                            class="form-check-label"
                                                            for="paypal"
                                                        >
                                                            <i
                                                                class="fab fa-paypal text-primary me-2"
                                                            ></i>
                                                            PayPal
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            wire:model.live="payment_method"
                                                            value="bank"
                                                            id="bank"
                                                        />
                                                        <label
                                                            class="form-check-label"
                                                            for="bank"
                                                        >
                                                            <i
                                                                class="fas fa-university text-info me-2"
                                                            ></i>
                                                            Bank Transfer
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('payment_method')
                                                <div
                                                    class="text-danger small mt-1"
                                                >
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Method Instructions -->
                                    @if($payment_method)
                                    <div
                                        class="payment-instructions mt-4 p-4 rounded border"
                                        wire:loading.class="opacity-50"
                                        style="
                                            @if ($payment_method === 'mpesa')
                                                background:
                                                linear-gradient(
                                                    135deg,
                                                    #f8f9fa 0%,
                                                    #e8f5e8 100%
                                                )
                                            ;
                                            border-left: 4px solid #28a745 !important;
                                            @elseif ($payment_method === 'paypal')
                                                background: linear-gradient(135deg, #f8f9fa 0%, #e8f4fd 100%);
                                            border-left: 4px solid #0070ba !important;
                                            @elseif ($payment_method === 'bank')
                                                background: linear-gradient(135deg, #f8f9fa 0%, #e8f4ff 100%);
                                            border-left: 4px solid #17a2b8 !important;
                                            @endif;
                                        "
                                    >
                                        @if($payment_method === 'mpesa')
                                        <h5 class="text-success mb-3">
                                            <i
                                                class="fas fa-mobile-alt me-2"
                                            ></i
                                            >M-Pesa Payment Instructions
                                        </h5>
                                        <p class="mb-2">
                                            You will receive an M-Pesa prompt on
                                            your phone to complete the payment.
                                        </p>
                                        <ul class="mb-0">
                                            <li>
                                                Ensure your phone has sufficient
                                                M-Pesa balance
                                            </li>
                                            <li>
                                                Enter your M-Pesa PIN when
                                                prompted
                                            </li>
                                            <li>
                                                You will receive a confirmation
                                                SMS
                                            </li>
                                        </ul>
                                        @elseif($payment_method === 'paypal')
                                        <h5 class="text-primary mb-3">
                                            <i class="fab fa-paypal me-2"></i
                                            >PayPal Payment Instructions
                                        </h5>
                                        <p class="mb-2">
                                            You will be redirected to PayPal to
                                            complete your payment securely.
                                        </p>
                                        <ul class="mb-0">
                                            <li>
                                                You can pay with your PayPal
                                                balance or card
                                            </li>
                                            <li>
                                                No PayPal account required for
                                                card payments
                                            </li>
                                            <li>
                                                Secure payment processing by
                                                PayPal
                                            </li>
                                        </ul>
                                        @elseif($payment_method === 'bank')
                                        <h5 class="text-info mb-3">
                                            <i
                                                class="fas fa-university me-2"
                                            ></i
                                            >Bank Transfer Instructions
                                        </h5>
                                        <p class="mb-2">
                                            Please use the following bank
                                            details to make your transfer:
                                        </p>
                                        <div
                                            class="bank-details p-4 bg-white rounded border shadow-sm"
                                            style="
                                                border-color: #17a2b8 !important;
                                            "
                                        >
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Bank Name:</strong
                                                    ><br />
                                                    <span
                                                        class="text-muted"
                                                        >{{ \App\Models\Setting::get('payment_bank_name', 'Equity Bank Kenya') }}</span
                                                    >
                                                </div>
                                                <div class="col-md-6">
                                                    <strong
                                                        >Account Name:</strong
                                                    ><br />
                                                    <span
                                                        class="text-muted"
                                                        >{{ \App\Models\Setting::get('payment_account_name', 'ASN Upendo Village') }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <strong
                                                        >Account Number:</strong
                                                    ><br />
                                                    <span
                                                        class="text-muted"
                                                        >{{ \App\Models\Setting::get('payment_account_number', '1234567890') }}</span
                                                    >
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Branch:</strong
                                                    ><br />
                                                    <span
                                                        class="text-muted"
                                                        >{{ \App\Models\Setting::get('payment_branch', 'Nairobi Main Branch') }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <strong>Swift Code:</strong
                                                    ><br />
                                                    <span
                                                        class="text-muted"
                                                        >{{ \App\Models\Setting::get('payment_swift_code', 'EQBLKEXX') }}</span
                                                    >
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Reference:</strong
                                                    ><br />
                                                    <span class="text-muted"
                                                        >DON-{{
                                                            date("Ymd")
                                                        }}-{{
                                                            rand(1000, 9999)
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-2">
                                            <strong>Important Notes:</strong>
                                        </p>
                                        <ul class="mb-0">
                                            <li>
                                                Please include the reference
                                                number in your transfer
                                                description
                                            </li>
                                            <li>
                                                Transfers typically take 1-2
                                                business days to process
                                            </li>
                                            <li>
                                                You will receive a confirmation
                                                email once the transfer is
                                                received
                                            </li>
                                        </ul>
                                        @endif
                                    </div>
                                    @endif

                                    <!-- Submit Button -->
                                    <div class="text-center mt-4">
                                        <button
                                            type="submit"
                                            class="th-btn"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="disabled"
                                        >
                                            <span wire:loading.remove>
                                                <i class="fas fa-heart me-2"></i
                                                >Make Donation
                                            </span>
                                            <span wire:loading>
                                                <i
                                                    class="fas fa-spinner fa-spin me-2"
                                                ></i
                                                >Processing...
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


 

    <style>
        .payment-methods {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .payment-methods:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .payment-instructions {
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .payment-instructions:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .bank-details {
            transition: all 0.3s ease;
        }

        .bank-details:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(23, 162, 184, 0.2) !important;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-check-label {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-check-label:hover {
            color: #007bff;
        }

        .th-btn {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .th-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .th-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Donation Content Styling */
        .donation-content {
            line-height: 1.8;
            color: #666;
            font-size: 1.1rem;
        }

        .donation-content p {
            margin-bottom: 20px;
        }

        .donation-content h3,
        .donation-content h4 {
            color: #1a685b;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .donation-content ul,
        .donation-content ol {
            margin-bottom: 20px;
            padding-left: 20px;
        }

        .donation-content li {
            margin-bottom: 10px;
        }

        /* Impact Section Styling */
        .impact-content {
            line-height: 1.8;
            color: #666;
            font-size: 1.1rem;
        }

        .impact-content p {
            margin-bottom: 20px;
        }

        .impact-content h3,
        .impact-content h4 {
            color: #1a685b;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        /* Additional Info Section Styling */
        .additional-info {
            background: #f8f9fa;
            padding: 40px;
            border-radius: 15px;
            border: 2px solid #e9ecef;
            line-height: 1.8;
            color: #666;
        }

        .additional-info p {
            margin-bottom: 20px;
        }

        .additional-info h3,
        .additional-info h4 {
            color: #1a685b;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .additional-info ul,
        .additional-info ol {
            margin-bottom: 20px;
            padding-left: 20px;
        }

        .additional-info li {
            margin-bottom: 10px;
        }

        /* Title Area Styling */
        .title-area .sub-title {
            color: #ffac00;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: block;
        }

        .title-area .sec-title {
            color: #1a685b;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0;
        }
    </style>
</div>
