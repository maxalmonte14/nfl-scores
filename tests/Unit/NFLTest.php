<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\NFL;
use App\Models\Game;
use PHPCollections\Collections\GenericList;

class NFLTest extends TestCase
{
    private $nflMock;
    private $nflNoDataMock;

    public static function setUpBeforeClass()
    {
        $games = json_decode(file_get_contents(__DIR__ . '/scores.json'), true);
        $lap = 0;
        $newData = [];

        foreach ($games as $key => $game) {
            if ($lap >= 1 && $lap <= 13) {
                $newData[date("Ymd") . str_pad($lap, 2, 0, STR_PAD_LEFT)] = $game;
            } else {
                $newData[$key] = $game;
            }
            
            $lap++;
        }

        file_put_contents(__DIR__ . '/scores.json', json_encode($newData));
    }

    public function setUp() :void
    {
        $this->nflMock =  
            $this->getMockBuilder(NFL::class)
                 ->setMethods(['getRemoteData', 'getFinishedGames'])
                 ->getMock();

        $this->nflMock->method('getRemoteData')
            ->willReturn(json_decode(file_get_contents(__DIR__ . '/scores.json'), true));

        $this->nflMock->method('getFinishedGames')
            ->willReturn(new GenericList(Game::class, [
                new Game([]),
                new Game([])
            ]));

        $this->nflNoDataMock =  
            $this->getMockBuilder(NFL::class)
                    ->setMethods(['getRemoteData'])
                    ->getMock();

        $this->nflNoDataMock->method('getRemoteData')
            ->willReturn([]);
    }

    /** @test */
    public function it_can_get_today_games()
    {
        $todayGames = $this->nflMock->getTodayGames();

        $this->assertCount(13, $todayGames);
        $this->assertInstanceOf(GenericList::class, $todayGames);
    }

    /** @test */
    public function it_cannot_get_today_games_when_there_is_no_games()
    {
        $todayGames = $this->nflNoDataMock->getTodayGames();

        $this->assertNull($todayGames);
    }
    
    /** @test */
    public function it_can_get_last_week_games()
    {
        $weekGames = $this->nflMock->getWeekGames();
        
        $this->assertCount(16, $weekGames);
        $this->assertInstanceOf(GenericList::class, $weekGames);
    }

    /** @test */
    public function it_can_get_live_games()
    {
        $liveGames = $this->nflMock->getLiveGames();

        $this->assertCount(11, $liveGames);
        $this->assertInstanceOf(GenericList::class, $liveGames);
    }

    /** @test */
    public function it_cannot_get_live_games_when_there_is_no_games()
    {
        $weekGames = $this->nflNoDataMock->getLiveGames();

        $this->assertNull($weekGames);
    }

    /** @test */
    public function it_can_get_a_specific_team_live_game()
    {
        $liveGame = $this->nflMock->getLiveGameByTeam('IND');

        $this->assertCount(1, $liveGame);
        $this->assertEquals('IND', $liveGame->first()->home['abbr']);
        $this->assertInstanceOf(GenericList::class, $liveGame);
    }

    /** @test */
    public function it_cannot_get_a_specific_team_live_game_when_the_team_is_not_playing()
    {
        $liveGame = $this->nflNoDataMock->getLiveGameByTeam('IND');

        $this->assertNull($liveGame);
    }

    /** @test */
    public function it_can_get_all_finished_games()
    {
        $finishedGames = $this->nflMock->getFinishedGames();

        $this->assertCount(2, $finishedGames);
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
