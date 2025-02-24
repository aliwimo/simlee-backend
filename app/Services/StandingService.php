<?php

namespace App\Services;

use App\Contracts\Repositories\FixtureRepositoryContract;
use App\Contracts\Repositories\StandingRepositoryContract;
use App\Contracts\Services\StandingServiceContract;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class StandingService implements StandingServiceContract
{
    public function __construct(
        protected StandingRepositoryContract $standingRepository,
        protected FixtureRepositoryContract $fixtureRepository,
    ) {}

    /**
     * Generates initial standings for a league.
     *
     * @param League $league
     * @param Collection $teams
     * @return void
     */
    public function generateStandings(League $league, Collection $teams): void
    {
        $standings = $teams->map(function (Team $team) use ($league) {
            return [
                'league_id' => $league->id,
                'team_id' => $team->id,
            ];
        });
        $league->standings()->createMany($standings->toArray());
    }

    /**
     * Recalculates standings for specific teams.
     *
     * @param League $league
     * @param array $teamIds
     * @return void
     */
    public function recalculateTeamStandings(League $league, array $teamIds): void
    {
        foreach ($teamIds as $teamId) {
            $standing = $this->standingRepository->query()->firstOrCreate([
                'league_id' => $league->id,
                'team_id' => $teamId
            ]);

            $fixtures = $this->fixtureRepository->getTeamsPlayedFixtures(
                leagueId: $league->id,
                teamId: $teamId
            );

            $stats = $this->prepareStates(
                teamId: $teamId,
                fixtures: $fixtures
            );

            $standing->update($stats);
        }
    }

    /**
     * Updates standings after a fixture.
     *
     * @param Fixture $fixture
     * @return void
     */
    public function updateStandingsAfterFixture(Fixture $fixture): void
    {
        if (!$fixture->played) return;
        $this->recalculateTeamStandings(
            league: $fixture->league,
            teamIds: [$fixture->home_team_id, $fixture->away_team_id]
        );
    }

    /**
     * Refreshes standings for all teams in a league.
     *
     * @param League $league
     * @return void
     */
    public function refreshLeagueStanding(League $league): void
    {
        $teamIds = $league->teams()->pluck('id')->toArray();
        $this->recalculateTeamStandings(
            league: $league,
            teamIds: $teamIds
        );
    }

    /**
     * Gets league standings.
     *
     * @param League $league
     * @return Collection<Standing>
     */
    public function getLeagueStandings(League $league): Collection
    {
        return $this->standingRepository->getLeagueStandings(
            leagueId: $league->id
        );
    }

    /**
     * Gets a team's standing.
     *
     * @param League $league
     * @param Team $team
     * @return Standing
     */
    public function getTeamStanding(League $league, Team $team): Standing
    {
        return $this->standingRepository->getTeamStanding(
            leagueId: $league->id,
            teamId: $team->id,
        );
    }

    /**
     * Prepares statistics for a team.
     *
     * @param int $teamId
     * @param Collection<Fixture> $fixtures
     * @return array
     */
    private function prepareStates(int $teamId, Collection $fixtures): array
    {
        $stats = [
            'played' => 0,
            'win' => 0,
            'draw' => 0,
            'lose' => 0,
            'goals_for' => 0,
            'goals_against' => 0,
            'points' => 0
        ];

        // Calculate new statistics
        foreach ($fixtures as $fixture) {
            $stats['played']++;

            if ($fixture->home_team_id === $teamId) {
                // Team played at home
                $stats['goals_for'] += $fixture->home_score;
                $stats['goals_against'] += $fixture->away_score;

                if ($fixture->home_score > $fixture->away_score) {
                    $stats['win']++;
                    $stats['points'] += 3;
                } elseif ($fixture->home_score < $fixture->away_score) {
                    $stats['lose']++;
                } else {
                    $stats['draw']++;
                    $stats['points'] += 1;
                }
            } else {
                // Team played away
                $stats['goals_for'] += $fixture->away_score;
                $stats['goals_against'] += $fixture->home_score;

                if ($fixture->away_score > $fixture->home_score) {
                    $stats['win']++;
                    $stats['points'] += 3;
                } elseif ($fixture->away_score < $fixture->home_score) {
                    $stats['lose']++;
                } else {
                    $stats['draw']++;
                    $stats['points'] += 1;
                }
            }
        }

        return $stats;
    }
}
