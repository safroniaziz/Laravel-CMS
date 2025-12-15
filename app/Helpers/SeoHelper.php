<?php

namespace App\Helpers;

use App\Models\Setting;

class SeoHelper
{
    protected $title;
    protected $description;
    protected $keywords;
    protected $ogImage;
    protected $canonical;
    protected $robots = 'index,follow';

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        $siteName = Setting::get('site_name', 'CMS');

        if ($this->title) {
            return $this->title . ' - ' . $siteName;
        }

        return Setting::get('seo_meta_title', $siteName);
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description ?? Setting::get('seo_meta_description', '');
    }

    public function setKeywords($keywords)
    {
        if (is_array($keywords)) {
            $keywords = implode(', ', $keywords);
        }

        $this->keywords = $keywords;
        return $this;
    }

    public function getKeywords()
    {
        return $this->keywords ?? Setting::get('seo_meta_keywords', '');
    }

    public function setOgImage($image)
    {
        $this->ogImage = $image;
        return $this;
    }

    public function getOgImage()
    {
        if ($this->ogImage) {
            return asset($this->ogImage);
        }

        $logo = Setting::get('site_logo');
        return $logo ? asset('storage/' . $logo) : asset('images/default-og.jpg');
    }

    public function setCanonical($url)
    {
        $this->canonical = $url;
        return $this;
    }

    public function getCanonical()
    {
        return $this->canonical ?? url()->current();
    }

    public function setRobots($robots)
    {
        $this->robots = $robots;
        return $this;
    }

    public function getRobots()
    {
        return $this->robots;
    }

    public function renderTags()
    {
        $html = [];

        // Title
        $html[] = '<title>' . e($this->getTitle()) . '</title>';

        // Meta Description
        if ($description = $this->getDescription()) {
            $html[] = '<meta name="description" content="' . e($description) . '">';
        }

        // Meta Keywords
        if ($keywords = $this->getKeywords()) {
            $html[] = '<meta name="keywords" content="' . e($keywords) . '">';
        }

        // Robots
        $html[] = '<meta name="robots" content="' . $this->getRobots() . '">';

        // Canonical
        $html[] = '<link rel="canonical" href="' . $this->getCanonical() . '">';

        // Open Graph Tags
        $html[] = '<meta property="og:title" content="' . e($this->getTitle()) . '">';
        $html[] = '<meta property="og:description" content="' . e($this->getDescription()) . '">';
        $html[] = '<meta property="og:image" content="' . $this->getOgImage() . '">';
        $html[] = '<meta property="og:url" content="' . $this->getCanonical() . '">';
        $html[] = '<meta property="og:type" content="website">';

        // Twitter Card Tags
        $html[] = '<meta name="twitter:card" content="summary_large_image">';
        $html[] = '<meta name="twitter:title" content="' . e($this->getTitle()) . '">';
        $html[] = '<meta name="twitter:description" content="' . e($this->getDescription()) . '">';
        $html[] = '<meta name="twitter:image" content="' . $this->getOgImage() . '">';

        return implode("\n    ", $html);
    }

    public function renderSchema($type = 'Organization')
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => $type,
            'name' => Setting::get('site_name', 'CMS'),
            'url' => url('/'),
            'logo' => $this->getOgImage(),
        ];

        if ($type === 'Organization') {
            $schema['contactPoint'] = [
                '@type' => 'ContactPoint',
                'telephone' => Setting::get('contact_phone', ''),
                'contactType' => 'customer service',
                'email' => Setting::get('contact_email', ''),
            ];

            $schema['address'] = [
                '@type' => 'PostalAddress',
                'addressLocality' => Setting::get('contact_address', ''),
            ];

            // Social Media
            $socialLinks = [];
            if ($fb = Setting::get('social_facebook')) $socialLinks[] = $fb;
            if ($tw = Setting::get('social_twitter')) $socialLinks[] = $tw;
            if ($ig = Setting::get('social_instagram')) $socialLinks[] = $ig;
            if ($li = Setting::get('social_linkedin')) $socialLinks[] = $li;
            if ($yt = Setting::get('social_youtube')) $socialLinks[] = $yt;

            if (!empty($socialLinks)) {
                $schema['sameAs'] = $socialLinks;
            }
        }

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}

