<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visual extends Model
{
    protected $fillable = [
        'name', 'path',
    ];
    public $timestamps = false;

/**
 * @return mixed
 */
    public function getRecordTitle()
    {
        return $this->name;
    }
    public function getCategory(){
      return $this->belongsToMany('App\Category');
    }
}
