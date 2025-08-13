<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaticPage;

class AboutUsStaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create About Us static page
        StaticPage::create([
            'page_name' => 'about-us',
            'title' => 'About Us - ASN Upendo Village',
            'content' => '<p>Welcome to ASN Upendo Village, a beacon of hope and compassion in our community. We are dedicated to making a positive impact through various charitable initiatives and programs that help people from all walks of life access the tools, training, and support they need to be more effective and make our world a better place.</p>
            
            <p>Founded in 2010, ASN Upendo Village has been at the forefront of community development, providing essential services and support to those who need it most. Our mission is to create lasting positive change through education, healthcare, food security, and community empowerment programs.</p>
            
            <p>We believe that every individual has the potential to make a difference, and through our collaborative efforts, we can build stronger, more resilient communities that thrive together.</p>',
            'meta_title' => 'About Us - ASN Upendo Village | Community Development & Charity',
            'meta_description' => 'Learn about ASN Upendo Village, our mission, values, and commitment to community development. Discover how we help people access tools, training, and support.',
            'meta_keywords' => 'about us, community development, charity, ASN Upendo Village, community support, charitable initiatives',
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }
}
