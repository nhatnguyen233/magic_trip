<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\Category\CategoriesRepository;
use App\Repositories\Category\CategoriesEloquent;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Province\ProvinceEloquent;
use App\Repositories\District\DistrictRepository;
use App\Repositories\District\DistrictEloquent;

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
        [
            'abstract' => ProvinceRepository::class,
            'concrete' => ProvinceEloquent::class,
        ],
        [
            'abstract' => DistrictRepository::class,
            'concrete' => DistrictEloquent::class,
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