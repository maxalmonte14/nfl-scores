<?php

namespace Tests\Fakes;

use App\Commands\FinishedCommand;

class FakeFinishedCommand extends FinishedCommand
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'fake:finished';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Finished command fake implementation';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $this->line('PHI VS ATL @ Lincoln Financial Field');
        $this->line('+-----+---+---+---+---+----+----+');
        $this->line('|     | 1 | 2 | 3 | 4 | OT | T  |');
        $this->line('+-----+---+---+---+---+----+----+');
        $this->line('| PHI | 0 | 3 | 7 | 8 | 0  | 18 |');
        $this->line('| ATL | 3 | 3 | 0 | 6 | 0  | 12 |');
        $this->line('+-----+---+---+---+---+----+----+');
        $this->line('\n');
        $this->line('BAL VS BUF @ M&T Bank Stadium');
        $this->line('+-----+----+----+----+---+----+----+');
        $this->line('|     | 1  | 2  | 3  | 4 | OT | T  |');
        $this->line('+-----+----+----+----+---+----+----+');
        $this->line('| BAL | 14 | 12 | 14 | 8 | 0  | 47 |');
        $this->line('| BUF | 0  | 0  | 3  | 0 | 0  | 3  |');
        $this->line('+-----+----+----+----+---+----+----+');
    }
}