<?php

namespace MakeIT\LaravelFaviconExtractor;

use Illuminate\Support\Facades\Storage;

class FaviconExtractorHelper
{
    /**
     * check if url is valid (string)
     */
    public static function is_url(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function fetch_favicon(string $url, string $host): string
    {
        return FaviconExtractor::fromUrl($url)->fetchAndSaveTo(storage_path('app/public/favicons/' . $host));
    }

    /**
     * Delete domain favicons
     */
    public static function destroy_favicons(string $host): bool
    {
        return Storage::delete(static::domain_favicons($host));
    }

    /**
     * List of files uploaded for domain directory
     */
    public static function domain_favicons(string $host): array
    {
        return Storage::allFiles('/favicons/' . $host);
    }
}
