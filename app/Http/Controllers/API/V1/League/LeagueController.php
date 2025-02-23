<?php

namespace App\Http\Controllers\API\V1\League;

use App\Exceptions\ApiExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeagueRequest;
use App\Http\Resources\LeagueResource;
use App\Http\Resources\StandingResource;
use App\Services\LeagueService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;
use Throwable;

class LeagueController extends Controller
{

    public function __construct(
        protected LeagueService $leagueService
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
}
