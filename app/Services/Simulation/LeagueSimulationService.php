<?php

namespace App\Services\Simulation;

use App\Contracts\Services\Simulation\LeagueSimulationServiceContract;
use App\Contracts\Services\Simulation\MatchSimulationServiceContract;
use App\Contracts\Services\StandingServiceContract;
use App\Models\League;
use App\Models\Fixture;

class LeagueSimulationService implements LeagueSimulationServiceContract
{
    public function __construct(
        protected MatchSimulationServiceContract $matchSimulationService,
        protected StandingServiceContract $standingService,
    ) {}

    /**
     * Simulates a single fixture.
     *
     * @param Fixture $fixture
     * @return Fixture
     */
    public function simulateFixture(Fixture $fixture): Fixture
    {
        $result = $this->matchSimulationService->simulate($fixture);

        $fixture->update([
            'home_score' => $result['home_score'],
            'away_score' => $result['away_score'],
            'played' => true
        ]);

        $this->standingService->updateStandingsAfterFixture($fixture);

        return $fixture;
    }

    /**
     * Simulates all fixtures for a given week.
     *
     * @param League $league
     * @param int $week
     * @return League
     */
    public function simulateWeek(League $league, int $week): League
    {
        $fixtures = $league->fixtures()
            ->where('week', $week)
            ->where('played', false)
            ->get();

        foreach ($fixtures as $fixture) {
            $this->simulateFixture($fixture);
        }

        return $league;
    }

    /**
     * Simulates all remaining fixtures for a league.
     *
     * @param League $league
     * @return League
     */
    public function simulateAllWeeks(League $league): League
    {
        $remainingWeeks = Fixture::where('league_id', $league->id)
            ->where('played', false)
            ->distinct()
            ->pluck('week')
            ->sort();

        foreach ($remainingWeeks as $week) {
            $this->simulateWeek($league, $week);
        }
        return $league;
    }
}
