<?php

namespace App\Policies;

use App\Traits\Policies\Policy;
use App\Visual;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisualPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Visual::class => VisualPolicy::class,
    ];
    use Policy;
}
