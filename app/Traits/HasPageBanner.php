<?php

namespace App\Traits;

use App\Models\PageBanner;

trait HasPageBanner
{
    /**
     * Get page banner for a specific page
     */
    public function getPageBanner($pageName)
    {
        return PageBanner::getBannerForPage($pageName);
    }

    /**
     * Get banner image URL for a page
     */
    public function getBannerImageUrl($pageName)
    {
        $banner = $this->getPageBanner($pageName);
        return $banner ? $banner->effectiveBannerUrl : asset('assets/img/bg/breadcumb-bg.jpg');
    }

    /**
     * Get page title from banner or fallback
     */
    public function getPageTitle($pageName, $fallbackTitle = null)
    {
        $banner = $this->getPageBanner($pageName);
        return $banner && $banner->title ? $banner->title : $fallbackTitle;
    }

    /**
     * Get page description from banner
     */
    public function getPageDescription($pageName)
    {
        $banner = $this->getPageBanner($pageName);
        return $banner ? $banner->description : null;
    }
}
