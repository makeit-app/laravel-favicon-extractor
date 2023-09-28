<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Provider;

use GrahamCampbell\GuzzleFactory\GuzzleFactory;
use GuzzleHttp\Exception\GuzzleException;

class GoogleProvider implements ProviderInterface
{
    /**
     * @throws GuzzleException
     */
    public function fetchFromUrl(string $url): string
    {
        $client = GuzzleFactory::make();
        $response = $client->get($this->getUrl($url));

        return $response->getBody()->getContents();
    }

    private function getUrl(string $url): string
    {
        return 'https://www.google.com/s2/favicons?domain='.urlencode($url);
    }
}
