<?php

use App\Models\Fixture;
use App\Services\Simulation\MatchSimulationService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/test', function () {

    $currentWeek = Fixture::where('league_id', 12)
        ->where('played', false)
        ->orderBy('week')
        ->value('week');

    dd($currentWeek);

    return $currentWeek;
});

require __DIR__.'/auth.php';
