<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaticPage;

class DonationStaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create donation static page
        StaticPage::updateOrCreate(
            ['page_name' => 'donation'],
            [
                'title' => 'Support Our Mission',
                'content' => 'Your generous donation helps us continue our work in supporting communities and making a positive impact in people\'s lives.',
                'is_active' => true,
                'sort_order' => 5,

                // Section 1: Process Step 1
                'section1_title' => 'Awareness & Engagement',
                'section1_content' => '<p>We inform and engage potential donors and supporters about our mission and the causes we support through various channels including social media, community events, and direct outreach.</p>
                <ul>
                    <li>Social media campaigns and storytelling</li>
                    <li>Community events and presentations</li>
                    <li>Partnership with local organizations</li>
                    <li>Transparent communication about our impact</li>
                </ul>',

                // Section 2: Process Step 2
                'section2_title' => 'Donation Collection',
                'section2_content' => '<p>We provide a secure and user-friendly donation platform that accepts multiple payment methods and allows for both one-time and recurring donations.</p>
                <ul>
                    <li>Multiple payment options (M-Pesa, PayPal, Bank Transfer)</li>
                    <li>Secure payment processing</li>
                    <li>One-time and recurring donation options</li>
                    <li>Instant donation confirmation</li>
                    <li>Tax-deductible receipts</li>
                </ul>',

                // Section 3: Process Step 3
                'section3_title' => 'Impact and Accountability',
                'section3_content' => '<p>We allocate funds to specific projects and initiatives that align with our mission, ensuring that resources are used efficiently and effectively.</p>
                <ul>
                    <li>Project-based fund allocation</li>
                    <li>Regular impact assessments and reporting</li>
                    <li>Transparent financial management</li>
                    <li>Donor updates and progress reports</li>
                    <li>Community feedback and evaluation</li>
                </ul>',

                // SEO
                'meta_title' => 'Donate to ASN Upendo Village - Support Our Mission',
                'meta_description' => 'Make a difference today by donating to ASN Upendo Village. Your generous contribution helps us support communities and create lasting positive change.',
                'meta_keywords' => 'donate, charity, community support, humanitarian aid, sustainable development, Kenya, Africa',
            ]
        );
    }
}
