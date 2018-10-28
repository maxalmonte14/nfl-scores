<?php

namespace NFLScores\Commands;

use \ErrorException;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use NFLScores\Models\NFL;
use NFLScores\Utilities\Printer;
use NFLScores\Http\NFLHttpClient;

class LiveCommand extends Command
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
        $nfl = new NFL(new NFLHttpClient());

        try {
            $games = (!is_null($this->argument('team')))
                ? $nfl->getLiveGameByTeam($this->argument('team'))
                : $nfl->getLiveGames();

            $printer = new Printer($this);

            $printer->renderScoreBoard($games);
        } catch (ErrorException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
