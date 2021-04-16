<?php

namespace App\Repositories\Category;

use App\Enums\CatType;
use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class CategoryEloquent extends BaseRepository implements CategoryRepository
{
    public function model()
    {
        return Category::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCategoryTourismName()
    {
        return $this->orderBy('id', 'DESC')->pluck('name', 'id')->find(['type' => CatType::TOURISM])->toArray();;
    }
}
