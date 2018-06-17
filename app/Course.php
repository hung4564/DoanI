<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'teacher_id', 'code_invite', 'detail', 'status_id',
    ];
    public function Students()
    {
        return $this->belongsToMany('App\User')->wherePivot('status_id', 1);
    }
    public function Students_wait()
    {
        return $this->belongsToMany('App\User')->wherePivot('status_id', 0);
    }
    public function Teacher()
    {
        return $this->belongsTo('App\User');
    }
    public function Status()
    {
        return $this->belongsTo('App\Status');
    }
    public function IsEnable()
    {
        return (int) $this->status_id !== 0;
    }
    public function IsPublic()
    {
        return (int) $this->status_id === 1;
    }
    public function getRecordTitle()
    {
        return $this->name;
    }
    public function Categories()
    {
        return $this->belongsToMany('App\Category');
    }
    public function Quizzes()
    {
        return $this->belongsToMany('App\Quiz')->withPivot('level');
    }
    public function haveQuestion($idQuiz)
    {
        if ($this->Quizzes()->exists()) {
            return $this->Quizzes->contains($idQuiz);
        }
        return false;
    }
    public function Lessons(){
      return $this->hasMany('App\Lesson');
    }
}
