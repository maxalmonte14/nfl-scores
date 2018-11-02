<?php

namespace NFLScores\Commands;

use ErrorException;
use NFLScores\Utilities\Printer;

class FinishedCommand extends AbstractCommand
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'finished {team?}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show today\'s finished games';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $games = (!is_null($this->argument('team')))
                ? $this->NFL->getFinishedGameByTeam($this->argument('team'))
                : $this->NFL->getFinishedGames();

            if (is_null($games)) {
                exit($this->line('Sorry, there is no finished games at this moment.'));
            }

            $printer = new Printer($this);
            $printer->renderScoreBoard($games);
        } catch (ErrorException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
