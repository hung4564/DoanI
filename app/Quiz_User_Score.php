<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_User_Score extends Model
{
  protected $table = "quiz_user_score";
  protected $fillable = ['quiz_id','user_id', 'score', 'total'];
}
