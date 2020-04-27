<?php

namespace App\Providers;

use App\Contracts\PostContract;
use App\Contracts\UserContract;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(PostContract::class, PostRepository::class);
    }
}
