<?php

namespace App\Repositories;

use App\Models\Standing;

class StandingRepository extends BaseRepository
{

    public function __construct(Standing $model)
    {
        parent::__construct($model);
    }

}
