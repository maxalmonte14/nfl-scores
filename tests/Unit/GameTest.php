<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Game;

class GameTest extends TestCase
{
    private $startedGame;
    private $nonStartedGame;

    public function setUp() :void
    {
        $this->startedGame = new Game([
            'down' => 1,
            'togo' => 10,
            'clock' => '13:48',
            'posteam' => 'BAL',
            'stadium' => 'M&T Bank Stadium',
            'qtr' => '3'
        ]);

        $this->nonStartedGame = new Game([
            'down' => 0,
            'togo' => 0,
            'clock' => '15:00',
            'posteam' => 'KC',
            'stadium' => 'ROKiT Field at StubHub Center',
            'qtr' => 'Pregame'
        ]);
    }

    /** @test */
    public function it_can_get_the_possesion_team_of_a_started_game()
    {
        $this->assertEquals('BAL', $this->startedGame->getPossesionTeam());
    }

    /** @test */
    public function it_cannot_get_the_possesion_team_of_a_non_started_game()
    {
        $this->assertNull($this->nonStartedGame->getPossesionTeam());
    }

    /** @test */
    public function it_can_get_the_current_quarter_of_a_started_game()
    {
        $this->assertEquals('3rd quarter', $this->startedGame->getCurrentQuarter());
    }

    /** @test */
    public function it_cannot_get_the_current_quarter_of_a_non_started_game()
    {
        $this->assertNull($this->nonStartedGame->getCurrentQuarter());
    }

    /** @test */
    public function it_can_get_the_current_down_of_a_started_game()
    {
        $this->assertEquals('1st & 10', $this->startedGame->getCurrentDown());
    }

    /** @test */
    public function it_cannot_get_the_current_down_of_a_non_started_game()
    {
        $this->assertNull($this->nonStartedGame->getCurrentDown());
    }
}