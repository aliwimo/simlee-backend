<?php

namespace App\Services\Simulation;

use App\Contracts\Services\Simulation\MatchSimulationServiceContract;
use App\Models\Fixture;

class MatchSimulationService implements MatchSimulationServiceContract
{
    /**
     * Simulates a match between two teams.
     *
     * @param Fixture $fixture
     * @return array
     */
    public function simulate(Fixture $fixture): array
    {
        $fixture->loadMissing('homeTeam', 'awayTeam');

        $homeStrength = $fixture->homeTeam->strength * 1.2; // for home advantage :D
        $awayStrength = $fixture->awayTeam->strength;

        $homeGoals = $this->calculateGoals($homeStrength);
        $awayGoals = $this->calculateGoals($awayStrength);

        return [
            'home_score' => $homeGoals,
            'away_score' => $awayGoals
        ];
    }

    /**
     * Calculates the number of goals scored by a team.
     *
     * @param float $strength
     * @return int
     */
    private function calculateGoals(float $strength): int
    {
        return max(0, (int) round($strength * mt_rand(0, 5)));
    }
}
