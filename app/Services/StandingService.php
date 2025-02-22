<?php

namespace App\Services;

use App\Repositories\StandingRepository;

class StandingService
{
    public function __construct(
        protected StandingRepository $standingRepository,
    ) {}

}
