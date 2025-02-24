<?php

namespace App\Contracts\Services;

use App\Models\Fixture;
use App\Models\League;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface FixtureServiceContract
{
    /**
     * Retrieves a fixture by ID.
     *
     * @param int $fixtureId
     * @return Fixture|Model
     */
    public function getFixture(int $fixtureId): Fixture|Model;

    /**
     * Generates fixtures for a league.
     *
     * @param League $league
     * @param Collection $teams
     * @return void
     */
    public function generateFixtures(League $league, Collection $teams): void;
}
