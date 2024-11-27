<?php

use App\Models\SystemSettings;

if (!function_exists('getSiteName')) {
    function getSiteName()
    {
        $settings = SystemSettings::first();
        return $settings ? $settings->site_name : config('app.name');
    }

    function getSiteLogo()
    {
        $settings = SystemSettings::first();
        return $settings ? $settings->image_path : config('app.name');
    }

    function getSiteContact()
    {
        $settings = SystemSettings::first();
        return $settings ? $settings->site_contact : config('app.name');
    }
}