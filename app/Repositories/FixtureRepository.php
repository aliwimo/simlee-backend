<?php

namespace App\Repositories;

use App\Models\Fixture;

class FixtureRepository extends BaseRepository
{

    public function __construct(Fixture $model)
    {
        parent::__construct($model);
    }

}
