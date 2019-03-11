<?php

namespace LaravelBlog;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use SoftDeletes; // Records to be deleted from the view but not destroyed in the DB. Laravel adds a deleted_at property on the record
    
    // Records that are allowed to be fillable when migrating the DB or when inserting values from the view
    protected $fillable = [
        'title',
        'content',
        'feature',
        'category_id',
        'slug',
        'user_id'
    ];

    public function getFeatureAttribute($feature){
      return asset($feature);
    }

    protected $dates = ['deleted_at'];

    // Many2One relationship with the category model
    public function category(){

        return $this->belongsTo('LaravelBlog\Category');

    }

    //Many2Many Relationship with with the tag Model
    public function tags(){
        return $this->belongsToMany('LaravelBlog\Tag');
    }

    //Many2One Relationship with the user model
    public function user(){

        return $this->belongsTo('LaravelBlog\User');

    }

}
