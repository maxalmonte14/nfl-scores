<?php

namespace Tests\Unit;

use Tests\TestCase;
use NFLScores\Utilities\JSONParser;

class JSONParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_a_json_string()
    {
        $JSONData = '{"firstname":"Max","lastname":"Almonte","occupation":"Software developer","age":"24"}';
        $parsedData = JSONParser::parse($JSONData);

        $this->assertCount(4, $parsedData);
        $this->assertEquals('Max', $parsedData['firstname']);
    }

    /** @test */
    public function it_can_parse_an_array_of_json_string()
    {
        $JSONData = '[{"movie":"Fight Club","rating":"9.8"},{"movie":"V for Vendetta","rating":"7.0"},{"movie":"He got game","rating":"8.5"}]';
        $parsedData = JSONParser::parse($JSONData);

        $this->assertCount(3, $parsedData);
        $this->assertEquals('Fight Club', $parsedData[0]['movie']);
    }
}