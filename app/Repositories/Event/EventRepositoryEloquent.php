<?php

namespace App\Repositories\Event;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Exception;

class EventRepositoryEloquent extends BaseRepository implements EventRepository
{
    public function model()
    {
        return Event::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getList($params)
    {
        return $this->model->latest()->get();
    }

    public function createEvent(array $params)
    {
        try {
            DB::beginTransaction();

            if (isset($params['avatar'])) {
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'tour/avatars/' . time() . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['user_id', 'title', 'description', 'author', 'type', 'avatar']);
            }, ARRAY_FILTER_USE_KEY);

            $event = $this->create($data);
            DB::commit();

            return $event;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    public function updateEvent(array $params, $id)
    {
        try {
            DB::beginTransaction();
            $event = $this->find($id);

            if (isset($params['avatar'])) {
                Storage::disk('s3')->delete($event->avatar);
                $fileName = Str::uuid() . '.' . $params['avatar']->getClientOriginalExtension();
                $fullPath = 'tour/avatars/' . time() . $fileName;
                Storage::disk('s3')->put($fullPath, file_get_contents($params['avatar']), 'public');
                $params['avatar'] = $fullPath;
            }

            $data = array_filter($params, function ($key) {
                return in_array($key, ['user_id', 'title', 'description', 'author', 'type', 'avatar']);
            }, ARRAY_FILTER_USE_KEY);


            $event->update($data);
            DB::commit();

            return $event;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    public function removeEvent($event)
    {
        try {
            DB::beginTransaction();

            $event->delete();

            DB::commit();

            return true;
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            throw $exception;
        }
    }
}
