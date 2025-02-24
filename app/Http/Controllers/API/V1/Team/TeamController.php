<?php

namespace App\Http\Controllers\API\V1\Team;

use App\Contracts\Services\TeamServiceContract;
use App\Exceptions\ApiExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use Illuminate\Http\JsonResponse;
use Throwable;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class TeamController extends Controller
{
    public function __construct(
        protected TeamServiceContract $teamService,
    ) {}

    public function index(): JsonResponse
    {
        try {
            return response()->json(
                data: TeamResource::collection($this->teamService->getAllTeams()),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }

    public function showBySlug(string $slug): JsonResponse
    {
        try {
            return response()->json(
                data: TeamResource::make($this->teamService->getTeamBySlug(slug: $slug)),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }
}
