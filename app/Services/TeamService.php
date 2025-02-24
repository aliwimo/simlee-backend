<?php

namespace App\Services;

use App\Contracts\Repositories\TeamRepositoryContract;
use App\Contracts\Services\TeamServiceContract;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamService implements TeamServiceContract
{
    public function __construct(
        protected TeamRepositoryContract $teamRepository,
    ) {}

    /**
     * Retrieves all teams.
     *
     * @return Collection<Team>
     */
    public function getAllTeams(): Collection
    {
        return $this->teamRepository->all();
    }

    /**
     * Retrieves a team by its slug.
     *
     * @param string $slug
     * @return Team
     */
    public function getTeamBySlug(string $slug): Team
    {
        return $this->teamRepository->getTeamBySlug(slug: $slug);
    }

    /**
     * Retrieves a collection of random teams.
     *
     * @param int $count
     * @return Collection<Team>
     */
    public function getRandomTeams(int $count): Collection
    {
        return $this->teamRepository->getRandomTeams($count);
    }
}
