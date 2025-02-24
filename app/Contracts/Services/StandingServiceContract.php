<?php

namespace App\Contracts\Services;

use App\Models\Fixture;
use App\Models\League;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface StandingServiceContract
{
    /**
     * Generates initial standings for a league.
     *
     * @param League $league
     * @param Collection $teams
     * @return void
     */
    public function generateStandings(League $league, Collection $teams): void;

    /**
     * Recalculates standings for specific teams.
     *
     * @param League $league
     * @param array $teamIds
     * @return void
     */
    public function recalculateTeamStandings(League $league, array $teamIds): void;

    /**
     * Updates standings after a fixture.
     *
     * @param Fixture $fixture
     * @return void
     */
    public function updateStandingsAfterFixture(Fixture $fixture): void;

    /**
     * Refreshes standings for all teams in a league.
     *
     * @param League $league
     * @return void
     */
    public function refreshLeagueStanding(League $league): void;

    /**
     * Gets league standings.
     *
     * @param League $league
     * @return Collection<Standing>
     */
    public function getLeagueStandings(League $league): Collection;

    /**
     * Gets a team's standing.
     *
     * @param League $league
     * @param Team $team
     * @return Standing
     */
    public function getTeamStanding(League $league, Team $team): Standing;
}
