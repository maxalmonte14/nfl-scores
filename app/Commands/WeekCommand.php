<?php

namespace NFLScores\Commands;

use NFLScores\Models\NFL;
use ErrorException;
use NFLScores\Utilities\Printer;
use NFLScores\Http\NFLHttpClient;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class WeekCommand extends Command
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
        $nfl = new NFL(new NFLHttpClient());

        try {
            $printer = new Printer($this);

            $printer->renderGamesList($nfl->getWeekGames());
        } catch (ErrorException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
