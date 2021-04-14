<?php

namespace App\Repositories\Review;

use App\Models\Review;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Helpers\FilterTrait;
use Prettus\Repository\Exceptions\RepositoryException;
class ReviewEloquent extends BaseRepository implements ReviewRepository
{
    use FilterTrait;

    public function model()
    {
        return Review::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createReview(array $params)
    {
        $data = array_filter($params, function ($key) {
            return in_array($key, ['customer_name', 'user_id', 'accommodation_id', 'room_id', 'content',
                'rate', 'email', 'tour_id']);
        }, ARRAY_FILTER_USE_KEY);

        return $this->create($data);
    }

    public function getList($userId, $filters = [], $sorts = [], $relations = [], $limit = 10, $select = ['*'])
    {
        $limit = $limit ?? config('common.default_per_page');
        $filterable = [
            'tour_name'  => function ($q, $val) {
                if ($val !== 'ALL') {
                    return $q->where('tour_id', $val);
                }
            },
        ];

        $query = $this->whereHas('tour', function($query) use($userId) {
                return $query->where(['user_id' => $userId]);
             })

            ->orderBy('created_at', 'DESC');

        return $this->filterPaginate(
            $query,
            $limit,
            $filters,
            $sorts,
            $filterable,
            $select
        );
    }
}
