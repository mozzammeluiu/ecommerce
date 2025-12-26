<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // System Settings
            ['type' => 'system_default_currency', 'value' => '1'],
            ['type' => 'home_default_currency', 'value' => '1'],
            ['type' => 'current_version', 'value' => '1.0'],
            ['type' => 'maintenance_mode', 'value' => '0'],

            // Feature Toggles
            ['type' => 'vendor_system_activation', 'value' => '1'],
            ['type' => 'conversation_system', 'value' => '1'],
            ['type' => 'coupon_system', 'value' => '1'],
            ['type' => 'wallet_system', 'value' => '1'],
            ['type' => 'email_verification', 'value' => '0'],
            ['type' => 'guest_checkout_active', 'value' => '1'],
            ['type' => 'pickup_point', 'value' => '0'],
            ['type' => 'verification_form', 'value' => '0'],

            // Social Login
            ['type' => 'google_login', 'value' => '0'],
            ['type' => 'facebook_login', 'value' => '0'],
            ['type' => 'twitter_login', 'value' => '0'],

            // Payment Gateways
            ['type' => 'cash_payment', 'value' => '1'],
            ['type' => 'stripe_payment', 'value' => '0'],
            ['type' => 'paypal_payment', 'value' => '0'],
            ['type' => 'paypal_sandbox', 'value' => '1'],
            ['type' => 'sslcommerz_payment', 'value' => '0'],
            ['type' => 'sslcommerz_sandbox', 'value' => '1'],
            ['type' => 'instamojo_payment', 'value' => '0'],
            ['type' => 'instamojo_sandbox', 'value' => '1'],
            ['type' => 'razorpay', 'value' => '0'],
            ['type' => 'paystack', 'value' => '0'],
            ['type' => 'voguepay', 'value' => '0'],
            ['type' => 'voguepay_sandbox', 'value' => '1'],

            // Analytics & Tracking
            ['type' => 'google_analytics', 'value' => ''],
            ['type' => 'facebook_pixel', 'value' => ''],
            ['type' => 'facebook_chat', 'value' => ''],

            // Commission
            ['type' => 'vendor_commission', 'value' => '10'],
            ['type' => 'category_wise_commission', 'value' => '0'],

            // Product Display
            ['type' => 'best_selling', 'value' => '12'],
        ];

        foreach ($settings as $setting) {
            DB::table('business_settings')->updateOrInsert(
                ['type' => $setting['type']],
                [
                    'value' => $setting['value'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
