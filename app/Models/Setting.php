<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'sort_order'
    ];

    protected $casts = [
        'value' => 'json',
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value)
    {
        $setting = static::where('key', $key)->first();

        if ($setting) {
            $setting->update(['value' => $value]);
        } else {
            static::create([
                'key' => $key,
                'value' => $value,
                'type' => 'text',
                'group' => 'general',
                'label' => ucfirst(str_replace('_', ' ', $key))
            ]);
        }

        // Clear cache
        Cache::forget('settings');

        return $setting;
    }

    /**
     * Get all settings grouped by category
     */
    public static function getAllGrouped()
    {
        return Cache::remember('settings', 3600, function () {
            return static::orderBy('sort_order')->get()->groupBy('group');
        });
    }

    /**
     * Get settings by group
     */
    public static function getByGroup($group)
    {
        return static::where('group', $group)->orderBy('sort_order')->get();
    }

    /**
     * Clear settings cache
     */
    public static function clearCache()
    {
        Cache::forget('settings');
    }

    /**
     * Get contact information
     */
    public static function getContactInfo()
    {
        return [
            'email' => static::get('contact_email'),
            'phone' => static::get('contact_phone'),
            'address' => static::get('contact_address'),
            'google_map_link' => static::get('google_map_link'),
        ];
    }

    /**
     * Get social media links
     */
    public static function getSocialLinks()
    {
        return [
            'facebook' => static::get('social_facebook'),
            'twitter' => static::get('social_twitter'),
            'instagram' => static::get('social_instagram'),
            'linkedin' => static::get('social_linkedin'),
            'youtube' => static::get('social_youtube'),
        ];
    }

    /**
     * Get payment details
     */
    public static function getPaymentDetails()
    {
        return [
            'bank_name' => static::get('payment_bank_name'),
            'account_name' => static::get('payment_account_name'),
            'account_number' => static::get('payment_account_number'),
            'branch' => static::get('payment_branch'),
            'swift_code' => static::get('payment_swift_code'),
        ];
    }

    /**
     * Get footer information
     */
    public static function getFooterInfo()
    {
        return [
            'logo' => static::get('footer_logo'),
            'about' => static::get('footer_about'),
            'quick_links' => static::get('footer_quick_links'),
        ];
    }

    /**
     * Get Mailchimp settings
     */
    public static function getMailchimpSettings()
    {
        return [
            'api_key' => static::get('mailchimp_api_key'),
            'list_id' => static::get('mailchimp_list_id'),
            'enabled' => static::get('mailchimp_enabled', false),
        ];
    }
}
