<?php

namespace App\Repositories\AttractionImage;

use App\Models\AttractionImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class AttractionImageEloquent extends BaseRepository implements AttractionImageRepository
{
    public function model()
    {
        return AttractionImage::class;
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

    public function removeAttractionImage($id)
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
