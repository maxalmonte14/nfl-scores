<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use App\Models\NFL;
use App\Utilities\Printer;
use GuzzleHttp\Exception\RequestException;

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
        $nfl = new NFL();
        
        try {
            $games = (!is_null($this->argument('team')))
                ? $nfl->getFinishedGameByTeam($this->argument('team'))
                : $nfl->getFinishedGames();
        } catch (RequestException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));            
        }

        $printer = new Printer($this);
        $printer->render($games);
    }
}
