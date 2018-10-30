<?php

namespace NFLScores\Commands;

use DateTime;
use DateTimeZone;
use ErrorException;
use LaravelZero\Framework\Commands\Command;
use NFLScores\Http\NFLHttpClient;
use NFLScores\Models\NFL;
use NFLScores\Utilities\Printer;

class FinishedCommand extends Command
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
        $nfl = new NFL(new NFLHttpClient(), new DateTime('now', new DateTimeZone('US/Eastern')));

        try {
            $games = (!is_null($this->argument('team')))
                ? $nfl->getFinishedGameByTeam($this->argument('team'))
                : $nfl->getFinishedGames();

            $printer = new Printer($this);
            $printer->renderScoreBoard($games);
        } catch (ErrorException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
