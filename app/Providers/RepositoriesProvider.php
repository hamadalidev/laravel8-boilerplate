<?php

namespace App\Providers;

use App\Models\AbstractModel;
use App\Models\GameType;
use App\Repositories\GameTypeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    private array $repositoriesList = [
        GameTypeRepository::class => GameType::class
        ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositoriesList as $repository => $resource) {
            $this->app->when($repository)
                ->needs(AbstractModel::class)
                ->give(function () use ($resource) {
                    return new $resource;
                });
        }

    }

}
