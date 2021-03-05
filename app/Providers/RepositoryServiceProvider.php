<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\Category\CategoriesRepository;
use App\Repositories\Category\CategoriesEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        [
            'abstract' => UserRepository::class,
            'concrete' => UserRepositoryEloquent::class,
        ],
        [
            'abstract' => CategoriesRepository::class,
            'concrete' => CategoriesEloquent::class,
        ],
    ];

    /**
     * Register service.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $repository) {
            $this->app->bind($repository['abstract'], $repository['concrete']);
        }
    }

    /**
     * Bootstrap service.
     *
     * @return void
     */
    public function boot()
    {

    }
}