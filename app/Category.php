<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'detail',
    ];
    public $timestamps = false;
    public static function getAll()
    {
        return Category::All();
    }
    /**
     * @return mixed
     */
    public function getRecordTitle()
    {
        return $this->name;
    }
}
