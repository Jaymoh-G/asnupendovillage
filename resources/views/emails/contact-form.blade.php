<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>New Contact Form Submission</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                background-color: #43b738;
                color: white;
                padding: 20px;
                text-align: center;
                border-radius: 5px 5px 0 0;
            }
            .content {
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 0 0 5px 5px;
            }
            .field {
                margin-bottom: 15px;
            }
            .field-label {
                font-weight: bold;
                color: #43b738;
            }
            .field-value {
                margin-top: 5px;
                padding: 10px;
                background-color: white;
                border-left: 3px solid #43b738;
            }
            .message-content {
                white-space: pre-wrap;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>New Contact Form Submission</h1>
            <p>ASN Upendo Village Website</p>
        </div>

        <div class="content">
            <div class="field">
                <div class="field-label">Name:</div>
                <div class="field-value">{{ $name }}</div>
            </div>

            <div class="field">
                <div class="field-label">Email:</div>
                <div class="field-value">{{ $email }}</div>
            </div>

            <div class="field">
                <div class="field-label">Subject:</div>
                <div class="field-value">{{ $subject }}</div>
            </div>

            @if($phone)
            <div class="field">
                <div class="field-label">Phone:</div>
                <div class="field-value">{{ $phone }}</div>
            </div>
            @endif

            <div class="field">
                <div class="field-label">Message:</div>
                <div class="field-value message-content">
                    {{ $formMessage }}
                </div>
            </div>

            <hr
                style="margin: 30px 0; border: none; border-top: 1px solid #ddd"
            />

            <p><strong>Submitted on:</strong> {{ $timestamp }}</p>
        </div>
    </body>
</html>
