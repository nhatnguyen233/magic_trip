<?php

namespace App\Repositories\AccommodationImage;

use App\Models\AccommodationImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class AccommodationImageEloquent extends BaseRepository implements AccommodationImageRepository
{
    public function model()
    {
        return AccommodationImage::class;
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

    public function removeAccommodationImage($id)
    {
        try {
            Storage::disk('s3')->delete($this->find($id)->url);

            DB::beginTransaction();
            $this->find($id)->delete($id);
            DB::commit();

            return true;
        } catch (Exception $e)
        {
            Log::error($e);
            DB::rollBack();
        }
    }
}
