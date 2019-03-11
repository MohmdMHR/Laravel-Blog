<?php

namespace LaravelBlog;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Fillable attributes 
    protected $fillable = ['stite_name', 'address', 'contact_number', 'contact_email'];
}
