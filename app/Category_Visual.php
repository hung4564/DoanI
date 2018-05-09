<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Visual extends Model
{
    protected $table = 'category_visual';
    protected $fillable = [
        'visual_id', 'category_id',
    ];
    public $timestamps = false;
}
