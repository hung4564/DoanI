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
    public function Categories(){
      return $this->belongsToMany('App\Category');
    }
}
