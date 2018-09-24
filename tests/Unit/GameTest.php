<?php

namespace Tests\Unit;

use Tests\TestCase;;
use Tests\Fakes\FakeNFLHttpClient;
use App\Models\Game;
use App\Models\NFL;

class GameTest extends TestCase
{
    private $NFL;

    public function setUp() :void
    {
        $this->NFL = new NFL(new FakeNFLHttpClient());
    }

    /** @test */
    public function it_can_get_the_possesion_team_of_a_started_game()
    {
        $game = $this->NFL->getLiveGameByTeam('NO')->first();
        $this->assertEquals('NO', $game->getPossesionTeam());
    }

    /** @test */
    public function it_cannot_get_the_possesion_team_of_a_non_started_game()
    {
        $gameMock = \Mockery::mock('App\Models\Game');
        
        $gameMock->allows()
            ->getPossesionTeam()
            ->andReturns(null);

        $this->assertNull($gameMock->getPossesionTeam());
    }

    /** @test */
    public function it_can_get_the_current_quarter_of_a_started_game()
    {
        $game = $this->NFL->getLiveGameByTeam('NO')->first();
        $this->assertEquals('Over Time', $game->getCurrentQuarter());
    }

    /** @test */
    public function it_cannot_get_the_current_quarter_of_a_non_started_game()
    {
        $gameMock = \Mockery::mock('App\Models\Game');
        
        $gameMock->allows()
            ->getCurrentQuarter()
            ->andReturns(null);

        $this->assertNull($gameMock->getCurrentQuarter());
    }

    /** @test */
    public function it_can_get_the_current_down_of_a_started_game()
    {
        $game = $this->NFL->getLiveGameByTeam('NO')->first();
        $this->assertEquals('1st & 10', $game->getCurrentDown());
    }

    /** @test */
    public function it_cannot_get_the_current_down_of_a_non_started_game()
    {
        $gameMock = \Mockery::mock('App\Models\Game');
        
        $gameMock->allows()
            ->getCurrentDown()
            ->andReturns(null);

        $this->assertNull($gameMock->getCurrentDown());
    }
}