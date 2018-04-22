<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces;
use App\Repositories;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(
                Interfaces\UsersRepositoryInterface::class, Repositories\EloquentUsersRepository::class
        );
        $this->app->singleton(
                Interfaces\RolesRepositoryInterface::class, Repositories\EloquentRolesRepository::class
        );
        $this->app->singleton(
                Interfaces\MeasurementUnitsRepositoryInterface::class, Repositories\EloquentMeasurementUnitsRepository::class
        );
        $this->app->singleton(
                Interfaces\ItemCategoriesRepositoryInterface::class, Repositories\EloquentItemCategoriesRepository::class
        );
        $this->app->singleton(
                Interfaces\SuppliersRepositoryInterface::class, Repositories\EloquentSuppliersRepository::class
        );
        $this->app->singleton(
                Interfaces\ItemsRepositoryInterface::class, Repositories\EloquentItemsRepository::class
        );
        $this->app->singleton(
                Interfaces\ItemBatchesRepositoryInterface::class, Repositories\EloquentItemBatchesRepository::class
        );
    }

}
