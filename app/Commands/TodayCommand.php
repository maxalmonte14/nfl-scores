<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use App\Models\NFL;
use GuzzleHttp\Exception\RequestException;

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
        $nfl = new NFL();

        try {
            $todayGames = $nfl->getTodayGames();

            if (is_null($todayGames)) {
                exit($this->line('Sorry, there is games scheduled for today.'));
            }

            foreach ($nfl->getTodayGames() as $game) {
                $this->line(sprintf('%s VS %s @ %s', $game->home['abbr'], $game->away['abbr'], $game->stadium));
            }
        } catch (RequestException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
