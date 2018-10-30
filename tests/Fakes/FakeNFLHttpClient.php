<?php

namespace Tests\Fakes;

use NFLScores\Http\AbstractHttpClient;

/**
 * Fake HTTP client for testing purposes.
 */
class FakeNFLHttpClient extends AbstractHttpClient
{
    /**
     * Creates a new FakeNFLHttpClient object.
     */
    public function __construct()
    {
        $this->url = base_path('/tests/Unit/scores.json');;
    }

    /**
     * Gets data from a local JSON file.
     */
    public function get(): string
    {
        return file_get_contents($this->url);
    }
}
