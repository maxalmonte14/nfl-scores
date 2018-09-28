<?php

namespace Tests\Fakes;

use App\Commands\LiveCommand;

class FakeLiveCommand extends LiveCommand
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'fake:live';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Live command fake implementation';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $this->line('BAL VS BUF @ M&T Bank Stadium');
        $this->line('3rd Quarter | 13:48 | BAL 1st & 10');
        $this->line('+-----+----+----+---+---+----+----+');
        $this->line('|     | 1  | 2  | 3 | 4 | OT | T  |');
        $this->line('+-----+----+----+---+---+----+----+');
        $this->line('| BAL | 14 | 12 | 0 | 0 | 0  | 26 |');
        $this->line('| BUF | 0  | 0  | 0 | 0 | 0  | 0  |');
        $this->line('+-----+----+----+---+---+----+----+');
        $this->line('\n');
        $this->line('\n');
        $this->line('CLE VS PIT @ FirstEnergy Stadium');
        $this->line('3rd Quarter | 08:24 | PIT 1st & 10');
        $this->line('+-----+---+---+---+---+----+----+');
        $this->line('|     | 1 | 2 | 3 | 4 | OT | T  |');
        $this->line('+-----+---+---+---+---+----+----+');
        $this->line('| CLE | 0 | 0 | 7 | 0 | 0  | 7  |');
        $this->line('| PIT | 0 | 7 | 7 | 0 | 0  | 14 |');
        $this->line('+-----+---+---+---+---+----+----+');
    }
}