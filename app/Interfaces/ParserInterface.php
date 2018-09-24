<?php

namespace App\Interfaces;

interface ParserInterface
{
    public static function parse(string $data): array;
}