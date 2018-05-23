<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_User_Score extends Model
{
  protected $table = "quiz_user_score";   
  protected $fillable = ['user_id', 'score', 'answer', 'total'];
}
