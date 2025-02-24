<?php

namespace App\Providers;

use App\Contracts\Repositories as ContractsRepositories;
use App\Contracts\Services as ContractsServices;
use App\Repositories;
use App\Services;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * The interface to contract mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected array $contracts = [
        // repositories
        ContractsRepositories\BaseRepositoryContract::class => Repositories\BaseRepository::class,
        ContractsRepositories\FixtureRepositoryContract::class => Repositories\FixtureRepository::class,
        ContractsRepositories\LeagueRepositoryContract::class => Repositories\LeagueRepository::class,
        ContractsRepositories\StandingRepositoryContract::class => Repositories\StandingRepository::class,
        ContractsRepositories\TeamRepositoryContract::class => Repositories\TeamRepository::class,

        // services
        ContractsServices\FixtureServiceContract::class => Services\FixtureService::class,
        ContractsServices\LeagueServiceContract::class => Services\LeagueService::class,
        ContractsServices\StandingServiceContract::class => Services\StandingService::class,
        ContractsServices\TeamServiceContract::class => Services\TeamService::class,
        ContractsServices\Simulation\LeagueSimulationServiceContract::class => Services\Simulation\LeagueSimulationService::class,
        ContractsServices\Simulation\MatchSimulationServiceContract::class => Services\Simulation\MatchSimulationService::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindContracts();

    }

    /**
     * Bind the contracts to their implementations.
     */
    public function bindContracts(): void
    {
        foreach ($this->contracts as $contract => $service) {
            $this->app->bind($contract, $service);
        }
    }
}
