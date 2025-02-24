<?php

namespace App\Services;

use App\Contracts\Repositories\FixtureRepositoryContract;
use App\Contracts\Services\FixtureServiceContract;
use App\Models\Fixture;
use App\Models\League;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FixtureService implements FixtureServiceContract
{
    public function __construct(
        protected FixtureRepositoryContract $fixtureRepository,
    ) {}

    /**
     * Retrieves a fixture by ID.
     *
     * @param int $fixtureId
     * @return Fixture|Model
     */
    public function getFixture(int $fixtureId): Fixture|Model
    {
        return $this->fixtureRepository->findOrFail($fixtureId);
    }

    /**
     * Generates fixtures for a league.
     *
     * @param League $league
     * @param Collection $teams
     * @return void
     */
    public function generateFixtures(League $league, Collection $teams): void
    {
        $fixtures = $this->generateFixturesList($teams);

        $weekFixtures = [];
        $currentWeek = 1;

        // First half of the season (home games)
        foreach ($fixtures as $round => $matches) {
            foreach ($matches as $match) {
                $weekFixtures[] = [
                    'league_id' => $league->id,
                    'home_team_id' => $match[0],
                    'away_team_id' => $match[1],
                    'week' => $currentWeek,
                    'played' => false,
                ];
            }
            $currentWeek++;
        }

        // Second half of the season (away games - reverse fixtures)
        foreach ($fixtures as $round => $matches) {
            foreach ($matches as $match) {
                $weekFixtures[] = [
                    'league_id' => $league->id,
                    'home_team_id' => $match[1],
                    'away_team_id' => $match[0],
                    'week' => $currentWeek,
                    'played' => false,
                ];
            }
            $currentWeek++;
        }

        $league->fixtures()->createMany($weekFixtures);
    }

    /**
     * Generates a list of fixtures.
     *
     * @param Collection $teams
     * @return array
     */
    private function generateFixturesList(Collection $teams): array
    {
        $teamCount = $teams->count();
        $rounds = $teamCount - 1;
        $matchesPerRound = $teamCount / 2;

        $teamIds = $teams->pluck('id')->toArray();

        if ($teamCount % 2 !== 0) {
            $teamIds[] = null;
            $rounds += 1;
            $matchesPerRound = ($teamCount + 1) / 2;
        }

        $fixtures = [];

        for ($round = 0; $round < $rounds; $round++) {
            $roundFixtures = [];

            for ($match = 0; $match < $matchesPerRound; $match++) {
                $home = ($round + $match) % ($teamCount - 1);
                $away = ($teamCount - 1 - $match + $round) % ($teamCount - 1);

                if ($match == 0) {
                    $away = $teamCount - 1;
                }

                if ($teamIds[$home] !== null && $teamIds[$away] !== null) {
                    $roundFixtures[] = [$teamIds[$home], $teamIds[$away]];
                }
            }

            $fixtures[] = $roundFixtures;
        }

        return $fixtures;
    }
}
