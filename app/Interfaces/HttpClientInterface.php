<?php

namespace NFLScores\Interfaces;

interface HttpClientInterface
{
    public function get(string $url): string;

    public static function getUrl(): string;
}