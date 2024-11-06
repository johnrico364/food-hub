<?php

namespace App\Providers;

use App\Domain\Recipes\RecipesRepository;
use App\Infrastructure\Persistence\Eloquent\Recipes\EloquentRecipesRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RecipesRepository::class, EloquentRecipesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
