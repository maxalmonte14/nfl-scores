<?php

namespace App\Models;

use GuzzleHttp\Client;
use PHPCollections\Collections\GenericList;

class NFL
{
    /**
     * HTTP client.
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * The remote data source.
     *
     * @var string
     */
    private $url;

    /**
     * Initialize values.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->url = 'http://www.nfl.com/liveupdate/scores/scores.json';
    }

    /**
     * Gets and decode data from
     * the remote source.
     * 
     * @throws \GuzzleHttp\Exception\RequestException
     * 
     * @return array
     */
    public function getRemoteData(): array
    {
        $results = $this->client->request('GET', $this->url);

        return json_decode($results->getBody(), true);
    }

    /**
     * Return a collection of the games
     * of this week.
     * 
     * @return \PHPCollections\Collections\GenericList
     */
    public function getWeekGames(): GenericList
    {
        $games = new GenericList(Game::class);

        foreach ($this->getRemoteData() as $date => $gameData) {
            $gameData['date'] = new \DateTime(substr($date, 0, -2));
            $games->add(new Game($gameData));
        }

        return $games;
    }

    /**
     * Return a collection of the games
     * of today or null if there is no
     * games for today.
     * 
     * @return \PHPCollections\Collections\GenericList|null
     */
    public function getTodayGames(): ?GenericList
    {
        return $this->getWeekGames()->filter(function ($key, $game) {
            return $game->date->format('Y-m-d') == (new \DateTime())->format('Y-m-d');
        });
    }

    /**
     * Return a collection of the games
     * that are currently being playing
     * or null if there is no live games
     * at the moment. 
     * 
     * @return \PHPCollections\Collections\GenericList|null
     */
    public function getLiveGames(): ?GenericList
    {
        return $this->getWeekGames()->filter(function ($key, $game) {
            return !in_array($game->qtr, ['Final', 'Suspended', 'final overtime', null]);
        });
    }

    /**
     * Return a collection with one
     * specific game or null if there's
     * no game being played by that team.
     * 
     * @param string $team
     * 
     * @return \PHPCollections\Collections\GenericList|null
     */
    public function getLiveGameByTeam(string $team): ?GenericList
    {
        return $this->getWeekGames()->filter(function ($key, $game) use ($team) {
            return $game->home['abbr'] === $team || $game->away['abbr'] === $team;
        });
    }
}