<?php

namespace App\Services;

use App\Repositories\FixtureRepository;

class FixtureService
{
    public function __construct(
        protected FixtureRepository $fixtureRepository,
    ) {}

}
