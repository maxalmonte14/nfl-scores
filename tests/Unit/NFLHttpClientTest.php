<?php

namespace Tests\Unit;

use Tests\Fakes\FakeNFLHttpClient;
use Tests\TestCase;

class NFLHttpClientTest extends TestCase
{
    /** @test */
    public function it_can_get_data_in_json_format()
    {
        $NFLHttpClient = new FakeNFLHttpClient();

        $this->assertJson($NFLHttpClient->get());
    }
}
