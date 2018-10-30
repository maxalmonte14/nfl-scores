<?php

namespace NFLScores\Interfaces;

interface ParserInterface
{
    public static function parse(string $data): array;
}
