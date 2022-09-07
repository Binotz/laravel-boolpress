<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "categories";
    protected $fillable = [
        'title',
        'slug'
    ];

    protected function post(){
    return $this->hasMany('App\Post');
    }
}
