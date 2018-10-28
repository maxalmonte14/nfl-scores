<?php

namespace NFLScores\Utilities;

use NFLScores\Interfaces\ParserInterface;

/**
 * Parse JSON strings.
 */
class JSONParser implements ParserInterface
{
    /**
     * Converts a JSON string to array.
     *
     * @param string $data
     *
     * @return array
     */
    public static function parse(string $data): array
    {
        return json_decode($data, true);
    }
}