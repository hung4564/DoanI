<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'teacher_id','code_invite','detail'
    ];
    public function Students(){
      return $this->belongsToMany('App\User');
    }
    public function Teacher(){
      return $this->belongsTo('App\User');
    }
    public function Status()
    {
      return $this->belongsTo('App\Status');
    }
    public function getRecordTitle()
    {
      return $this->name;
    }
}
