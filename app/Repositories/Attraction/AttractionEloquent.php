<?php

namespace App\Repositories\Attraction;

use App\Models\Attraction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class AttractionEloquent extends BaseRepository implements AttractionRepository
{
    public function model()
    {
        return Attraction::class;
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

    /**
     * Create Attraction
     *
     * @param array $params
     */
    public function createAttraction(array $params)
    {
        try {
            DB::beginTransaction();

            $data = array_filter($params, function ($key) {
                return in_array($key, ['name', 'slug', 'title', 'category_id', 'ward_id',
                    'description', 'country_id', 'province_id', 'district_id', 'latitude', 'longitude',
                    'thumbnail', 'address', 'zipcode', 'avatar']);
            }, ARRAY_FILTER_USE_KEY);

            $attraction = $this->create($data);
            DB::commit();

            return $attraction;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Update Attraction
     *
     * @param array $params
     * @param int $id
     */
    public function updateAttraction(array $params, $id)
    {
        try {
            DB::beginTransaction();
            $attraction = $this->find($id);

            if (isset($params['avatar'])) {
                Storage::disk('s3')->delete($attraction->avatar);
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'attractions/avatars/' . time() . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            if (isset($params['thumbnail'])) {
                Storage::disk('s3')->delete($attraction->thumbnail);
                $fileName = Str::uuid() . '.' . $params['thumbnail']->getClientOriginalExtension();
                $fullPath = 'attractions/thumbnails/' . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['thumbnail']), 'public');
                $params['thumbnail'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['name', 'slug', 'title', 'category_id', 'ward_id',
                    'description', 'country_id', 'province_id', 'district_id', 'latitude', 'longitude',
                    'thumbnail', 'address', 'zipcode', 'avatar']);
            }, ARRAY_FILTER_USE_KEY);

            $attraction->update($data);
            DB::commit();

            return $attraction;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    public function updateAttractionImages(array $images, $id, $userId)
    {
        try  {
            DB::beginTransaction();
            $attraction = $this->find($id);

            if (isset($images)) {
                foreach ($images as $image) {
                    $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $fullPath = 'attractions/images/' . $fileName;
                    Storage::disk('s3')->put($fullPath, file_get_contents($image), 'public');

                    $attraction->images()->create([
                        'user_id' => $userId,
                        'attraction_id' => $attraction->id,
                        'url' => $fullPath,
                    ]);
                }
            }
            DB::commit();

            return true;
        } catch (Exception $exception)
        {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Remove Attraction
     *
     */
    public function removeAttraction($id)
    {
        try {
            DB::beginTransaction();

            $attraction = $this->find($id);
            if($attraction->images != null) {
                foreach ($attraction->images()->get() as $item) {
                    Storage::disk('s3')->delete($item->url);
                }
                $attraction->images()->delete();
            }

            if($attraction->thumbnail) {
                Storage::disk('s3')->delete($attraction->thumbnail);
            }

            if($attraction->avatar) {
                Storage::disk('s3')->delete($attraction->avatar);
            }

            if($attraction->images != null) {
                foreach ($attraction->images()->get() as $item) {
                    Storage::disk('s3')->delete($item);
                }
                $attraction->images()->delete();
            }

            $attraction->delete();

            DB::commit();

            return true;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }
}
