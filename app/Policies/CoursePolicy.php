<?php

namespace App\Policies;

use App\Course;
use App\Traits\Policies\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];
    use Policy;
    public function viewDetail(User $user)
    {
        return $user->isAdmin();
    }
    public function addQuiz(User $user, $model)
    {
        return $user->isAdmin();
    }
    public function removeQuiz(User $user, $model)
    {
        return $user->isAdmin();
    }
    public function addStudent(User $user, $model)
    {
        return $user->isAdmin();
    }
    public function removeStudent(User $user, $model)
    {
        return $user->isAdmin();
    }
}
