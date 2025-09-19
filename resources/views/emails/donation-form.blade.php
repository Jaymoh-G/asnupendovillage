<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>New Donation Request</title>
        <style>
            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                line-height: 1.6;
                color: #333;
                max-width: 650px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f8f9fa;
            }

            .email-container {
                background-color: white;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .header {
                background: linear-gradient(135deg, #1a685b 0%, #43b738 100%);
                color: white;
                padding: 30px 25px;
                text-align: center;
                position: relative;
            }

            .header::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>')
                    repeat;
                opacity: 0.3;
            }

            .header-content {
                position: relative;
                z-index: 1;
            }

            .header h1 {
                margin: 0 0 10px 0;
                font-size: 28px;
                font-weight: 700;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            .header p {
                margin: 0;
                font-size: 16px;
                opacity: 0.9;
            }

            .donation-icon {
                font-size: 48px;
                margin-bottom: 15px;
                display: block;
            }

            .content {
                padding: 30px 25px;
            }

            .donation-summary {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-radius: 10px;
                padding: 20px;
                margin-bottom: 25px;
                border-left: 4px solid #43b738;
            }

            .donation-amount {
                font-size: 24px;
                font-weight: 700;
                color: #1a685b;
                margin-bottom: 5px;
            }

            .donation-method {
                font-size: 14px;
                color: #6c757d;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .field {
                margin-bottom: 20px;
                background-color: #f8f9fa;
                border-radius: 8px;
                padding: 15px;
                border-left: 3px solid #43b738;
            }

            .field-label {
                font-weight: 600;
                color: #1a685b;
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 8px;
            }

            .field-value {
                font-size: 16px;
                color: #333;
                word-break: break-word;
            }

            .message-content {
                white-space: pre-wrap;
                background-color: white;
                padding: 15px;
                border-radius: 6px;
                border: 1px solid #e9ecef;
                font-style: italic;
            }

            .contact-info {
                background-color: #e8f5e8;
                border-radius: 8px;
                padding: 20px;
                margin-top: 25px;
                border: 1px solid #43b738;
            }

            .contact-info h3 {
                margin: 0 0 15px 0;
                color: #1a685b;
                font-size: 18px;
            }

            .contact-method {
                display: inline-block;
                background-color: #43b738;
                color: white;
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .footer {
                background-color: #1a685b;
                color: white;
                padding: 20px 25px;
                text-align: center;
                font-size: 14px;
            }

            .footer p {
                margin: 0;
                opacity: 0.9;
            }

            .timestamp {
                background-color: #f8f9fa;
                border-radius: 6px;
                padding: 15px;
                margin-top: 20px;
                text-align: center;
                border: 1px solid #e9ecef;
            }

            .timestamp strong {
                color: #1a685b;
            }

            .priority-badge {
                display: inline-block;
                background-color: #ffc107;
                color: #212529;
                padding: 4px 8px;
                border-radius: 12px;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-left: 10px;
            }

            @media (max-width: 600px) {
                body {
                    padding: 10px;
                }

                .header {
                    padding: 20px 15px;
                }

                .header h1 {
                    font-size: 24px;
                }

                .content {
                    padding: 20px 15px;
                }

                .donation-amount {
                    font-size: 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <div class="header-content">
                    <span class="donation-icon">💝</span>
                    <h1>New Donation Request</h1>
                    <p>ASN Upendo Village</p>
                </div>
            </div>

            <div class="content">
                @if($amount)
                <div class="donation-summary">
                    <div class="donation-amount">
                        {{ number_format($amount, 2) }} {{ $currency }}
                        <span class="priority-badge">High Priority</span>
                    </div>
                    <div class="donation-method">
                        Payment Method: {{ strtoupper($paymentMethod) }}
                    </div>
                </div>
                @endif

                <div class="field">
                    <div class="field-label">Donor Name</div>
                    <div class="field-value">{{ $donorName }}</div>
                </div>

                <div class="field">
                    <div class="field-label">Email Address</div>
                    <div class="field-value">{{ $donorEmail }}</div>
                </div>

                <div class="field">
                    <div class="field-label">Phone Number</div>
                    <div class="field-value">{{ $donorPhone }}</div>
                </div>

                @if($amount)
                <div class="field">
                    <div class="field-label">Donation Amount</div>
                    <div class="field-value">
                        {{ number_format($amount, 2) }} {{ $currency }}
                    </div>
                </div>
                @endif

                <div class="field">
                    <div class="field-label">Preferred Payment Method</div>
                    <div class="field-value">
                        {{ strtoupper($paymentMethod) }}
                    </div>
                </div>

                @if($contactMethod)
                <div class="field">
                    <div class="field-label">Preferred Contact Method</div>
                    <div class="field-value">{{ ucfirst($contactMethod) }}</div>
                </div>
                @endif @if($donationPurpose)
                <div class="field">
                    <div class="field-label">Donation Purpose</div>
                    <div class="field-value">{{ $donationPurpose }}</div>
                </div>
                @endif @if($donorMessage)
                <div class="field">
                    <div class="field-label">Message from Donor</div>
                    <div class="field-value message-content">
                        {{ $donorMessage }}
                    </div>
                </div>
                @endif

                <div class="contact-info">
                    <h3>📞 Next Steps</h3>
                    <p>Please contact the donor as soon as possible to:</p>
                    <ul style="margin: 10px 0; padding-left: 20px">
                        <li>Confirm the donation details</li>
                        <li>Provide payment instructions</li>
                        <li>Answer any questions they may have</li>
                        <li>Send a receipt once payment is received</li>
                    </ul>
                    @if($contactMethod)
                    <p>
                        <strong>Preferred contact method:</strong>
                        <span class="contact-method">{{
                            ucfirst($contactMethod)
                        }}</span>
                    </p>
                    @endif
                </div>

                <div class="timestamp">
                    <strong>Request submitted on:</strong> {{ $timestamp }}
                </div>
            </div>

            <div class="footer">
                <p>
                    This is an automated notification from ASN Upendo Village
                    website
                </p>
                <p>
                    Please respond to the donor promptly to maintain our
                    excellent donor relations
                </p>
            </div>
        </div>
    </body>
</html>
