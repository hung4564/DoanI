<?php

namespace App;

use App\User;

class Reports
{
    private $totalUsers;
    private $totalCategory;
    private $totalVisual;
    private $totalQuiz;
    private $totalCourse;
    private $totalQuestion;
    /**
     * @return integer
     */
    public function getTotalUsers()
    {
        if (is_null($this->totalUsers)) {
            $this->totalUsers = User::count();
        }

        return $this->totalUsers;
    }
    /**
     * @return integer
     */
    public function getTotalCategory()
    {
        if (is_null($this->totalCategory)) {
            $this->totalCategory = Category::count();
        }

        return $this->totalCategory;
    }
    /**
     * @return integer
     */
    public function getTotalVisual()
    {
        if (is_null($this->totalVisual)) {
            $this->totalVisual = Visual::count();
        }

        return $this->totalVisual;
    } 
    public function getTotalQuiz()
    {
        if (is_null($this->totalQuiz)) {
            $this->totalQuiz = Quiz::count();
        }

        return $this->totalQuiz;
    }
    public function getTotalCourse(){
      if (is_null($this->totalCourse)) {
        $this->totalCourse = Course::count();
    }

    return $this->totalCourse;
    }
    public function getTotalQuestion(){
      if (is_null($this->totalQuestion)) {
        $this->totalQuestion = Question::count();
    }

    return $this->totalQuestion;
    }
}
