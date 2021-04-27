<?php

namespace App\Repositories\AttractionImage;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AttractionImageRepository extends RepositoryInterface
{
    public function removeAttractionImage($id);
}
