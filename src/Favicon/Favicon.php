<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Favicon;

class Favicon implements FaviconInterface
{
    private string $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
