<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'name', 'status', 'visual_id',
    ];
    public function Visual()
    {
        return $this->belongsTo('App\Visual');
    }
    public function Categories(){
      return $this->Visual->belongsToMany('App\Category');
    }
    public function Questions()
    {
        return $this->belongsToMany('App\Question');
    }
    public function Disabe()
    {
        return $this->status;
    }
    public function getRecordTitle()
    {
        return $this->name;
    }
}
