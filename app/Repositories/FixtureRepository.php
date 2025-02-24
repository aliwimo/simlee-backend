<?php

namespace App\Repositories;

use App\Contracts\Repositories\FixtureRepositoryContract;
use App\Models\Fixture;
use Illuminate\Database\Eloquent\Collection;

class FixtureRepository extends BaseRepository implements FixtureRepositoryContract
{
    public function __construct(Fixture $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieves a fixture by ID with its associated home and away teams.
     *
     * @param int $fixtureId
     * @return Fixture
     */
    public function getFixtureWithTeams(int $fixtureId): Fixture
    {
        return $this->query()
            ->with('homeTeam', 'awayTeam')
            ->findOrFail($fixtureId);
    }

    /**
     * Retrieves a collection of fixtures played by a specific team in a given league.
     *
     * @param int $leagueId
     * @param int $teamId
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

    /**
     * Retrieves the current week number for a given league.
     *
     * @param int $leagueId
     * @return int|null
     */
    public function getCurrentWeek(int $leagueId): ?int
    {
        return $this->query()
            ->where('league_id', $leagueId)
            ->where('played', false)
            ->orderBy('week')
            ->value('week');
    }
}
