<?php

namespace NFLScores\Commands;

use ErrorException;
use NFLScores\Utilities\Printer;

class TodayCommand extends AbstractCommand
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'today';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show the scheduled games for today';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $todayGames = $this->NFL->getTodayGames();

            if (is_null($todayGames)) {
                exit($this->line('Sorry, there is no games scheduled for today.'));
            }

            $printer = new Printer($this);

            $printer->renderGamesList($todayGames);
        } catch (ErrorException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
