<?php

namespace NFLScores\Models;

use NFLScores\Exceptions\NonExistingPropertyException;

/**
 * Represents a NFL game.
 */
class Game
{
    /**
     * The data about the game.
     *
     * @var array
     */
    private $data;

    /**
     * Populate the $data array.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Return the index stored in the $data
     * property, if doesn't exist throw an
     * exception.
     *
     * @param string $name
     *
     * @throws \NFLScores\Exceptions\NonExistingPropertyException
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        throw new NonExistingPropertyException(sprintf('There is not property called %s in this object', $name));
    }

    /**
     * Return the the current down,
     * if the game hasn't started return null.
     *
     * @return string|null
     */
    public function getCurrentDown(): ?string
    {
        if ($this->score['down'] === 0) {
            return null;
        }

        return sprintf(
            '%d%s & %d',
            $this->score['down'],
            getOrdinalSuffix($this->score['down']),
            $this->score['yardsToGo']
        );
    }

    /**
     * Return the team with the current
     * ball possesion, if the game hasn't
     * started return null.
     *
     * @return string|null
     */
    public function getPossesionTeam(): ?string
    {
        return !$this->isFinished() ? $this->score['possessionTeamAbbr'] : null;
    }

    /**
     * Return the the current quarter,
     * if the game hasn't started return null.
     *
     * @return string|null
     */
    public function getCurrentQuarter(): ?string
    {
        return $this->score['phaseDescription'];
    }

    /**
     * Return whether the game is
     * finished or not.
     *
     * @return bool
     */
    public function isFinished(): bool
    {
        return in_array($this->score['phase'], ['FINAL', 'FINAL OVERTIME']);
    }

    /**
     * Return whether the game is
     * suspended or not.
     *
     * @return bool
     */
    public function isSuspended(): bool
    {
        return $this->score['phase'] === 'SUSPENDED';
    }
}