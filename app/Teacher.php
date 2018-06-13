<?php

namespace App;

use App\Course;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  protected $fillable = [
    'user_id', 'status_id'
  ];
  public function Courses(){
    return $this->hasMany('App\Course');
  }
}
