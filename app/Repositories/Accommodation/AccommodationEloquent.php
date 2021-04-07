<?php

namespace App\Repositories\Accommodation;

use App\Models\Accommodation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class AccommodationEloquent extends BaseRepository implements AccommodationRepository
{
    public function model()
    {
        return Accommodation::class;
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
     * Create Accommodation
     *
     * @param array $params
     */
    public function createAccommodation(array $params)
    {
        try {
            DB::beginTransaction();

            if (isset($params['avatar'])) {
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'accommodations/avatars/' . time() . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['name', 'slug', 'category_id','lowest_price', 'phone', 'ward_id', 'number_of_rooms',
                    'description', 'country_id', 'province_id', 'district_id', 'latitude', 'longitude',
                    'thumbnail', 'address', 'avatar', 'status']);
            }, ARRAY_FILTER_USE_KEY);

            $accommodation = $this->create($data);
            DB::commit();

            return $accommodation;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Update Accommodation
     *
     * @param array $params
     * @param int $id
     */
    public function updateAccommodation(array $params, $id)
    {
        try {
            DB::beginTransaction();
            $accommodation = $this->find($id);

            if (isset($params['avatar'])) {
                Storage::disk('s3')->delete($accommodation->avatar);
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'accommodations/avatars/' . time() . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['name', 'slug', 'category_id' ,'lowest_price', 'phone', 'ward_id', 'number_of_rooms',
                    'description', 'country_id', 'province_id', 'district_id', 'latitude', 'longitude',
                    'thumbnail', 'address', 'avatar', 'status']);
            }, ARRAY_FILTER_USE_KEY);

            $accommodation->update($data);
            DB::commit();

            return $accommodation;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Remove Accommodation
     *
     */
    public function removeAccommodation($accommodation)
    {
        try {
            DB::beginTransaction();

            $accommodation->delete();

            DB::commit();

            return true;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Insert Images Accommodation Album
     *
     * @param array $images
     * @param int $id
     * @param int $userId
     */
    public function insertAccommodationImages(array $images, $id, $userId)
    {
        try  {
            DB::beginTransaction();
            $accommodation = $this->find($id);

            if (isset($images)) {
                foreach ($images as $image) {
                    $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $fullPath = 'accommodations/images/' . $fileName;
                    Storage::disk('s3')->put($fullPath, file_get_contents($image), 'public');

                    $accommodation->images()->create([
                        'user_id' => $userId,
                        'accommodation_id' => $accommodation->id,
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
}
