<?php

namespace Tests\Feature;

use Tests\TestCase;

class FinishedCommandTest extends TestCase
{
    /** @test */
    public function it_can_get_all_finished_games()
    {
        $this->artisan('finished')
            ->expectsOutput('BAL VS DEN @ M&T Bank Stadium')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('|     | 1  | 2  | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('| BAL | 10 | 10 | 7 | 0 | 0  | 27 |')
            ->expectsOutput('| DEN | 14 | 0  | 0 | 0 | 0  | 14 |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('CAR VS CIN @ Bank of America Stadium')
            ->expectsOutput('+-----+---+----+---+---+----+----+')
            ->expectsOutput('|     | 1 | 2  | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+---+----+---+---+----+----+')
            ->expectsOutput('| CAR | 7 | 14 | 7 | 3 | 0  | 31 |')
            ->expectsOutput('| CIN | 7 | 7  | 7 | 0 | 0  | 21 |')
            ->expectsOutput('+-----+---+----+---+---+----+----+')
            ->expectsOutput('HOU VS NYG @ NRG Stadium')
            ->expectsOutput('+-----+---+----+---+----+----+----+')
            ->expectsOutput('|     | 1 | 2  | 3 | 4  | OT | T  |')
            ->expectsOutput('+-----+---+----+---+----+----+----+')
            ->expectsOutput('| HOU | 3 | 3  | 3 | 13 | 0  | 22 |')
            ->expectsOutput('| NYG | 7 | 13 | 0 | 7  | 0  | 27 |')
            ->expectsOutput('+-----+---+----+---+----+----+----+')
            ->expectsOutput('JAX VS TEN @ TIAA Bank Field')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4 | OT | T |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('| JAX | 0 | 3 | 0 | 3 | 0  | 6 |')
            ->expectsOutput('| TEN | 3 | 0 | 3 | 3 | 0  | 9 |')
            ->expectsOutput('+-----+---+---+---+---+----+---+')
            ->expectsOutput('KC VS SF @ Arrowhead Stadium')
            ->expectsOutput('+----+----+----+----+---+----+----+')
            ->expectsOutput('|    | 1  | 2  | 3  | 4 | OT | T  |')
            ->expectsOutput('+----+----+----+----+---+----+----+')
            ->expectsOutput('| KC | 14 | 21 | 0  | 3 | 0  | 38 |')
            ->expectsOutput('| SF | 0  | 10 | 14 | 3 | 0  | 27 |')
            ->expectsOutput('+----+----+----+----+---+----+----+')
            ->expectsOutput('MIA VS OAK @ Hard Rock Stadium')
            ->expectsOutput('+-----+---+---+---+----+----+----+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4  | OT | T  |')
            ->expectsOutput('+-----+---+---+---+----+----+----+')
            ->expectsOutput('| MIA | 0 | 7 | 7 | 14 | 0  | 28 |')
            ->expectsOutput('| OAK | 7 | 3 | 7 | 3  | 0  | 20 |')
            ->expectsOutput('+-----+---+---+---+----+----+----+')
            ->expectsOutput('MIN VS BUF @ U.S. Bank Stadium')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('|     | 1  | 2  | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('| MIN | 0  | 0  | 0 | 6 | 0  | 6  |')
            ->expectsOutput('| BUF | 17 | 10 | 0 | 0 | 0  | 27 |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('PHI VS IND @ Lincoln Financial Field')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->expectsOutput('| PHI | 7 | 3 | 3 | 7 | 0  | 20 |')
            ->expectsOutput('| IND | 7 | 0 | 6 | 3 | 0  | 16 |')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->expectsOutput('WAS VS GB @ FedExField')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('|     | 1  | 2  | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('| WAS | 14 | 14 | 0 | 3 | 0  | 31 |')
            ->expectsOutput('| GB  | 0  | 10 | 7 | 0 | 0  | 17 |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_get_a_finished_home_team_game()
    {
        $this->artisan('finished', ['team' => 'BAL'])
            ->expectsOutput('BAL VS DEN @ M&T Bank Stadium')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('|     | 1  | 2  | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('| BAL | 10 | 10 | 7 | 0 | 0  | 27 |')
            ->expectsOutput('| DEN | 14 | 0  | 0 | 0 | 0  | 14 |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->assertExitCode(0);
    }

    /** @test */
    public function it_can_get_a_finished_away_team_game()
    {
        $this->artisan('finished', ['CIN'])
            ->expectsOutput('CAR VS CIN @ Bank of America Stadium')
            ->expectsOutput('+-----+---+----+---+---+----+----+')
            ->expectsOutput('|     | 1 | 2  | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+---+----+---+---+----+----+')
            ->expectsOutput('| CAR | 7 | 14 | 7 | 3 | 0  | 31 |')
            ->expectsOutput('| CIN | 7 | 7  | 7 | 0 | 0  | 21 |')
            ->expectsOutput('+-----+---+----+---+---+----+----+')
            ->assertExitCode(0);
    }
}
