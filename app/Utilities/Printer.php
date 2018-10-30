<?php

namespace NFLScores\Utilities;

use LaravelZero\Framework\Commands\Command;
use NFLScores\Models\Game;
use PHPCollections\Collections\GenericList;

/**
 * Utility class for printing
 * elements into the console.
 */
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
     * Return an array with the name and
     * score of a specific team.
     *
     * @param string $abbr
     * @param array  $score
     *
     * @return array
     */
    private function buildScoreBoardRow(string $abbr, array $score): array
    {
        return [
            $abbr,
            $score['pointQ1'],
            $score['pointQ2'],
            $score['pointQ3'],
            $score['pointQ4'],
            $score['pointOT'],
            $score['pointTotal'],
        ];
    }

    /**
     * Build and print a game' scoreboard
     * into the terminal.
     *
     * @param \NFLScores\Models\Game $game
     *
     * @return void
     */
    private function printScoreBoard(Game $game): void
    {
        $this->printScoreBoardHeader($game);

        $this->command->table(
            ['', '1', '2', '3', '4', 'OT', 'T'],
            [
                $this->buildScoreBoardRow($game->gameSchedule['homeTeamAbbr'], $game->score['homeTeamScore']),
                $this->buildScoreBoardRow($game->gameSchedule['visitorTeamAbbr'], $game->score['visitorTeamScore']),
            ]
        );

        $this->command->line("\n");
    }

    /**
     * Build and print the scoreboard header.
     *
     * @param \NFLScores\Models\Game $game
     *
     * @return void
     */
    public function printScoreBoardHeader(Game $game)
    {
        $this->command->line(
            sprintf(
                '%s VS %s @ %s',
                $game->gameSchedule['homeTeamAbbr'],
                $game->gameSchedule['visitorTeamAbbr'],
                $game->gameSchedule['site']['siteFullname']
            )
        );

        if (!$game->isFinished()) {
            $this->command->line(sprintf(
                '%s | %s | %s %s',
                $game->getCurrentQuarter(),
                $game->score['time'],
                $game->getPossesionTeam(),
                $game->getCurrentDown()
            ));
        }
    }

    /**
     * Print a table with a list of games.
     *
     * @param \PHPCollections\Collections\GenericList $gameCollection
     *
     * @return void
     */
    public function renderGamesList(?GenericList $gameCollection): void
    {
        $data = [];

        $gameCollection->forEach(function ($game, $key) use (&$data) {
            array_push($data, [
                $game->gameSchedule['homeTeamAbbr'],
                $game->gameSchedule['visitorTeamAbbr'],
                $game->gameSchedule['site']['siteFullname'],
                $game->gameSchedule['gameDate'],
                sprintf('%s ET', $game->gameSchedule['gameTimeEastern']),
            ]);
        });

        $this->command->table(['Home', 'Visitor', 'Stadium', 'Date', 'Hour'], $data);
    }

    /**
     * Print a collection of game'
     * scoreboards into the terminal.
     *
     * @param PHPCollections\Collections\GenericList
     *
     * @return void
     */
    public function renderScoreBoard(?GenericList $games): void
    {
        if (is_null($games)) {
            exit($this->command->line('Sorry, there is no games right now.'));
        }

        $games->forEach(function ($game, $key) {
            $this->printScoreBoard($game);
        });
    }
}
