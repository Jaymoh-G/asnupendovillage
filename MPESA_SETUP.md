# M-Pesa Integration Setup Guide

## Overview

This guide explains how to set up M-Pesa STK push integration for the donation system.

## Environment Variables

Add the following variables to your `.env` file:

```env
# M-Pesa Configuration
MPESA_ENVIRONMENT=sandbox
MPESA_CONSUMER_KEY=your_consumer_key_here
MPESA_CONSUMER_SECRET=your_consumer_secret_here
MPESA_PASSKEY=your_passkey_here
MPESA_SHORTCODE=your_shortcode_here
MPESA_CALLBACK_URL=https://yourdomain.com/mpesa/callback
```

## Configuration Details

### MPESA_ENVIRONMENT

-   `sandbox` - For testing with M-Pesa sandbox
-   `live` - For production with real M-Pesa API

### MPESA_CONSUMER_KEY & MPESA_CONSUMER_SECRET

-   Get these from Safaricom Developer Portal
-   Used for API authentication

### MPESA_PASSKEY

-   Your M-Pesa passkey for generating passwords
-   Provided by Safaricom

### MPESA_SHORTCODE

-   Your M-Pesa business shortcode
-   Format: 6-digit number (e.g., 123456)

### MPESA_CALLBACK_URL

-   URL where M-Pesa will send payment confirmations
-   Must be publicly accessible
-   Format: `https://yourdomain.com/mpesa/callback`

## Getting M-Pesa Credentials

### 1. Register on Safaricom Developer Portal

-   Visit: https://developer.safaricom.co.ke/
-   Create an account and verify your email

### 2. Create an App

-   Go to "My Apps" section
-   Click "Create App"
-   Select "M-Pesa API" as the app type
-   Fill in required details

### 3. Get Credentials

-   Copy the Consumer Key and Consumer Secret
-   Note your Business Shortcode
-   Generate or copy your Passkey

### 4. Test with Sandbox

-   Use sandbox environment for testing
-   Test phone numbers are provided in the developer portal
-   Switch to live environment when ready for production

## Testing

### Sandbox Test Numbers

-   Use the test phone numbers provided by Safaricom
-   These numbers simulate M-Pesa transactions
-   No real money is involved

### Test Flow

1. Fill donation form with test phone number
2. Select M-Pesa as payment method
3. Submit form - STK push will be sent to test number
4. Check payment status in real-time
5. Verify callback processing

## Production Deployment

### 1. Switch to Live Environment

```env
MPESA_ENVIRONMENT=live
```

### 2. Update Credentials

-   Use production Consumer Key and Secret
-   Use production Business Shortcode and Passkey

### 3. Ensure Callback URL is Accessible

-   Must be publicly accessible
-   HTTPS is required for production
-   Test callback endpoint before going live

### 4. Monitor Logs

-   Check Laravel logs for any errors
-   Monitor M-Pesa API responses
-   Track successful and failed transactions

## Troubleshooting

### Common Issues

#### 1. Access Token Errors

-   Check Consumer Key and Secret
-   Verify API endpoint URLs
-   Check network connectivity

#### 2. STK Push Failures

-   Verify phone number format
-   Check amount limits
-   Ensure shortcode is correct

#### 3. Callback Issues

-   Verify callback URL is accessible
-   Check server logs for errors
-   Ensure proper error handling

#### 4. Transaction Status Issues

-   Check transaction reference format
-   Verify checkout request ID
-   Monitor API response codes

### Debug Mode

Enable debug logging in your `.env`:

```env
LOG_LEVEL=debug
```

## Security Considerations

### 1. Environment Variables

-   Never commit credentials to version control
-   Use different credentials for sandbox and production
-   Rotate credentials regularly

### 2. Callback Security

-   Validate callback data
-   Implement proper error handling
-   Log all callback attempts

### 3. Phone Number Validation

-   Validate phone number format
-   Implement rate limiting
-   Monitor for suspicious activity

## Support

For M-Pesa API issues:

-   Check Safaricom Developer Portal documentation
-   Contact Safaricom Developer Support
-   Review API response codes and error messages

For application issues:

-   Check Laravel logs
-   Verify configuration
-   Test with sandbox environment first
