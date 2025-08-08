<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'info@asnupendovillage.org',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Primary contact email address',
                'sort_order' => 1,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+254 700 000 000',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Primary contact phone number',
                'sort_order' => 2,
            ],
            [
                'key' => 'contact_address',
                'value' => 'Nairobi, Kenya',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Contact Address',
                'description' => 'Physical address of the organization',
                'sort_order' => 3,
            ],
            [
                'key' => 'google_map_link',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.819424!2d36.8176!3d-1.2921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1b90e87d30f7%3A0x38921a7a009a91ee!2sNairobi%2C%20Kenya!5e0!3m2!1sen!2ske!4v1753067850826!5m2!1sen!2ske',
                'type' => 'url',
                'group' => 'contact',
                'label' => 'Google Map Link',
                'description' => 'Google Maps embed link for location',
                'sort_order' => 4,
            ],

            // Social Media Links
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/asnupendovillage',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Facebook page URL',
                'sort_order' => 1,
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/asnupendovillage',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Twitter URL',
                'description' => 'Twitter profile URL',
                'sort_order' => 2,
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/asnupendovillage',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Instagram profile URL',
                'sort_order' => 3,
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/asnupendovillage',
                'type' => 'url',
                'group' => 'social',
                'label' => 'LinkedIn URL',
                'description' => 'LinkedIn company page URL',
                'sort_order' => 4,
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://youtube.com/@asnupendovillage',
                'type' => 'url',
                'group' => 'social',
                'label' => 'YouTube URL',
                'description' => 'YouTube channel URL',
                'sort_order' => 5,
            ],

            // Payment Details
            [
                'key' => 'payment_bank_name',
                'value' => 'Equity Bank Kenya',
                'type' => 'text',
                'group' => 'payment',
                'label' => 'Bank Name',
                'description' => 'Bank name for donations',
                'sort_order' => 1,
            ],
            [
                'key' => 'payment_account_name',
                'value' => 'ASN Upendo Village',
                'type' => 'text',
                'group' => 'payment',
                'label' => 'Account Name',
                'description' => 'Bank account name',
                'sort_order' => 2,
            ],
            [
                'key' => 'payment_account_number',
                'value' => '1234567890',
                'type' => 'text',
                'group' => 'payment',
                'label' => 'Account Number',
                'description' => 'Bank account number',
                'sort_order' => 3,
            ],
            [
                'key' => 'payment_branch',
                'value' => 'Nairobi Main Branch',
                'type' => 'text',
                'group' => 'payment',
                'label' => 'Branch',
                'description' => 'Bank branch name',
                'sort_order' => 4,
            ],
            [
                'key' => 'payment_swift_code',
                'value' => 'EQBLKEXX',
                'type' => 'text',
                'group' => 'payment',
                'label' => 'Swift Code',
                'description' => 'Bank swift code',
                'sort_order' => 5,
            ],

            // Mailchimp Integration
            [
                'key' => 'mailchimp_api_key',
                'value' => '',
                'type' => 'password',
                'group' => 'mailchimp',
                'label' => 'Mailchimp API Key',
                'description' => 'Mailchimp API key for email marketing',
                'sort_order' => 1,
            ],
            [
                'key' => 'mailchimp_list_id',
                'value' => '',
                'type' => 'text',
                'group' => 'mailchimp',
                'label' => 'Mailchimp List ID',
                'description' => 'Mailchimp audience/list ID',
                'sort_order' => 2,
            ],
            [
                'key' => 'mailchimp_enabled',
                'value' => false,
                'type' => 'boolean',
                'group' => 'mailchimp',
                'label' => 'Enable Mailchimp',
                'description' => 'Enable Mailchimp integration',
                'sort_order' => 3,
            ],

            // Footer Settings
            [
                'key' => 'footer_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'footer',
                'label' => 'Footer Logo',
                'description' => 'Logo to display in footer',
                'sort_order' => 1,
            ],
            [
                'key' => 'footer_about',
                'value' => 'ASN Upendo Village is dedicated to supporting communities in need through various programs and initiatives.',
                'type' => 'textarea',
                'group' => 'footer',
                'label' => 'Footer About Text',
                'description' => 'Brief description for footer',
                'sort_order' => 2,
            ],
            [
                'key' => 'footer_quick_links',
                'value' => json_encode([
                    ['title' => 'About Us', 'url' => '/about-us'],
                    ['title' => 'Our Programs', 'url' => '/programs'],
                    ['title' => 'Donate', 'url' => '/donate-now'],
                    ['title' => 'Contact', 'url' => '/contact-us'],
                ]),
                'type' => 'json',
                'group' => 'footer',
                'label' => 'Footer Quick Links',
                'description' => 'Quick links to display in footer',
                'sort_order' => 3,
            ],

            // General Settings
            [
                'key' => 'site_name',
                'value' => 'ASN Upendo Village',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'Website name',
                'sort_order' => 1,
            ],
            [
                'key' => 'site_description',
                'value' => 'Supporting communities in need through various programs and initiatives.',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Description',
                'description' => 'Website description for SEO',
                'sort_order' => 2,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
