<?php

namespace NFLScores\Models;

use DateTime;
use Illuminate\Support\Facades\Cache;
use NFLScores\Http\AbstractHttpClient;
use NFLScores\Utilities\JSONParser;
use PHPCollections\Collections\GenericList;

/**
 * Manipulates NFL games related data.
 */
class NFL
{
    /**
     * The HTTP client for fetching remote data.
     *
     * @var \NFLScores\Http\AbstractHttpClient
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
     * Creates a new NFL object.
     *
     * @param \NFLScores\Http\AbstractHttpClient $httpClient
     * @param \DateTime                          $dateTime
     */
    public function __construct(AbstractHttpClient $httpClient, DateTime $datetime)
    {
        $this->client = $httpClient;
        $this->today = $datetime;
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
        $todayGames = $this->getTodayGames();

        if (is_null($todayGames)) {
            return null;
        }

        return $todayGames->filter(function ($key, $game) {
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
        $finishedGames = $this->getFinishedGames();

        if (is_null($finishedGames)) {
            return null;
        }

        return $finishedGames->filter(function ($key, $game) use ($team) {
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
        $todayGames = $this->getTodayGames();

        if (is_null($todayGames)) {
            return null;
        }

        return $todayGames->filter(function ($key, $game) {
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
        $livegames = $this->getLiveGames();

        if (is_null($livegames)) {
            return null;
        }

        return $livegames->filter(function ($key, $game) use ($team) {
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
        $data = $this->client->get();
        $parsedData = JSONParser::parse($data);

        foreach ($parsedData['gameScores'] as $key => $gameData) {
            $games->add(new Game($gameData));
        }

        Cache::put('games', $games, 1);

        return $games;
    }
}
