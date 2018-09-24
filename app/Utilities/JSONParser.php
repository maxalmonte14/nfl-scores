<?php

namespace App\Utilities;

use App\Interfaces\ParserInterface;

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