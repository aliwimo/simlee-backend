<?php

namespace App\Services;

use App\Models\Fixture;
use App\Models\League;
use App\Repositories\FixtureRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FixtureService
{
    public function __construct(
        protected FixtureRepository $fixtureRepository,
    ) {}

    public function getFixture(int $fixtureId): Fixture|Model
    {
        return $this->fixtureRepository->findOrFail($fixtureId);
    }

    public function generateFixtures(League $league, Collection $teams): void
    {
        $fixtures = $this->generateFixturesList($teams);

        // Each team plays home and away
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
                    'home_team_id' => $match[1], // Swap home and away
                    'away_team_id' => $match[0],
                    'week' => $currentWeek,
                    'played' => false,
                ];
            }
            $currentWeek++;
        }

        $league->fixtures()->createMany($weekFixtures);
    }

    protected function generateFixturesList(Collection $teams): array
    {
        $teamCount = $teams->count();
        $rounds = $teamCount - 1;
        $matchesPerRound = $teamCount / 2;

        // Convert teams collection to array of IDs
        $teamIds = $teams->pluck('id')->toArray();

        // If odd number of teams, add a "bye" team
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

                // The Last team stays in the last position while others rotate
                if ($match == 0) {
                    $away = $teamCount - 1;
                }

                // Skip matches with "bye" team
                if ($teamIds[$home] !== null && $teamIds[$away] !== null) {
                    $roundFixtures[] = [$teamIds[$home], $teamIds[$away]];
                }
            }

            $fixtures[] = $roundFixtures;
        }

        return $fixtures;
    }

}
