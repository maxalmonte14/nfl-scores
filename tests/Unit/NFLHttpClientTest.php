<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fakes\FakeNFLHttpClient;

class NFLHttpClientTest extends TestCase
{
    /** @test */
    public function it_can_get_data_in_json_format()
    {
        $NFLHttpClient = new FakeNFLHttpClient();

        $this->assertJson($NFLHttpClient->get(FakeNFLHttpClient::getUrl()));
    }
}