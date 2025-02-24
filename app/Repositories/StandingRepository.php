<?php

namespace App\Repositories;

use App\Contracts\Repositories\StandingRepositoryContract;
use App\Models\Standing;
use Illuminate\Database\Eloquent\Collection;


class StandingRepository extends BaseRepository implements StandingRepositoryContract
{
    public function __construct(Standing $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieves the league standings for a given league, ordered by points in descending order.
     *
     * @param int $leagueId
     * @return Collection<Standing>
     */
    public function getLeagueStandings(int $leagueId): Collection
    {
        return $this->query()
            ->where('league_id', $leagueId)
            ->with('team')
            ->get()
            ->sortByDesc('points')
            ->values();
    }

    /**
     * Retrieves the standing for a specific team in a given league.
     *
     * @param int $leagueId
     * @param int $teamId
     * @return Standing
     */
    public function getTeamStanding(int $leagueId, int $teamId): Standing
    {
        return $this->query()
            ->where('league_id', $leagueId)
            ->where('team_id', $teamId)
            ->firstOrFail();
    }
}
