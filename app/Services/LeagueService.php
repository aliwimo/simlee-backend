<?php

namespace App\Services;

use App\Contracts\Repositories\LeagueRepositoryContract;
use App\Contracts\Services\FixtureServiceContract;
use App\Contracts\Services\LeagueServiceContract;
use App\Contracts\Services\StandingServiceContract;
use App\Contracts\Services\TeamServiceContract;
use App\Http\Requests\StoreLeagueRequest;
use App\Models\League;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LeagueService implements LeagueServiceContract
{
    public function __construct(
        protected LeagueRepositoryContract $leagueRepository,
        protected TeamServiceContract $teamService,
        protected StandingServiceContract $standingService,
        protected FixtureServiceContract $fixtureService,
    ) {}

    /**
     * Retrieves all leagues.
     *
     * @return Collection<League>
     */
    public function getAllLeagues(): Collection
    {
        return $this->leagueRepository->all();
    }

    /**
     * Retrieves a league by ID.
     *
     * @param int $leagueId
     * @return League|Model
     */
    public function getLeague(int $leagueId): League|Model
    {
        return $this->leagueRepository->findOrFail($leagueId);
    }

    /**
     * Initializes a new league.
     *
     * @param StoreLeagueRequest $request
     * @return League
     */
    public function initializeLeague(StoreLeagueRequest $request): League
    {
        $league = $this->createLeague(request: $request);
        $teams = $this->teamService->getRandomTeams(count: $request->teams_number);
        $this->standingService->generateStandings(league: $league, teams: $teams);
        $this->fixtureService->generateFixtures(league: $league, teams: $teams);
        return $league;
    }

    /**
     * Retrieves league standings.
     *
     * @param int $leagueId
     * @return Collection
     */
    public function getLeagueStandings(int $leagueId): Collection
    {
        /** @var League $league */
        $league = $this->leagueRepository->findOrFail($leagueId);
        return $league->standings()
            ->with('team')
            ->get();
    }

    /**
     * Retrieves league fixtures for a specific week.
     *
     * @param int $leagueId
     * @param int $week
     * @return Collection
     */
    public function getLeagueFixtures(int $leagueId, int $week): Collection
    {
        /** @var League $league */
        $league = $this->leagueRepository->findOrFail($leagueId);
        return $league->fixtures()
            ->with('homeTeam', 'awayTeam')
            ->where('week', $week)
            ->get();
    }

    /**
     * Creates a new league.
     *
     * @param StoreLeagueRequest $request
     * @return League|Model
     */
    private function createLeague(StoreLeagueRequest $request): League|Model
    {
        return $this->leagueRepository->create([
            'name' => $request->name,
            'teams_number' => $request->teams_number,
            'season' => $request->season
        ]);
    }
}
