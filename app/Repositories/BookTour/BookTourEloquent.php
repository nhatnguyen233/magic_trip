<?php

namespace App\Repositories\BookTour;

use App\Enums\BookingStatus;
use App\Enums\BookType;
use App\Models\BookTour;
use App\Repositories\Bill\BillRepository;
use App\Repositories\Host\HostRepository;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class BookTourEloquent extends BaseRepository implements BookTourRepository
{
    protected $billRepository;
    protected $hostRepository;

    public function __construct(Application $app, BillRepository $billRepository, HostRepository $hostRepository)
    {
        $this->billRepository = $billRepository;
        $this->hostRepository = $hostRepository;
        parent::__construct($app);
    }

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

    public function getBookTourByHostID($hostID, $params)
    {
        $bookings = $this->hostRepository->find($hostID)->bookings;

        if(isset($params['status']))
        {
            return $bookings->where('status', $params['status']);
        }

        return $bookings;
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
                        $this->updateOrCreate([
                            'tour_id' => $item['tour_id'],
                            'user_id' => $userId,
                            'date_of_book' => $item['date_of_book'],
                            'status' => BookingStatus::PENDING
                        ],[
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

    public function payment($userId)
    {
        $payment = $this->model->where('user_id', $userId)
                        ->where( 'status', BookingStatus::APPROVED)
                        ->update(['status' => BookingStatus::PAID]);
        $afterPayment = $this->model->where('user_id', $userId)
                        ->where( 'status', BookingStatus::PAID)
                        ->get();

        if(isset($afterPayment) && $afterPayment != null)
        {
            foreach ($afterPayment as $item)
            {
                $this->billRepository->create([
                    'book_tour_id' => $item->id,
                    'user_id' => $userId,
                    'host_id' => $item->tour->host_id,
                    'total_price' => $item->total_price,
                ]);
            }
        }

        return $payment;
    }
}
