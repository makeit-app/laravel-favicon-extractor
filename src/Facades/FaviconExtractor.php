<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Facades;

use Illuminate\Support\Facades\Facade;
use MakeIT\LaravelFaviconExtractor\Favicon\FaviconInterface;
use MakeIT\LaravelFaviconExtractor\FaviconExtractorInterface;

/**
 * @method FaviconExtractorInterface fromUrl(string $url)
 * @method string fetchAndSaveTo(string $path, string $filename = null)
 * @method FaviconInterface fetchOnly()
 * @method string getUrl()
 * @method string getTargetPath(string $path, string $filename)
 */
class FaviconExtractor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'favicon.extractor';
    }
}
