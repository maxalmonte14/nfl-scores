<?php

namespace NFLScores\Models;

use DateTime;
use DateTimeZone;
use PHPCollections\Collections\GenericList;
use NFLScores\Utilities\JSONParser;
use NFLScores\Interfaces\HttpClientInterface;
use Illuminate\Support\Facades\Cache;

/**
 * Manipulates NFL games related data.
 */
class NFL
{
    /**
     * The HTTP client for fetching remote data.
     *
     * @var \NFLScores\Interfaces\HttpClientInterface
     */
    private $client;

    /**
     * The current datetime,
     * represents today's date.
     *
     * @var \DateTime
     */
    private $today;

    /**
     * Initializes class properties.
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->client = $httpClient;
        $this->today = new DateTime('now', new DateTimeZone('US/Eastern'));
    }

    /**
     * Returns a collection with
     * the finished games for today
     * or null if there's not finished games.
     *
     * @return \PHPCollections\Collections\GenericList|null
     */
    public function getFinishedGames(): ?GenericList
    {
        return $this->getTodayGames()->filter(function ($key, $game) {
            return in_array($game->score['phase'], ['FINAL', 'FINAL OVERTIME']);
        });
    }

    /**
     * Returns a collection with one
     * specific game or null if there's
     * no finished game by that team.
     *
     * @param string $team
     *
     * @return \PHPCollections\Collections\GenericList|null
     */
    public function getFinishedGameByTeam(string $team): ?GenericList
    {
        return $this->getFinishedGames()->filter(function ($key, $game) use ($team) {
            return $game->gameSchedule['homeTeamAbbr'] === $team ||
                $game->gameSchedule['visitorTeamAbbr'] === $team;
        });
    }

    /**
     * Returns a collection of the games
     * that are currently being played
     * or null if there is no live games
     * at the moment.
     *
     * @return \PHPCollections\Collections\GenericList|null
     */
    public function getLiveGames(): ?GenericList
    {
        return $this->getWeekGames()->filter(function ($key, $game) {
            return !in_array($game->score['phase'], ['FINAL', 'SUSPENDED', 'FINAL OVERTIME', null]);
        });
    }

    /**
     * Returns a collection with one
     * specific game or null if there's
     * no game being played by that team.
     *
     * @param string $team
     *
     * @return \PHPCollections\Collections\GenericList|null
     */
    public function getLiveGameByTeam(string $team): ?GenericList
    {
        return $this->getLiveGames()->filter(function ($key, $game) use ($team) {
            return $game->gameSchedule['homeTeamAbbr'] === $team ||
                $game->gameSchedule['visitorTeamAbbr'] === $team;
        });
    }

    /**
     * Returns a collection of today games
     * or null if there is no games for today.
     *
     * @return \PHPCollections\Collections\GenericList|null
     */
    public function getTodayGames(): ?GenericList
    {
        return $this->getWeekGames()->filter(function ($key, $game) {
            return str_replace('\/', '/', $game->gameSchedule['gameDate']) === $this->today->format('m/d/Y');
        });
    }

    /**
     * Returns a collection of the games
     * to be played this week.
     *
     * @return \PHPCollections\Collections\GenericList
     */
    public function getWeekGames(): GenericList
    {
        if (Cache::has('games')) {
            return Cache::get('games');
        }

        $games = new GenericList(Game::class);
        $data = $this->client->get($this->client::getUrl());
        $parsedData = JSONParser::parse($data);

        foreach ($parsedData['gameScores'] as $key => $gameData) {
            $games->add(new Game($gameData));
        }

        Cache::put('games', $games, 1);

        return $games;
    }
}