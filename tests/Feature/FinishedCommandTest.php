<?php

namespace Tests\Feature;

use Tests\TestCase;

class FinishedCommandTest extends TestCase
{
    public function setUp() :void
    {
        parent::setUp();
    }

    /** @test */
    public function test_finished_command_returns_two_games()
    {
        $this->artisan('fake:finished')
            ->expectsOutput('PHI VS ATL @ Lincoln Financial Field')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->expectsOutput('|     | 1 | 2 | 3 | 4 | OT | T  |')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->expectsOutput('| PHI | 0 | 3 | 7 | 8 | 0  | 18 |')
            ->expectsOutput('| ATL | 3 | 3 | 0 | 6 | 0  | 12 |')
            ->expectsOutput('+-----+---+---+---+---+----+----+')
            ->expectsOutput('\n')
            ->expectsOutput('BAL VS BUF @ M&T Bank Stadium')
            ->expectsOutput('+-----+----+----+----+---+----+----+')
            ->expectsOutput('|     | 1  | 2  | 3  | 4 | OT | T  |')
            ->expectsOutput('+-----+----+----+----+---+----+----+')
            ->expectsOutput('| BAL | 14 | 12 | 14 | 8 | 0  | 47 |')
            ->expectsOutput('| BUF | 0  | 0  | 3  | 0 | 0  | 3  |')
            ->expectsOutput('+-----+----+----+----+---+----+----+')
            ->assertExitCode(0);
    }
}
