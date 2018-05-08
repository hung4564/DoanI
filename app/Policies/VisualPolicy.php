<?php

namespace App\Policies;

use App\User;
use App\Visual;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisualPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Visual::class => VisualPolicy::class,
    ];
    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can list models.
     *
     * @param  User $user
     * @return mixed
     */
    public function viewList(User $user)
    {
        return $user->isAdmin();
    }
    /**
     * Determine whether the user can view the visual.
     *
     * @param  \App\User  $user
     * @param  \App\Visual  $visual
     * @return mixed
     */
    public function view(User $user, Visual $visual)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create visuals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the visual.
     *
     * @param  \App\User  $user
     * @param  \App\Visual  $visual
     * @return mixed
     */
    public function update(User $user, Visual $visual)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the visual.
     *
     * @param  \App\User  $user
     * @param  \App\Visual  $visual
     * @return mixed
     */
    public function delete(User $user, Visual $visual)
    {
        return $user->isAdmin();
    }
}
