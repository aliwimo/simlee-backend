<?php

namespace App\Contracts\Services\Simulation;

use App\Models\Fixture;

interface MatchSimulationServiceContract
{
    /**
     * Simulates a match between two teams.
     *
     * @param Fixture $fixture
     * @return array
     */
    public function simulate(Fixture $fixture): array;
}
