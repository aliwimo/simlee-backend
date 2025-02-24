<?php

namespace App\Http\Controllers\API\V1\Fixture;

use App\Exceptions\ApiExceptionHandler;
use App\Http\Controllers\Controller;
use App\Services\FixtureService;
use App\Services\Simulation\LeagueSimulationService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;
use Throwable;

class FixtureController extends Controller
{
    public function __construct(
        protected FixtureService $fixtureService,
        protected LeagueSimulationService $simulationService,
    ) {}

    public function index() {}

    public function show() {}

    public function store() {}

    public function update() {}

    public function destroy() {}

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
