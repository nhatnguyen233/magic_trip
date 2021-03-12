<?php

namespace App\Policies;

use App\Models\Attraction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttractionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Attraction  $attraction
     * @return mixed
     */
    public function view(User $user, Attraction $attraction)
    {

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id = auth('admin')->id();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Attraction  $attraction
     * @return mixed
     */
    public function update(User $user, Attraction $attraction)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Attraction  $attraction
     * @return mixed
     */
    public function delete(User $user, Attraction $attraction)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Attraction  $attraction
     * @return mixed
     */
    public function restore(User $user, Attraction $attraction)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Attraction  $attraction
     * @return mixed
     */
    public function forceDelete(User $user, Attraction $attraction)
    {
        //
    }
}
