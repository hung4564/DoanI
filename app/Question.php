<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['name', 'choices', 'answer', 'points', 'question_type','user_id'];

    public function Quiz()
    {
        return $this->belongsToMany('App\Quiz');
    }
    public function User(){
        return $this->belongsTo('App\User');
    }
    public function Choices()
    {
        $choices = [];
        if ($this->question_type == 0) {
            $choices = "";
        } else if ($this->question_type == 1) {
            $choices = ['True', 'False'];
        } else if ($this->question_type == 2) {
            $choices = explode(";", $this->choices);
        }
        return $choices;
    }
    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return 'question';
    }
}
