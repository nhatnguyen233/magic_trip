<?php

namespace App\Repositories\Bill;

use App\Models\Bill;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class BillRepositoryEloquent extends BaseRepository implements BillRepository
{
    public function model()
    {
        return Bill::class;
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

    public function getList(array $params, $hostID)
    {
        return $this->model
            ->join('users', 'bills.user_id', '=', 'users.id')
            ->select('bills.id', 'users.name', 'bills.host_id', 'bills.user_id', 'bills.total_price', 'bills.book_tour_id', 'bills.created_at')
            ->when(isset($params['username']), function ($q) use ($params) {
                $q->where('users.name', 'like', '%' . $params['username'] . '%');
            })
            ->when(isset($params['start_time']), function ($q) use ($params) {
                $q->whereDate('bills.created_at', '>=', date('Y-m-d', strtotime($params['start_time'])));
            })
            ->when(isset($params['end_time']), function ($q) use ($params) {
                $q->whereDate('bills.created_at', '<=', date('Y-m-d', strtotime($params['end_time'])));
            })
            ->where('host_id', $hostID)
            ->groupBy('bills.id','users.name', 'bills.host_id', 'bills.user_id', 'bills.book_tour_id', 'bills.created_at', 'bills.total_price')
            ->get();
    }
}
