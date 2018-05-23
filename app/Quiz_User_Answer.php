<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_User_Answer extends Model
{
  protected $table = "quiz_user_answer";   
  protected $fillable = ['quiz_user_score_id', 'question_id', 'answer'];
}
