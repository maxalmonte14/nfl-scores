<?php

namespace NFLScores\Interfaces;

interface HttpClientInterface
{
    public function get(): string;
}
