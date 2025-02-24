<?php

namespace App\Repositories;

use App\Models\Fixture;
use Illuminate\Database\Eloquent\Collection;

class FixtureRepository extends BaseRepository
{

    public function __construct(Fixture $model)
    {
        parent::__construct($model);
    }

    public function getFixtureWithTeams(int $fixtureId): Fixture
    {
        return $this->query()
            ->with('homeTeam', 'awayTeam')
            ->findOrFail($fixtureId);
    }

    /**
     * @return Collection<Fixture>
     */
    public function getTeamsPlayedFixtures(int $leagueId, int $teamId): Collection
    {
        return $this->query()
            ->where('league_id', $leagueId)
            ->where('played', true)
            ->where(function ($query) use ($teamId) {
                $query->where('home_team_id', $teamId)
                    ->orWhere('away_team_id', $teamId);
            })
            ->get();
    }

    public function getCurrentWeek(int $leagueId): ?int
    {
        return $this->query()
            ->where('league_id', $leagueId)
            ->where('played', false)
            ->orderBy('week')
            ->value('week');
    }

}
