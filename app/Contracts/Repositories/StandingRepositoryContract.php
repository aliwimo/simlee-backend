<?php

namespace App\Contracts\Repositories;

use App\Models\Standing;
use Illuminate\Database\Eloquent\Collection;

interface StandingRepositoryContract
{
    /**
     * Retrieves the league standings for a given league, ordered by points in descending order.
     *
     * @param int $leagueId
     * @return Collection<Standing>
     */
    public function getLeagueStandings(int $leagueId): Collection;

    /**
     * Retrieves the standing for a specific team in a given league.
     *
     * @param int $leagueId
     * @param int $teamId
     * @return Standing
     */
    public function getTeamStanding(int $leagueId, int $teamId): Standing;
}
