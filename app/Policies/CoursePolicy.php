<?php

namespace App\Policies;

use App\Traits\Policies\Policy;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];
    use Policy;
}
