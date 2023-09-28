<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Generator;

use Illuminate\Support\Str;

class FilenameGenerator implements FilenameGeneratorInterface
{
    public function generate(int $length): string
    {
        return Str::random($length);
    }
}
