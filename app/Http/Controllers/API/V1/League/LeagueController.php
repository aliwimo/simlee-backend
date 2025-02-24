<?php

namespace App\Http\Controllers\API\V1\League;

use App\Contracts\Services\LeagueServiceContract;
use App\Contracts\Services\Simulation\LeagueSimulationServiceContract;
use App\Exceptions\ApiExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeagueRequest;
use App\Http\Resources\FixtureResource;
use App\Http\Resources\LeagueResource;
use App\Http\Resources\StandingResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;
use Throwable;

class LeagueController extends Controller
{

    public function __construct(
        protected LeagueServiceContract $leagueService,
        protected LeagueSimulationServiceContract $leagueSimulationService,
    ) {}

    public function index(): JsonResponse
    {
        try {
            return response()->json(
                data: LeagueResource::collection($this->leagueService->getAllLeagues()),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }

    public function show(int $leagueId): JsonResponse
    {
        try {
            return response()->json(
                data: LeagueResource::make($this->leagueService->getLeague($leagueId)),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }

    public function store(StoreLeagueRequest $request): JsonResponse
    {
        try {
            return response()->json(
                data: $this->leagueService->initializeLeague($request),
                status: ResponseStatus::HTTP_CREATED,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }

    public function standings(int $leagueId): JsonResponse
    {
        try {
            return response()->json(
                data: StandingResource::collection($this->leagueService->getLeagueStandings($leagueId)),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }

    public function fixtures(int $leagueId, int $week): JsonResponse
    {
        try {
            return response()->json(
                data: FixtureResource::collection($this->leagueService->getLeagueFixtures($leagueId, $week)),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }

    public function simulate(int $leagueId): JsonResponse
    {
        try {
            $league = $this->leagueService->getLeague($leagueId);
            return response()->json(
                data: $this->leagueSimulationService->simulateAllWeeks($league),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }

    public function simulateWeek(int $leagueId, int $week): JsonResponse
    {
        try {
            $league = $this->leagueService->getLeague($leagueId);
            return response()->json(
                data: $this->leagueSimulationService->simulateWeek($league, $week),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }
}
