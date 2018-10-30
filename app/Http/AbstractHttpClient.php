<?php

namespace NFLScores\Http;

use NFLScores\Interfaces\HttpClientInterface;

/**
 * Abstract HTTP client implementation.
 */
abstract class AbstractHttpClient implements HttpClientInterface
{
    /**
     * The URL for this client.
     *
     * @var string
     */
    protected $url;

    /**
     * Returns the url property.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url property.
     *
     * @param string $url
     *
     * @return void
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }
}
