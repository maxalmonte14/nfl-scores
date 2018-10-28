<?php

namespace Tests\Fakes;

use NFLScores\Interfaces\HttpClientInterface;

/**
 * Fake HTTP client for testing purposes.
 */
class FakeNFLHttpClient implements HttpClientInterface
{
    /**
     * Gets data from a local JSON file.
     */
    public function get(string $url): string
    {
        return file_get_contents($url);
    }

    /**
     * Returns the url that this client will be using.
     */
    public static function getUrl(): string
    {
        return base_path('/tests/Unit/scores.json');
    }
}
