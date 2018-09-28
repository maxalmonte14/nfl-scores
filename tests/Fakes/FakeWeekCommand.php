<?php

namespace Tests\Fakes;

use App\Commands\WeekCommand;

class FakeWeekCommand extends WeekCommand
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'fake:week';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Week command fake implementation';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $this->line('+------+---------+-------------------------------+------------+-------------+');
        $this->line('| Home | Visitor | Stadium                       | Date       | Hour        |');
        $this->line('+------+---------+-------------------------------+------------+-------------+');
        $this->line('| ATL  | NO      | Mercedes-Benz Stadium         | 09/23/2018 | 13:00:00 ET |');
        $this->line('| LA   | LAC     | Los Angeles Memorial Coliseum | 09/23/2018 | 16:05:00 ET |');
        $this->line('| ARI  | CHI     | State Farm Stadium            | 09/23/2018 | 16:25:00 ET |');
        $this->line('| SEA  | DAL     | CenturyLink Field             | 09/23/2018 | 16:25:00 ET |');
        $this->line('| DET  | NE      | Ford Field                    | 09/23/2018 | 20:20:00 ET |');
        $this->line('| BAL  | DEN     | M&T Bank Stadium              | 09/23/2018 | 13:00:00 ET |');
        $this->line('| CAR  | CIN     | Bank of America Stadium       | 09/23/2018 | 13:00:00 ET |');
        $this->line('| HOU  | NYG     | NRG Stadium                   | 09/23/2018 | 13:00:00 ET |');
        $this->line('| JAX  | TEN     | TIAA Bank Field               | 09/23/2018 | 13:00:00 ET |');
        $this->line('| KC   | SF      | Arrowhead Stadium             | 09/23/2018 | 13:00:00 ET |');
        $this->line('| MIA  | OAK     | Hard Rock Stadium             | 09/23/2018 | 13:00:00 ET |');
        $this->line('| MIN  | BUF     | U.S. Bank Stadium             | 09/23/2018 | 13:00:00 ET |');
        $this->line('| PHI  | IND     | Lincoln Financial Field       | 09/23/2018 | 13:00:00 ET |');
        $this->line('| WAS  | GB      | FedExField                    | 09/23/2018 | 13:00:00 ET |');
        $this->line('| TB   | PIT     | Raymond James Stadium         | 09/24/2018 | 20:15:00 ET |');
        $this->line('| CLE  | NYJ     | FirstEnergy Stadium           | 09/20/2018 | 20:20:00 ET |');
        $this->line('+------+---------+-------------------------------+------------+-------------+');
    }
}