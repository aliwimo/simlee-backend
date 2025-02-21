<?php

namespace App\Services;

use App\Models\Team;
use App\Repositories\TeamRepository;
use Illuminate\Database\Eloquent\Collection;

class TeamService
{
    public function __construct(
        protected TeamRepository $teamRepository,
    ) {}

    public function getAllTeams(): Collection
    {
        return $this->teamRepository->all();
    }

    public function getTeamBySlug(string $slug): Team
    {
        return $this->teamRepository->getTeamBySlug(slug: $slug);
    }
}
