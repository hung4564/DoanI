<?php

namespace App\Policies;

use App\Lesson;
use App\User;
use App\Traits\Policies\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Lesson::class => LessonPolicy::class,
    ];
    use Policy;
}
