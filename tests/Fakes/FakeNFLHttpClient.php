<?php

namespace Tests\Fakes;

use App\Interfaces\HttpClientInterface;

/**
 * Fake HTTP client for testing purposes.
 */
class FakeNFLHttpClient implements HttpClientInterface
{
    /**
     * The path to the local JSON file.
     */
    const URL =  PROJECT_ROOT . '/tests/Unit/scores.json';

    /**
     * Get data from a local JSON file.
     */
    public function get(string $url): string
    {
        return file_get_contents($url);
    }
}