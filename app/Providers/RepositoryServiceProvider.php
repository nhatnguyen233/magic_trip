<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\Attraction\AttractionRepository;
use App\Repositories\Attraction\AttractionEloquent;
use App\Repositories\AttractionImage\AttractionImageRepository;
use App\Repositories\AttractionImage\AttractionImageEloquent;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryEloquent;
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
            'abstract' => AttractionRepository::class,
            'concrete' => AttractionEloquent::class,
        ],
        [
            'abstract' => AttractionImageRepository::class,
            'concrete' => AttractionImageEloquent::class,
        ],
        [
            'abstract' => CategoryRepository::class,
            'concrete' => CategoryEloquent::class,
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
