<?php

namespace App\Repositories;

use App\Contracts\Repositories\TeamRepositoryContract;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository extends BaseRepository implements TeamRepositoryContract
{
    public function __construct(Team $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieves a team by its slug.
     *
     * @param string $slug
     * @return Team
     */
    public function getTeamBySlug(string $slug): Team
    {
        return $this->query()->where('slug', $slug)->firstOrFail();
    }

    /**
     * Retrieves a collection of random teams.
     *
     * @param int $count
     * @return Collection<Team>
     */
    public function getRandomTeams(int $count): Collection
    {
        return $this->query()->inRandomOrder()->limit($count)->get();
    }
}
