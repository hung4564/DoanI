<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'link', 'type','user_id','course_id'];
    public function getRecordTitle()
    {
        return 'Lessons';
    }
}
