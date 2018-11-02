<?php

namespace Tests\Feature;

use Tests\TestCase;

class LiveCommandTest extends TestCase
{
    /** @test */
    public function it_can_get_all_live_games()
    {
        $this->artisan('live')
            ->expectsOutput('LA VS LAC @ Los Angeles Memorial Coliseum')
            ->expectsOutput('1st Quarter | 00:51 | LA 1st & 10')
            ->expectsOutput('+-----+----+---+---+---+----+----+')
            ->expectsOutput('|     | 1  | 2 | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+----+---+---+---+----+----+')
            ->expectsOutput('| LA  | 14 | 0 | 0 | 0 | 0  | 14 |')
            ->expectsOutput('| LAC | 6  | 0 | 0 | 0 | 0  | 6  |')
            ->expectsOutput('+-----+----+---+---+---+----+----+')
            ->expectsOutput('ARI VS CHI @ State Farm Stadium')
            ->expectsOutput('1st Quarter | 07:35 | CHI 1st & 10')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4 | OT | T |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('| ARI | 7 | 0 | 0 | 0 | 0  | 7 |')
            ->expectsOutput('| CHI | 0 | 0 | 0 | 0 | 0  | 0 |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('SEA VS DAL @ CenturyLink Field')
            ->expectsOutput('1st Quarter | 06:48 | DAL 2nd & 3')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4 | OT | T |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('| SEA | 0 | 0 | 0 | 0 | 0  | 0 |')
            ->expectsOutput('| DAL | 0 | 0 | 0 | 0 | 0  | 0 |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('DET VS NE @ Ford Field')
            ->expectsOutput('PREGAME | 15:00 | NE ')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4 | OT | T |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('| DET | 0 | 0 | 0 | 0 | 0  | 0 |')
            ->expectsOutput('| NE  | 0 | 0 | 0 | 0 | 0  | 0 |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_get_a_live_home_team_game()
    {
        $this->artisan('live', ['team' => 'LA'])
            ->expectsOutput('LA VS LAC @ Los Angeles Memorial Coliseum')
            ->expectsOutput('1st Quarter | 00:51 | LA 1st & 10')
            ->expectsOutput('+-----+----+---+---+---+----+----+')
            ->expectsOutput('|     | 1  | 2 | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+----+---+---+---+----+----+')
            ->expectsOutput('| LA  | 14 | 0 | 0 | 0 | 0  | 14 |')
            ->expectsOutput('| LAC | 6  | 0 | 0 | 0 | 0  | 6  |')
            ->expectsOutput('+-----+----+---+---+---+----+----+')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_get_a_live_away_team_game()
    {
        $this->artisan('live', ['team' => 'DAL'])
            ->expectsOutput('SEA VS DAL @ CenturyLink Field')
            ->expectsOutput('1st Quarter | 06:48 | DAL 2nd & 3')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4 | OT | T |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('| SEA | 0 | 0 | 0 | 0 | 0  | 0 |')
            ->expectsOutput('| DAL | 0 | 0 | 0 | 0 | 0  | 0 |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->assertExitCode(0);
    }
}
