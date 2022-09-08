<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable = [
        'title',
        'content',
        'category_id'
    ];
    
    protected $table = 'posts';

    //relazione 1toMany con Category
    public function category(){
        return $this->belongsTo('App\Category');
    }

    //relazione ManytoMany con Tag
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
