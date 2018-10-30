<?php

namespace Tests\Feature;

use Tests\TestCase;

class TodayCommandTest extends TestCase
{
    /** @test */
    public function test_today_command_returns_two_games()
    {
        $this->artisan('fake:today')
            ->expectsOutput('+------+---------+-------------------------------+------------+-------------+')
            ->expectsOutput('| Home | Visitor | Stadium                       | Date       | Hour        |')
            ->expectsOutput('+------+---------+-------------------------------+------------+-------------+')
            ->expectsOutput('| ATL  | NO      | Mercedes-Benz Stadium         | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| LA   | LAC     | Los Angeles Memorial Coliseum | 09/23/2018 | 16:05:00 ET |')
            ->expectsOutput('| ARI  | CHI     | State Farm Stadium            | 09/23/2018 | 16:25:00 ET |')
            ->expectsOutput('| SEA  | DAL     | CenturyLink Field             | 09/23/2018 | 16:25:00 ET |')
            ->expectsOutput('| DET  | NE      | Ford Field                    | 09/23/2018 | 20:20:00 ET |')
            ->expectsOutput('| BAL  | DEN     | M&T Bank Stadium              | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| CAR  | CIN     | Bank of America Stadium       | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| HOU  | NYG     | NRG Stadium                   | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| JAX  | TEN     | TIAA Bank Field               | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| KC   | SF      | Arrowhead Stadium             | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| MIA  | OAK     | Hard Rock Stadium             | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| MIN  | BUF     | U.S. Bank Stadium             | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| PHI  | IND     | Lincoln Financial Field       | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('| WAS  | GB      | FedExField                    | 09/23/2018 | 13:00:00 ET |')
            ->expectsOutput('+------+---------+-------------------------------+------------+-------------+')
            ->assertExitCode(0);
    }
}
