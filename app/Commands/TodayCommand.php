<?php

namespace NFLScores\Commands;

use DateTime;
use DateTimeZone;
use ErrorException;
use LaravelZero\Framework\Commands\Command;
use NFLScores\Http\NFLHttpClient;
use NFLScores\Models\NFL;
use NFLScores\Utilities\Printer;

class TodayCommand extends Command
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
        $nfl = new NFL(new NFLHttpClient(), new DateTime('now', new DateTimeZone('US/Eastern')));

        try {
            $data = [];
            $todayGames = $nfl->getTodayGames();

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
