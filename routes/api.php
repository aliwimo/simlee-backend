<?php

use App\Http\Controllers\API\V1\Team\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {

    /** teams routes */
    Route::prefix('/teams')->group(callback: function () {
        Route::get('/', [TeamController::class, 'index']);
        Route::get('{slug}/show', [TeamController::class, 'showBySlug']);
    });

});
