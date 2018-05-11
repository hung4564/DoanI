<?php

namespace App\Policies;

use App\Quiz;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;
    protected $policies = [
        Category::class => CategoryPolicy::class,
    ];
    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can list models.
     *
     * @param  User $user
     * @return mixed
     */
    public function viewList(User $user)
    {
        return $user->isAdmin();
    }
    /**
     * Determine whether the user can view the quiz.
     *
     * @param  \App\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function view(User $user, Quiz $quiz)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create quizzes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the quiz.
     *
     * @param  \App\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function update(User $user, Quiz $quiz)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the quiz.
     *
     * @param  \App\User  $user
     * @param  \App\Quiz  $quiz
     * @return mixed
     */
    public function delete(User $user, Quiz $quiz)
    {
        return $user->isAdmin();
    }
}
