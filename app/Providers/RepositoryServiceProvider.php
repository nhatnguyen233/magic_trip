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
use App\Repositories\Accommodation\AccommodationEloquent;
use App\Repositories\Accommodation\AccommodationRepository;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Payment\PaymentEloquent;
use App\Repositories\Tour\TourEloquent;
use App\Repositories\Tour\TourRepository;
use App\Repositories\TourInfo\TourInfoEloquent;
use App\Repositories\TourInfo\TourInfoRepository;
use App\Repositories\Review\ReviewEloquent;
use App\Repositories\Review\ReviewRepository;
use App\Repositories\AccommodationImage\AccommodationImageEloquent;
use App\Repositories\AccommodationImage\AccommodationImageRepository;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryEloquent;
use App\Repositories\BookTour\BookTourEloquent;
use App\Repositories\BookTour\BookTourRepository;
use App\Repositories\Host\HostRepository;
use App\Repositories\Host\HostRepositoryEloquent;
use App\Repositories\Schedule\ScheduleEloquent;
use App\Repositories\Schedule\ScheduleRepository;
use App\Repositories\Bill\BillRepository;
use App\Repositories\Bill\BillRepositoryEloquent;
use App\Repositories\Event\EventRepositoryEloquent;
use App\Repositories\Event\EventRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var \string[][]
     */
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
        [
            'abstract' => AccommodationRepository::class,
            'concrete' => AccommodationEloquent::class,
        ],
        [
            'abstract' => TourRepository::class,
            'concrete' => TourEloquent::class,
        ],
        [
            'abstract' => TourInfoRepository::class,
            'concrete' => TourInfoEloquent::class,
        ],
        [
            'abstract' => ReviewRepository::class,
            'concrete' => ReviewEloquent::class,
        ],
        [
            'abstract' => AccommodationImageRepository::class,
            'concrete' => AccommodationImageEloquent::class,
        ],
        [
            'abstract' => PaymentRepository::class,
            'concrete' => PaymentEloquent::class,
        ],
        [
            'abstract' => CartRepository::class,
            'concrete' => CartRepositoryEloquent::class,
        ],
        [
            'abstract' => BookTourRepository::class,
            'concrete' => BookTourEloquent::class,
        ],
        [
            'abstract' => HostRepository::class,
            'concrete' => HostRepositoryEloquent::class,
        ],
        [
            'abstract' => ScheduleRepository::class,
            'concrete' => ScheduleEloquent::class,
        ],
        [
            'abstract' => BillRepository::class,
            'concrete' => BillRepositoryEloquent::class,
        ],
        [
            'abstract' => EventRepository::class,
            'concrete' => EventRepositoryEloquent::class,
        ]
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
