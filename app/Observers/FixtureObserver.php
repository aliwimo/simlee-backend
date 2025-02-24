<?php

namespace App\Observers;

use App\Contracts\Repositories\FixtureRepositoryContract;
use App\Enums\LeagueStatus;
use App\Models\Fixture;

class FixtureObserver
{

    public function __construct(
        protected FixtureRepositoryContract $fixtureRepository
    ) {}

    /**
     * Handle the Fixture "created" event.
     */
    public function created(Fixture $fixture): void
    {

    }

    /**
     * Handle the Fixture "updated" event.
     */
    public function updated(Fixture $fixture): void
    {
        $currentWeek = $this->fixtureRepository->getCurrentWeek($fixture->league_id);
        $fixture->loadMissing('league');
        if ($currentWeek) {
            $fixture->league->current_week = $currentWeek;
        } else {
            $fixture->league->current_week = ($fixture->league->teams_number * 2) - 2;
            $fixture->league->status = LeagueStatus::ENDED;
        }
        $fixture->league->saveQuietly();
    }

    /**
     * Handle the Fixture "deleted" event.
     */
    public function deleted(Fixture $fixture): void
    {
        //
    }

    /**
     * Handle the Fixture "restored" event.
     */
    public function restored(Fixture $fixture): void
    {
        //
    }

    /**
     * Handle the Fixture "force deleted" event.
     */
    public function forceDeleted(Fixture $fixture): void
    {
        //
    }
}
