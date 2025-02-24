<?php

namespace App\Repositories;

use App\Models\Standing;
use Illuminate\Database\Eloquent\Collection;

class StandingRepository extends BaseRepository
{

    public function __construct(Standing $model)
    {
        parent::__construct($model);
    }

    public function getLeagueStandings(int $leagueId): Collection
    {
        return $this->query()
            ->where('league_id', $leagueId)
            ->with('team')
            ->get()
            ->sortByDesc('points')
            ->values();
    }

    public function getTeamStanding(int $leagueId, int $teamId): Standing
    {
        return $this->query()
            ->where('league_id', $leagueId)
            ->where('team_id', $teamId)
            ->firstOrFail();
    }

}
