<?php

namespace App\Models;

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
        unset($data['bp'], $data['note'], $data['redzone'], $data['media'], $data['yl']);
        $this->data = $data;
    }

    /**
     * Return the index stored in the $data
     * property, if doesn't exist throw an
     * exception.
     * 
     * @param string $name
     * @throws \Exception
     * 
     * @return mixed
     */
    public function __get(string $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        throw new \Exception(sprintf('There is not property called %s in this object', $name));
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
        return in_array($this->qtr, [1, 2, 3, 4, 5]) ? $this->posteam : null;
    }

    /**
     * Return the the current quarter,
     * if the game hasn't started return null.
     * 
     * @return string|null
     */
    public function getCurrentQuarter(): ?string
    {
        if (!is_numeric($this->qtr)) {
            return null;
        }

        return sprintf('%d%s quarter', $this->qtr, getOrdinalSuffix($this->qtr));
    }

    /**
     * Return the the current down,
     * if the game hasn't started return null.
     * 
     * @return string|null
     */
    public function getCurrentDown(): ?string
    {
        if ($this->down === 0) {
            return null;
        }

        return sprintf('%d%s & %d', $this->down, getOrdinalSuffix($this->down), $this->togo);
    }

    /**
     * Return whether the game is
     * finished or not.
     * 
     * @return bool
     */
    public function isFinished(): bool
    {
        return in_array($this->qtr, ['Final', 'final overtime']);
    }
}