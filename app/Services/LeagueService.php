<?php

namespace App\Services;

use App\Http\Requests\StoreLeagueRequest;
use App\Models\League;
use App\Repositories\LeagueRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LeagueService
{
    public function __construct(
        protected LeagueRepository $leagueRepository,
        protected TeamService $teamService,
        protected StandingService $standingService,
        protected FixtureService $fixtureService,
    ) {}

    public function getAllLeagues(): Collection
    {
        return $this->leagueRepository->all();
    }

    /**
     * @param int $leagueId
     * @return League
     */
    public function getLeague(int $leagueId): League|Model
    {
        return $this->leagueRepository->findOrFail($leagueId);
    }

    public function initializeLeague(StoreLeagueRequest $request): League
    {
        $league = $this->createLeague(request: $request);
        $teams = $this->teamService->getRandomTeams(count: $request->teams_number);
        $this->standingService->generateStandings(league: $league, teams: $teams);
        $this->fixtureService->generateFixtures(league: $league, teams: $teams);
        return $league;
    }

    public function getLeagueStandings(int $leagueId): Collection
    {
        /** @var League $league */
        $league = $this->leagueRepository->findOrFail($leagueId);
        return $league->standings()
            ->with('team')
            ->get();
    }

    public function getLeagueFixtures(int $leagueId, int $week): Collection
    {
        /** @var League $league */
        $league = $this->leagueRepository->findOrFail($leagueId);
        return $league->fixtures()
            ->with('homeTeam', 'awayTeam')
            ->where('week', $week)
            ->get();
    }

    public function simulate(int $leagueId): league
    {
        /** @var League $league */
        $league = $this->leagueRepository->findOrFail($leagueId);

        $this->fixtureService->simulateFixtures(league: $league);
        return $league;
    }
    private function createLeague(StoreLeagueRequest $request): League|Model
    {
        return $this->leagueRepository->create([
            'name' => $request->name,
            'teams_number' => $request->teams_number,
            'season' => $request->season
        ]);
    }




}
