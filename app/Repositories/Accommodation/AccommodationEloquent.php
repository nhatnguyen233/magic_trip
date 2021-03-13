<?php

namespace App\Repositories\Accommodation;

use App\Models\Accommodation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class AccommodationEloquent extends BaseRepository implements AccommodationRepository
{
    public function model()
    {
        return Accommodation::class;
    }

    /**
     * Boot up the repository, pushing criteria
     *
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Create Accommodation
     *
     * @param array $params
     */
    public function createAccommodation(array $params)
    {

    }

    /**
     * Update Accommodation
     *
     * @param array $params
     * @param int $id
     */
    public function updateAccommodation(array $params, $id)
    {

    }

    /**
     * Remove Accommodation
     *
     */
    public function removeAccommodation($id)
    {
    }
}
