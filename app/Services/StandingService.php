<?php

namespace App\Services;

use App\Models\League;
use App\Models\Team;
use App\Repositories\StandingRepository;
use Illuminate\Database\Eloquent\Collection;

class StandingService
{
    public function __construct(
        protected StandingRepository $standingRepository,
    ) {}

    public function generateStandings(League $league, Collection $teams): void
    {
        $standings = $teams->map(function (Team $team) use ($league) {
            return [
                'league_id' => $league->id,
                'team_id' => $team->id,
            ];
        });
        $league->standings()->createMany($standings->toArray());
    }
}
