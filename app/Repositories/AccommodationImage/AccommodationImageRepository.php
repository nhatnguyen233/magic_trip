<?php

namespace App\Repositories\AccommodationImage;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AccommodationImageRepository extends RepositoryInterface
{
    public function removeAccommodationImage($id);
}
