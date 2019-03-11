<?php

namespace LaravelBlog;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // Limiting the visibility of these attributes from json arrays 
    protected $hidden = [
        'password', 'remember_token',
    ];

    // One2One relationship with the profile model
    public function profile(){

        return $this->hasOne('LaravelBlog\Profile');

    }

    //One2Many relationship with the post model
    public function posts(){

        return $this->hasMany('LaravelBlog\Post');

    }

}
