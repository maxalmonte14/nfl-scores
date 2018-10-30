<?php

namespace Tests\Unit;

use DateTime;
use DateTimeZone;
use NFLScores\Exceptions\NonExistingPropertyException;
use NFLScores\Models\NFL;
use Tests\Fakes\FakeNFLHttpClient;
use Tests\TestCase;

class GameTest extends TestCase
{
    private $NFL;

    public function setUp() :void
    {
        $this->NFL = new NFL(new FakeNFLHttpClient(), new DateTime('2018-10-30', new DateTimeZone('US/Eastern')));

        parent::setUp();
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
        $gameMock = \Mockery::mock('NFLScores\Models\Game');

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
        $gameMock = \Mockery::mock('NFLScores\Models\Game');

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
        $gameMock = \Mockery::mock('NFLScores\Models\Game');

        $gameMock->allows()
            ->getCurrentDown()
            ->andReturns(null);

        $this->assertNull($gameMock->getCurrentDown());
    }

    /** @test */
    public function it_throws_exception_when_you_try_to_call_a_non_existing_property()
    {
        $this->expectException(NonExistingPropertyException::class);
        $this->expectExceptionMessage('There is not property called nonExistingProperty in this object');

        $game = $this->NFL->getLiveGames()->first();

        $game->nonExistingProperty; // Here a NonExistingPropertyException is thrown!
    }
}
