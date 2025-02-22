<?php

namespace App\Services;

use App\Repositories\LeagueRepository;

class LeagueService
{
    public function __construct(
        protected LeagueRepository $leagueRepository,
    ) {}

}
