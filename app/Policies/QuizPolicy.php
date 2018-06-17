<?php

namespace App\Policies;

use App\Quiz;
use App\Traits\Policies\Policy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Quiz::class => QuizPolicy::class,
    ];
    use Policy;

    public function addQuestion(User $user, $model)
    {
        return $user->isTeacher();
    }
    public function removeQuestion(User $user, $model)
    {
        return $user->isTeacher();
    }
    public function viewDetail(User $user, $model)
    {
        return $user->isTeacher();
    }
}
