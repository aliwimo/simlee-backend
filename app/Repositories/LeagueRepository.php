<?php

namespace App\Repositories;

use App\Models\League;

class LeagueRepository extends BaseRepository
{

    public function __construct(League $model)
    {
        parent::__construct($model);
    }

    public function getLeagueWithFixtures(int $leagueId): League
    {
        return $this->query()
            ->with('fixtures')
            ->findOrFail($leagueId);
    }

}
