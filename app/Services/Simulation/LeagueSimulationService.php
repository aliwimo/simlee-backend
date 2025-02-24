<?php

namespace App\Services\Simulation;

use App\Models\League;
use App\Models\Fixture;
use App\Services\StandingService;

class LeagueSimulationService
{
    public function __construct(
        protected MatchSimulationService $matchSimulationService,
        protected StandingService $standingService,
    ) {}

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
