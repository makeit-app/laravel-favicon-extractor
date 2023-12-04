<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use MakeIT\LaravelFaviconExtractor\Exception\FaviconCouldNotBeSavedException;
use MakeIT\LaravelFaviconExtractor\Favicon\FaviconFactoryInterface;
use MakeIT\LaravelFaviconExtractor\Favicon\FaviconInterface;
use MakeIT\LaravelFaviconExtractor\Generator\FilenameGeneratorInterface;
use MakeIT\LaravelFaviconExtractor\Provider\ProviderInterface;

class FaviconExtractor implements FaviconExtractorInterface
{
    private FaviconFactoryInterface $faviconFactory;

    private ProviderInterface $provider;

    private FilenameGeneratorInterface $filenameGenerator;

    private FaviconInterface $favicon;

    private string $url;

    public function __construct(FaviconFactoryInterface $faviconFactory, ProviderInterface $provider, FilenameGeneratorInterface $filenameGenerator)
    {
        $this->provider = $provider;
        $this->faviconFactory = $faviconFactory;
        $this->filenameGenerator = $filenameGenerator;
    }

    public function fromUrl(string $url): FaviconExtractorInterface
    {
        $this->url = $url;

        return $this;
    }

    public function fetchAndSaveTo(string $path, string $filename = null): string
    {
        if (null === $filename) {
            $filename = $this->filenameGenerator->generate(config('favicon-extractor.filename_generator_length'));
        }
        $favicon = $this->fetchOnly();
        $targetPath = $this->getTargetPath($path, $filename);
        if (!Storage::put($targetPath, $favicon->getContent())) {
            throw new FaviconCouldNotBeSavedException(
                sprintf(
                    'The favicon of %s could not be saved at path "%s" ',
                    $this->getUrl(),
                    $targetPath
                )
            );
        }

        return Str::replaceFirst(storage_path('app/public/'), '', $targetPath);
    }

    public function fetchOnly(): FaviconInterface
    {
        $this->favicon = $this->faviconFactory->create(
            $this->provider->fetchFromUrl($this->getUrl())
        );

        return $this->favicon;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    private function getTargetPath(string $path, string $filename): string
    {
        return $path.DIRECTORY_SEPARATOR.$filename.'.png';
    }
}
