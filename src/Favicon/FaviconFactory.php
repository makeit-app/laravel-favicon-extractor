<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Favicon;

class FaviconFactory implements FaviconFactoryInterface
{
    public function create(string $content): Favicon
    {
        return new Favicon($content);
    }
}
