<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use App\Models\NFL;
use GuzzleHttp\Exception\RequestException;

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
        $nfl = new NFL();

        try {
            foreach ($nfl->getWeekGames() as $game) {
                $this->line(sprintf(
                    '%s VS %s @ %s %s',
                    $game->home['abbr'],
                    $game->away['abbr'],
                    $game->stadium,
                    $game->date->format('m/d/Y')
                ));
            }
        } catch (RequestException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));
        }
    }
}
