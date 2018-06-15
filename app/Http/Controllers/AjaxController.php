<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\User;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function getInfoQuiz($idQuiz)
    {
        $Quiz = Quiz::find($idQuiz);
        if ($Quiz != null) {
            $user = $Quiz->User()->first();
            if (Auth::user()->id == $user->id) {
                echo 'Quiz Info<br>';
                echo 'Quiz Name:';
                echo $Quiz->name;
            }
        } else {
            echo "The quiz does not exist or you dont have right to change it";
        }
    }
    public function getInfoStudent($idUser)
    {
        $user = User::find($idUser);
        if ($user != null) {
            if (Auth::user()->id != $user->id) {
              echo 'User Info<br>';
              echo 'User Name:';
              echo $user->name;
              echo '<br>';
              echo 'User Email:';
              echo $user->email;
            }
            else {
              echo "you cannot add yourself";
            }
        } else {
            echo "The quiz does not exist or you dont have right to change it";
        }
    }
    public function test()
    {
        echo "Testt ajax";
    }
}
