<?php

namespace LaravelBlog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){

        return $this->hasMany('LaravelBlog\Post'); //One2Many relationship with the post model

    }
}
