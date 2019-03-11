<?php

namespace LaravelBlog;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    // One2One relationship with the user model
    public function user(){

        return $this->belongsTo('LaravelBlog\User');

    }

    // fillable attributes
    protected $fillable=['user_id', 'avatar', 'youtube', 'facebook', 'about'];

}
