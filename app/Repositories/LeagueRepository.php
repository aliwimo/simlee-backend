<?php

namespace App\Repositories;

use App\Models\League;

class LeagueRepository extends BaseRepository
{

    public function __construct(League $model)
    {
        parent::__construct($model);
    }

}
