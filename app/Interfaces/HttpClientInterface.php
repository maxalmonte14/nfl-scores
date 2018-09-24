<?php

namespace App\Interfaces;

interface HttpClientInterface
{
    public function get(string $url): string;
}