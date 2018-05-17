<?php

namespace CodeEduUser\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $defer = false;

    public function register()
    {
        $this->app->bind(\CodeEduUser\Repositories\UserRepository::class, \CodeEduUser\Repositories\UserRepositoryEloquent::class);
    }

    public function provides()
    {
        return [];
    }
}