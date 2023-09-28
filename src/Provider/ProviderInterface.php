<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Provider;

interface ProviderInterface
{
    public function fetchFromUrl(string $url): string;
}
