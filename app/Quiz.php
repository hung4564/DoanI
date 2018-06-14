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
    public function Categories()
    {
        return $this->Visual->belongsToMany('App\Category');
    }
    public function Teacher()
    {
        return $this->belongsToMany('App\User')->first();
    }
    public function Questions()
    {
        return $this->belongsToMany('App\Question');
    }
    public function Course()
    {
        return $this->belongsToMany('App\Course');
    }
    public function User()
    {
        return $this->belongsToMany('App\User');
    }
    public function Disabe()
    {

        return (int) $this->status == 0;
    }

    public function IsPublic()
    {
        return (int) $this->status === 1;
    }
    public function Status()
    {
        return $this->belongsTo('App\Status', 'status');
    }
    public function getRecordTitle()
    {
        return $this->name;
    }
}
