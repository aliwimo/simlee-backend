<?php

namespace App\Contracts\Repositories;

use App\Models\Fixture;
use Illuminate\Database\Eloquent\Collection;

interface FixtureRepositoryContract
{
    /**
     * Retrieves a fixture by ID with its associated home and away teams.
     *
     * @param int $fixtureId
     * @return Fixture
     */
    public function getFixtureWithTeams(int $fixtureId): Fixture;

    /**
     * Retrieves a collection of fixtures played by a specific team in a given league.
     *
     * @param int $leagueId
     * @param int $teamId
     * @return Collection<Fixture>
     */
    public function getTeamsPlayedFixtures(int $leagueId, int $teamId): Collection;

    /**
     * Retrieves the current week number for a given league.
     *
     * @param int $leagueId
     * @return int|null
     */
    public function getCurrentWeek(int $leagueId): ?int;
}
