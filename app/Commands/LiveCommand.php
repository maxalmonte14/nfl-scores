<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use App\Models\NFL;
use GuzzleHttp\Exception\RequestException;

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
        $nfl = new NFL();
        
        try {
            $games = (!is_null($this->argument('team')))
                ? $nfl->getLiveGameByTeam($this->argument('team'))
                : $nfl->getLiveGames();
        } catch (RequestException $e) {
            exit($this->line('Sorry, there was a problem fetching the remote data.'));            
        }

        if (is_null($games)) {
            exit($this->line('Sorry, there is no live games right now.'));
        }

        foreach ($games as $game) {
            $this->printOutput($game);
        }
    }

    /**
     * Build and print the terminal output.
     * 
     * @param App\Models\Game $game
     */
    private function printOutput($game): void
    {
        $this->line(sprintf('%s VS %s @ %s', $game->home['abbr'], $game->away['abbr'], $game->stadium));
        $this->line(sprintf(
            "%s | %s | %s %s",
            $game->getCurrentQuarter(),
            $game->clock,
            $game->getPossesionTeam(),
            $game->getCurrentDown()
        ));

        $this->table(
            ['','1','2','3','4','OT','T'],
            [
                $this->getTeamScore($game->home['abbr'], $game->home['score']),
                $this->getTeamScore($game->away['abbr'], $game->away['score'])
            ]
        );

        $this->line("\n");
    }

    /**
     * Return an array with the name and
     * score of a specific team.
     * 
     * @param string $abbr
     * @param array $score
     * 
     * @return array
     */
    private function getTeamScore(string $abbr, array $score): array
    {
        array_unshift($score, $abbr);
        return $score;
    }
}
