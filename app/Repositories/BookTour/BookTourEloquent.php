<?php

namespace App\Repositories\BookTour;

use App\Enums\BookingStatus;
use App\Enums\BookType;
use App\Models\BookTour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class BookTourEloquent extends BaseRepository implements BookTourRepository
{
    public function model()
    {
        return BookTour::class;
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

    public function createBookTour($userId, $type, $carts)
    {
        try {
            if($type == BookType::OFFLINE)
            {
                if(isset($carts) && $carts != null)
                {
                    foreach ($carts as $item)
                    {
                        $this->create([
                            'tour_id' => $item['tour_id'],
                            'user_id' => $userId,
                            'date_of_book' => $item['date_of_book'],
                            'number_of_slots' => $item['number_of_slots'],
                            'total_price' => $item['total_price'],
                            'status' => BookingStatus::PENDING
                        ]);
                    }
                }
            }

            return $this->findWhere(['user_id' => $userId])->toArray();
        } catch (Exception $e)
        {
            Log::error($e);
            DB::rollBack();
            throw $e;
        }
    }
}
