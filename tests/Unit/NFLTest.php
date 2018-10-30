<?php

namespace Tests\Unit;

use DateTime;
use DateTimeZone;
use NFLScores\Models\NFL;
use PHPCollections\Collections\GenericList;
use Tests\Fakes\FakeNFLHttpClient;
use Tests\TestCase;

class NFLTest extends TestCase
{
    private $NFL;

    public function setUp(): void
    {
        parent::setUp();

        $this->NFL = new NFL(new FakeNFLHttpClient(), new DateTime('2018-10-30', new DateTimeZone('US/Eastern')));
    }

    /** @test */
    public function it_can_get_today_games()
    {
        $todayGames = $this->NFL->getTodayGames();

        $this->assertCount(13, $todayGames);
        $this->assertInstanceOf(GenericList::class, $todayGames);
    }

    /** @test */
    public function it_cannot_get_today_games_when_there_is_none()
    {
        $NFLMock = \Mockery::mock('NFLScores\Models\NFL');

        $NFLMock->allows()
            ->getTodayGames()
            ->andReturns(null);

        $this->assertNull($NFLMock->getTodayGames());
    }

    /** @test */
    public function it_can_get_current_week_games()
    {
        $weekGames = $this->NFL->getWeekGames();

        $this->assertCount(16, $weekGames);
        $this->assertInstanceOf(GenericList::class, $weekGames);
    }

    /** @test */
    public function it_can_get_live_games()
    {
        $liveGames = $this->NFL->getLiveGames();

        $this->assertCount(5, $liveGames);
        $this->assertInstanceOf(GenericList::class, $liveGames);
    }

    /** @test */
    public function it_cannot_get_live_games_when_there_is_no_games()
    {
        $NFLMock = \Mockery::mock('NFLScores\Models\NFL');

        $NFLMock->allows()
            ->getLiveGames()
            ->andReturns(null);

        $this->assertNull($NFLMock->getLiveGames());
    }

    /** @test */
    public function it_can_get_a_specific_team_live_game()
    {
        $liveGame = $this->NFL->getLiveGameByTeam('ATL');

        $this->assertCount(1, $liveGame);
        $this->assertEquals('ATL', $liveGame->first()->gameSchedule['homeTeam']['abbr']);
        $this->assertInstanceOf(GenericList::class, $liveGame);
    }

    /** @test */
    public function it_cannot_get_a_specific_team_live_game_when_the_team_is_not_playing()
    {
        $liveGame = $this->NFL->getLiveGameByTeam('IND');

        $this->assertNull($liveGame);
    }

    /** @test */
    public function it_can_get_all_finished_games()
    {
        $finishedGames = $this->NFL->getFinishedGames();

        $this->assertCount(9, $finishedGames);
        $this->assertInstanceOf(GenericList::class, $finishedGames);
    }

    /** @test */
    public function it_cannot_get_the_finished_games_when_there_is_none()
    {
        $NFLMock = $this->createMock(NFL::class);

        $NFLMock->expects($this->once())
            ->method('getFinishedGames')
            ->willReturn(null);

        $finishedGames = $NFLMock->getFinishedGames();

        $this->assertNull($finishedGames);
    }
}
