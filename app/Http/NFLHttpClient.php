<?php

namespace NFLScores\Http;

/**
 * HTTP client for getting
 * NFL games data.
 */
class NFLHttpClient extends AbstractHttpClient
{
    /**
     * {@inheritdoc}
     */
    protected $url = 'https://feeds.nfl.com/feeds-rs/scores.json';

    /**
     * Gets and data from a remote source.
     *
     * @param string $url
     *
     * @throws \ErrorException
     *
     * @return string
     */
    public function get(): string
    {
        return file_get_contents($this->url);
    }
}
