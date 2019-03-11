<?php

namespace LaravelBlog;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable=['tag'];

    // Many2Many Relationship with with the post Model
    public function posts(){
        return $this->belongsToMany('LaravelBlog\Post');
    }
}
