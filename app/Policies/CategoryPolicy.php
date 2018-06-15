<?php

namespace App\Policies;

use App\Category;
use App\User;
use App\Traits\Policies\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Category::class => CategoryPolicy::class,
    ];
    use Policy;

    public function viewList(User $user)
    {
        return $user->isAdmin();
    }
}
