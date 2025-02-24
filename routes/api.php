<?php

use App\Http\Controllers\API\V1\Fixture\FixtureController;
use App\Http\Controllers\API\V1\League\LeagueController;
use App\Http\Controllers\API\V1\Team\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {

    /** fixtures routes */
    Route::prefix('/fixtures')->group(callback: function () {
        Route::post('/{id}/simulate', [FixtureController::class, 'simulate']);
    });

    /** leagues routes */
    Route::prefix('/leagues')->group(callback: function () {
        Route::get('/', [LeagueController::class, 'index']);
        Route::post('/', [LeagueController::class, 'store']);
        Route::get('/{id}', [LeagueController::class, 'show']);
        Route::get('/{id}/standings', [LeagueController::class, 'standings']);
        Route::get('/{id}/fixtures/{week}', [LeagueController::class, 'fixtures']);
        Route::post('/{id}/simulate', [LeagueController::class, 'simulate']);
        Route::post('/{id}/simulate-week/{week}', [LeagueController::class, 'simulateWeek']);
    });

    /** teams routes */
    Route::prefix('/teams')->group(callback: function () {
        Route::get('/', [TeamController::class, 'index']);
        Route::get('/{slug}/show', [TeamController::class, 'showBySlug']);
    });

});
