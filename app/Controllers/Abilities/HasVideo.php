<?php

namespace App\Controllers\Abilities;

trait HasVideo
{
    abstract public function allowedDomains(): array;
    
    public function extractPlatformAndId($url)
    {
        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'] ?? null;

        if (!$this->isAllowedDomain($host)) {
            return "Error: URL is not from an allowed domain.";
        }

        switch ($host) {
            case 'www.youtube.com':
            case 'youtube.com':
                return $this->extractYouTubeId($parsedUrl);
            case 'www.google.com':
            case 'google.com':
                return $this->extractGoogleId($parsedUrl);
            case 'geo.dailymotion.com':
            case 'www.dailymotion.com':
                return $this->extractDailymotionId($parsedUrl);
            case 'vimeo.com':
                return $this->extractVimeoId($parsedUrl);
            default:
                return "Error: Unsupported platform.";
        }
    }

    private function isAllowedDomain($host)
    {
        foreach ($this->allowedDomains() as $domain => $platform) {
            if (strpos($host, $domain) !== false) {
                return true;
            }
        }
        return false;
    }

    private function extractYouTubeId($parsedUrl)
    {
        parse_str($parsedUrl['query'] ?? '', $queryParams);
        if (isset($queryParams['v'])) {
            return ['platform' => 'youtube', 'id' => $queryParams['v']];
        }
        return "Error: Invalid YouTube URL.";
    }

    private function extractGoogleId($parsedUrl)
    {
        $path = trim($parsedUrl['path'] ?? '', '/');
        return ['platform' => 'google', 'id' => $path];
    }

    private function extractDailymotionId($parsedUrl)
    {
        $path = trim($parsedUrl['path'] ?? '', '/');
        return ['platform' => 'dailymotion', 'id' => $path];
    }

    private function extractVimeoId($parsedUrl)
    {
        $path = trim($parsedUrl['path'] ?? '', '/');
        return ['platform' => 'vimeo', 'id' => $path];
    }
}