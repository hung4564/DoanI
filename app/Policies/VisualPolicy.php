<?php

namespace App\Policies;

use App\Traits\Policies\Policy;
use App\Visual;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisualPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Visual::class => VisualPolicy::class,
    ];
    use Policy;
    public function viewList(User $user)
    {
        return $user->isAdmin();
    }
}
