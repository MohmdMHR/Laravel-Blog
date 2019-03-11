<?php

namespace LaravelBlog\Http\Controllers;

use LaravelBlog\Category;
use LaravelBlog\Post;
use LaravelBlog\Setting;
use LaravelBlog\Tag;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{


    // Home page when logged in, with three latest posts, and categories to navigate the blog
    public function index(){

        return view('index')
                    ->with('title', Setting::first()->site_name)
                    ->with('categories', Category::take(4)->get())
                    ->with('first_post', Post::orderBy('created_at', 'desc')->first())
                    ->with('second_post', Post::orderBy('created_at', 'desc')->skip(1)->take(2)->get()->first())
                    ->with('third_post', Post::orderBy('created_at', 'desc')->skip(2)->take(2)->get()->first())
                    ->with('cat', Category::find(7))
                    ->with('catt', Category::find(6))
                    ->with('settings', Setting::first());
    }

    // Single post view
    public function singlePost($slug){
        // finding the post using the slug
        $post =Post::where('slug', $slug)->first();

        // Identifying the newt and previous post
        $next_id= Post::where('id', '<', $post->id)->max('id');
        $prev_id= Post::where('id', '>', $post->id)->min('id');

        //Returning the view with the title, settings, cat, tags, and next/prev
        return view('single')->with('post', $post)
                ->with('title', $post->title)
                ->with('settings', Setting::first())
                ->with('categories', Category::take(4)->get())
                ->with('next', Post::find($next_id))
                ->with('prev', Post::find($prev_id))
                ->with('tags', Tag::all());

    }

    //Category view
    public function category($id){


        $category = Category::find($id);

        return view('category')->with('category', $category)
                    ->with('title', $category->name)
                    ->with('settings', Setting::first())
                    ->with('categories', Category::take(5)->get());

    }

}
