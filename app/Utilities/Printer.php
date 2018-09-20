<?php

namespace App\Utilities;

use LaravelZero\Framework\Commands\Command;
use PHPCollections\Collections\GenericList;

class Printer
{
    /**
     * The command which will be execute.
     *
     * @var \LaravelZero\Framework\Commands\Command
     */
    private $command;

    /**
     * Initialize values.
     * 
     * @param \LaravelZero\Framework\Commands\Command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Build and print the terminal output.
     * 
     * @param \App\Models\Game $game
     * 
     * @return void
     */
    public function printScoreBoard($game): void
    {
        $this->command->line(sprintf('%s VS %s @ %s', $game->home['abbr'], $game->away['abbr'], $game->stadium));
        
        if (!$game->isFinished()) {
            $this->command->line(sprintf(
                '%s | %s | %s %s',
                $game->getCurrentQuarter(),
                $game->clock,
                $game->getPossesionTeam(),
                $game->getCurrentDown()
            ));
        }

        $this->command->table(
            ['','1','2','3','4','OT','T'],
            [
                $this->getTeamScore($game->home['abbr'], $game->home['score']),
                $this->getTeamScore($game->away['abbr'], $game->away['score'])
            ]
        );

        $this->command->line("\n");
    }

    /**
     * Print a collection of games
     * into the terminal.
     * 
     * @param PHPCollections\Collections\GenericList
     * 
     * @return void
     */
    public function render(?GenericList $games): void
    {
        if (is_null($games)) {
            exit($this->command->line('Sorry, there is no games right now.'));
        }

        foreach ($games as $game) {
            $this->printScoreBoard($game);
        }
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