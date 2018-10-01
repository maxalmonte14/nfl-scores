<?php

namespace App\Http;

use App\Interfaces\HttpClientInterface;

/**
 * HTTP client for getting
 * NFL games data.
 */
class NFLHttpClient implements HttpClientInterface
{
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

    /**
     * Returns the url that this client will be using.
     */
    public static function getUrl(): string
    {
        return 'https://feeds.nfl.com/feeds-rs/scores.json'; 
    }
}