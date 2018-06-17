<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'detail',
    ];
    public $timestamps = false;
    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return $this->name;
    }
}
