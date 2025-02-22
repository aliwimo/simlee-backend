<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository extends BaseRepository
{

    public function __construct(Team $model)
    {
        parent::__construct($model);
    }

    public function getTeamBySlug(string $slug): Team
    {
        return $this->query()->where('slug', $slug)->firstOrFail();
    }

}
