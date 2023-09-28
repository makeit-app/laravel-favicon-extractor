<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Favicon;

interface FaviconFactoryInterface
{
    public function create(string $content): Favicon;
}
