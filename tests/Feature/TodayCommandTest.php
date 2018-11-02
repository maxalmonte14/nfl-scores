<?php

namespace Tests\Feature;

use Tests\TestCase;

class TodayCommandTest extends TestCase
{
    /** @test */
    public function it_can_get_all_today_games()
    {
        $this->artisan('today')
            ->expectsOutput('+------+---------+-------------------------------+------------+-------------+')
            ->expectsOutput('| Home | Visitor | Stadium                       | Date       | Hour        |')
            ->expectsOutput('+------+---------+-------------------------------+------------+-------------+')
            ->expectsOutput('| LA   | LAC     | Los Angeles Memorial Coliseum | 10/30/2018 | 16:05:00 ET |')
            ->expectsOutput('| ARI  | CHI     | State Farm Stadium            | 10/30/2018 | 16:25:00 ET |')
            ->expectsOutput('| SEA  | DAL     | CenturyLink Field             | 10/30/2018 | 16:25:00 ET |')
            ->expectsOutput('| DET  | NE      | Ford Field                    | 10/30/2018 | 20:20:00 ET |')
            ->expectsOutput('| BAL  | DEN     | M&T Bank Stadium              | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('| CAR  | CIN     | Bank of America Stadium       | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('| HOU  | NYG     | NRG Stadium                   | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('| JAX  | TEN     | TIAA Bank Field               | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('| KC   | SF      | Arrowhead Stadium             | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('| MIA  | OAK     | Hard Rock Stadium             | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('| MIN  | BUF     | U.S. Bank Stadium             | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('| PHI  | IND     | Lincoln Financial Field       | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('| WAS  | GB      | FedExField                    | 10/30/2018 | 13:00:00 ET |')
            ->expectsOutput('+------+---------+-------------------------------+------------+-------------+')
            ->assertExitCode(0);
    }
}
