<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Favicon;

interface FaviconInterface
{
    public function getContent(): string;
}
