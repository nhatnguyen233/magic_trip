<?php

namespace App\Repositories\TourInfo;

use App\Models\TourInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Exception;

class TourInfoEloquent extends BaseRepository implements TourInfoRepository
{
    public function model()
    {
        return TourInfo::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createTourInfo(array $params)
    {
        try {
            DB::beginTransaction();

            if (isset($params['thumbnail'])) {
                $fileName = Str::uuid() . '.' . $params['thumbnail']->getClientOriginalExtension();
                $fullPath = 'tours/infos/thumbnails/' . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['thumbnail']), 'public');
                $params['thumbnail'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['tour_id', 'attraction_id', 'accommodation_id', 'start_time', 'limit_time', 'title',
                    'vehicle', 'order_number', 'summary', 'thumbnail']);
            }, ARRAY_FILTER_USE_KEY);

            $tourInfo = $this->create($data);
            DB::commit();

            return $tourInfo;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }
}
