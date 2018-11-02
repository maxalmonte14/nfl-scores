<?php

namespace NFLScores\Commands;

use ErrorException;
use NFLScores\Utilities\Printer;

class WeekCommand extends AbstractCommand
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'week';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show the scheduled games for the week';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $printer = new Printer($this);

            $printer->renderGamesList($this->NFL->getWeekGames());
        } catch (ErrorException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
