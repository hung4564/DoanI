<?php

namespace App\Policies;

use App\Course;
use App\Traits\Policies\Policy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];
    use Policy;
    public function viewDetail(User $user, $model)
    {
        return $user->isTeacher();
    }
    public function addQuiz(User $user, $model)
    {
        return $user->isTeacher();
    }
    public function removeQuiz(User $user, $model)
    {
        return $user->isTeacher();
    }
    public function addStudent(User $user, $model)
    {
        return $user->isTeacher();
    }
    public function removeStudent(User $user, $model)
    {
        return $user->isTeacher();
    }
}
