<?php

namespace Tests\Feature;

use Tests\TestCase;

class LiveCommandTest extends TestCase
{
    public function setUp() :void
    {
        parent::setUp();
    }

    /** @test */
    public function test_live_command_returns_two_games()
    {
        $this->artisan('fake:live')
            ->expectsOutput('BAL VS BUF @ M&T Bank Stadium')
            ->expectsOutput('3rd Quarter | 13:48 | BAL 1st & 10')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('|     | 1  | 2  | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('| BAL | 14 | 12 | 0 | 0 | 0  | 26 |')
            ->expectsOutput('| BUF | 0  | 0  | 0 | 0 | 0  | 0  |')
            ->expectsOutput('+-----+----+----+---+---+----+----+')
            ->expectsOutput('\n')
            ->expectsOutput('\n')
            ->expectsOutput('CLE VS PIT @ FirstEnergy Stadium')
            ->expectsOutput('3rd Quarter | 08:24 | PIT 1st & 10')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->expectsOutput('| CLE | 0 | 0 | 7 | 0 | 0  | 7  |')
            ->expectsOutput('| PIT | 0 | 7 | 7 | 0 | 0  | 14 |')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->assertExitCode(0);
    }
}
