<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['name', 'choices', 'answer', 'points','question_type'];

    public function Quiz()
    {
        return $this->belongsToMany('App\Quiz');
    }

    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return 'question';
    }
}
