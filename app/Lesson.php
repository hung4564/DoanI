<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'link', 'type'];
    public function getRecordTitle()
    {
        return 'Lessons';
    }
}
