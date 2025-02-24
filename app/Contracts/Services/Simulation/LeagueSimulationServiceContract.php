<?php

namespace App\Contracts\Services\Simulation;

use App\Models\Fixture;
use App\Models\League;

interface LeagueSimulationServiceContract
{
    /**
     * Simulates a single fixture.
     *
     * @param Fixture $fixture
     * @return Fixture
     */
    public function simulateFixture(Fixture $fixture): Fixture;

    /**
     * Simulates all fixtures for a given week.
     *
     * @param League $league
     * @param int $week
     * @return League
     */
    public function simulateWeek(League $league, int $week): League;

    /**
     * Simulates all remaining fixtures for a league.
     *
     * @param League $league
     * @return League
     */
    public function simulateAllWeeks(League $league): League;
}
