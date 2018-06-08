<?php

namespace App\Policies;

use App\Traits\Policies\Policy;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Category::class => CategoryPolicy::class,
    ];
    use Policy;
}
