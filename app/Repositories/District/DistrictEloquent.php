<?php

namespace App\Repositories\District;

use App\Models\District;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class DistrictEloquent extends BaseRepository implements DistrictRepository
{
    public function model()
    {
        return District::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function search($params)
    {
        $district = array('data' => $this->all());

        if(isset($params['province'])) {
            $district = array('data' => $this->findWhere(['province_id' => $params['province']]));
        }

        if(isset($params['page'])) {
            if($params['province']) {
                $district = $this->where('province_id', $params['page'])->paginate(15);
            } else {
                $district = $this->paginate(15);
            }
        }

        return $district;
    }
}
