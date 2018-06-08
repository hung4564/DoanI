<?php

namespace App\Policies;

use App\Traits\Policies\Policy;
use App\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Quiz::class => QuizPolicy::class,
    ];
    use Policy;
}
