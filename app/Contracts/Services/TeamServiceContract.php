<?php

namespace App\Contracts\Services;

use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface TeamServiceContract
{
    /**
     * Retrieves all teams.
     *
     * @return Collection<Team>
     */
    public function getAllTeams(): Collection;

    /**
     * Retrieves a team by its slug.
     *
     * @param string $slug
     * @return Team
     */
    public function getTeamBySlug(string $slug): Team;

    /**
     * Retrieves a collection of random teams.
     *
     * @param int $count
     * @return Collection<Team>
     */
    public function getRandomTeams(int $count): Collection;
}
