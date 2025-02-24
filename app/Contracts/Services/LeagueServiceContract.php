<?php

namespace App\Contracts\Services;

use App\Http\Requests\StoreLeagueRequest;
use App\Models\League;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface LeagueServiceContract
{
    /**
     * Retrieves all leagues.
     *
     * @return Collection<League>
     */
    public function getAllLeagues(): Collection;

    /**
     * Retrieves a league by ID.
     *
     * @param int $leagueId
     * @return League|Model
     */
    public function getLeague(int $leagueId): League|Model;

    /**
     * Initializes a new league.
     *
     * @param StoreLeagueRequest $request
     * @return League
     */
    public function initializeLeague(StoreLeagueRequest $request): League;

    /**
     * Retrieves league standings.
     *
     * @param int $leagueId
     * @return Collection
     */
    public function getLeagueStandings(int $leagueId): Collection;

    /**
     * Retrieves league fixtures for a specific week.
     *
     * @param int $leagueId
     * @param int $week
     * @return Collection
     */
    public function getLeagueFixtures(int $leagueId, int $week): Collection;
}
