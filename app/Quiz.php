<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'name', 'status', 'visual_id',
    ];
    public function Question()
    {
        return $this->belongsTo('App\Visual');
    }
    public function Disabe()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return $this->name;
    }
}
