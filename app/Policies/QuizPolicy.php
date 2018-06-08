<?php

namespace App\Policies;

use App\Traits\Policies\Policy;
use App\Quiz;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Quiz::class => QuizPolicy::class,
    ];
    use Policy;
}
