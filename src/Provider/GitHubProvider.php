<?php

declare(strict_types=1);

namespace MakeIT\LaravelFaviconExtractor\Provider;

use GrahamCampbell\GuzzleFactory\GuzzleFactory;
use GuzzleHttp\Exception\GuzzleException;

class GitHubProvider implements ProviderInterface
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
        $domain = preg_replace('/https?:\/\/(www\.)?([\w\-\.]+)\/?.*/i', '$2', $url);

        return 'https://favicons.githubusercontent.com/'.urlencode($domain);
    }
}
