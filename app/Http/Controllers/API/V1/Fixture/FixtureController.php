<?php

namespace App\Http\Controllers\API\V1\Fixture;

use App\Contracts\Services\FixtureServiceContract;
use App\Contracts\Services\Simulation\LeagueSimulationServiceContract;
use App\Exceptions\ApiExceptionHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;
use Throwable;

class FixtureController extends Controller
{
    public function __construct(
        protected FixtureServiceContract $fixtureService,
        protected LeagueSimulationServiceContract $simulationService,
    ) {}

    public function simulate(int $fixtureId): JsonResponse
    {
        try {
            $fixture = $this->fixtureService->getFixture($fixtureId);
            return response()->json(
                data: $this->simulationService->simulateFixture($fixture),
                status: ResponseStatus::HTTP_OK,
            );
        } catch (Throwable $exception) {
            return ApiExceptionHandler::handle($exception);
        }
    }
}
