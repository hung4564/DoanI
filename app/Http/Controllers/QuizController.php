<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Quiz_User_Answer;
use \App\Quiz_User_Score;

class QuizController extends Controller
{
  public function postQuiz(Request $request, $id)
  {
      if (Auth::check()) {
          $iduser = Auth::user()->id;
      } else {
          $iduser = "";
      }
      $data = ["quiz_id"=>$id,"user_id" => $iduser, "score" => 0, "total" => 0];
      $score = Quiz_User_Score::Create($data);
      $score_id = $score->id;
      $question_true = 0;
      $question_ids = $request['questions'];
      foreach ($question_ids as $question_id) {
          $answer = $request["answer_$question_id"];
          $questionAnswer = $request["questionanswer_$question_id"];
          if ($answer === $questionAnswer) {
              $question_true++;
          }
      }
      $data['score'] = $question_true;
      $data['total'] = count($question_ids);
      $score->update($data);
      echo $data['score'];
  }
}
