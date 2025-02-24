<?php

namespace App\Repositories;

use App\Contracts\Repositories\LeagueRepositoryContract;
use App\Models\League;

class LeagueRepository extends BaseRepository implements LeagueRepositoryContract
{
    public function __construct(League $model)
    {
        parent::__construct($model);
    }
}
