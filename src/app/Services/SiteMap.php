<?php

namespace Mc388\SimpleCms\App\Services;

use Mc388\SimpleCms\App\Models\Content;
use Illuminate\Support\Facades\Cache;

/**
 * Class SiteMap
 *
 * @package Mc388\SimpleCms\Services
 */
class SiteMap
{
    /**
     * Return the content of the Site Map
     *
     * @param string $url
     *
     * @return string
     */
    public function getSiteMap($url)
    {
        if (Cache::has('site-map')) {
            return Cache::get('site-map');
        }

        $siteMap = $this->buildSiteMap($url);
        Cache::add('site-map', $siteMap, 120);
        return $siteMap;
    }

    /**
     * Build the Site Map
     *
     * @param string $url
     *
     * @return string
     */
    protected function buildSiteMap($url)
    {
        $contentsInfo = $this->getContentsInfo();
        $dates = array_values($contentsInfo);
        sort($dates);
        $lastmod = last($dates);
        $lastUpdateFormatted = date('c', strtotime($lastmod));

        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?' . '>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $xml[] = '  <url>';
        $xml[] = "    <loc>$url</loc>";
        $xml[] = "    <lastmod>$lastUpdateFormatted</lastmod>";
        $xml[] = '    <changefreq>daily</changefreq>';
        $xml[] = '    <priority>0.8</priority>';
        $xml[] = '  </url>';

        foreach ($contentsInfo as $slug => $lastmod) {
            $lastUpdateFormatted = date('c', strtotime($lastmod));
            $xml[] = '  <url>';
            $xml[] = "    <loc>{$url}contents/$slug</loc>";
            $xml[] = "    <lastmod>$lastUpdateFormatted</lastmod>";
            $xml[] = "  </url>";
        }

        $xml[] = '</urlset>';

        return join("\n", $xml);
    }

    /**
     * Return all the posts as $url => $date
     */
    protected function getContentsInfo()
    {
        return Content::where('type', '=', Content::TYPE_SITE)
            ->orderBy('created_at', 'desc')
            ->lists('updated_at', 'slug')
            ->all();
    }
}
