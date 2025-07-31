<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donations = [
            [
                'donor_name' => 'John Doe',
                'donor_email' => 'john@example.com',
                'donor_phone' => '+254700000001',
                'amount' => 5000,
                'currency' => 'KES',
                'payment_method' => 'mpesa',
                'status' => 'completed',
                'transaction_reference' => 'MPESA-12345678',
                'meta' => [
                    'message' => 'Supporting the community development programs',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ],
            ],
            [
                'donor_name' => 'Jane Smith',
                'donor_email' => 'jane@example.com',
                'donor_phone' => '+254700000002',
                'amount' => 2500,
                'currency' => 'KES',
                'payment_method' => 'paypal',
                'status' => 'completed',
                'transaction_reference' => 'PAYPAL-87654321',
                'meta' => [
                    'message' => 'For education programs',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ],
            ],
            [
                'donor_name' => 'Michael Johnson',
                'donor_email' => 'michael@example.com',
                'donor_phone' => '+254700000003',
                'amount' => 10000,
                'currency' => 'KES',
                'payment_method' => 'mpesa',
                'status' => 'completed',
                'transaction_reference' => 'MPESA-11223344',
                'meta' => [
                    'message' => 'Supporting healthcare initiatives',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ],
            ],
            [
                'donor_name' => 'Sarah Wilson',
                'donor_email' => 'sarah@example.com',
                'donor_phone' => '+254700000004',
                'amount' => 1500,
                'currency' => 'KES',
                'payment_method' => 'paypal',
                'status' => 'pending',
                'transaction_reference' => 'PAYPAL-55667788',
                'meta' => [
                    'message' => 'For food security programs',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ],
            ],
            [
                'donor_name' => 'David Brown',
                'donor_email' => 'david@example.com',
                'donor_phone' => '+254700000005',
                'amount' => 7500,
                'currency' => 'KES',
                'payment_method' => 'mpesa',
                'status' => 'completed',
                'transaction_reference' => 'MPESA-99887766',
                'meta' => [
                    'message' => 'Supporting youth empowerment',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ],
            ],
            [
                'donor_name' => 'Emily Chen',
                'donor_email' => 'emily@example.com',
                'donor_phone' => '+254700000006',
                'amount' => 15000,
                'currency' => 'KES',
                'payment_method' => 'bank',
                'status' => 'pending',
                'transaction_reference' => 'BANK-11223344',
                'meta' => [
                    'message' => 'Corporate donation for community development',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ],
            ],
            [
                'donor_name' => 'Robert Wilson',
                'donor_email' => 'robert@example.com',
                'donor_phone' => '+254700000007',
                'amount' => 3000,
                'currency' => 'KES',
                'payment_method' => 'bank',
                'status' => 'completed',
                'transaction_reference' => 'BANK-55667788',
                'meta' => [
                    'message' => 'Monthly recurring donation',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ],
            ],
        ];

        foreach ($donations as $donation) {
            Donation::create($donation);
        }
    }
}
