<?php

namespace NFLScores\Commands;

use ErrorException;
use NFLScores\Http\NFLHttpClient;
use NFLScores\Models\NFL;
use NFLScores\Utilities\Printer;

class LiveCommand extends AbstractCommand
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'live {team?}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show the current live games';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $games = (!is_null($this->argument('team')))
                ? $this->NFL->getLiveGameByTeam($this->argument('team'))
                : $this->NFL->getLiveGames();

            $printer = new Printer($this);

            $printer->renderScoreBoard($games);
        } catch (ErrorException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
