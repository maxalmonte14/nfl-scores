<?php

namespace App\Http;

use App\Interfaces\HttpClientInterface;

/**
 * HTTP client for getting
 * NFL games data.
 */
class NFLHttpClient implements HttpClientInterface
{
    const URL = 'https://feeds.nfl.com/feeds-rs/scores.json';

    /**
     * Gets and data from a remote source.
     *
     * @param string $url
     * @throws \ErrorException
     * 
     * @return string
     */
    public function get(string $url): string
    {
        return file_get_contents($url);
    }
}