<?php

namespace LaravelBlog\Http\Controllers;
use LaravelBlog\Category;
use Auth;
use LaravelBlog\Post;
use LaravelBlog\Tag;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Creating a post, and validating the tags and cats, and returning the post view
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        if($categories->count()==0 || $tags->count()==0 ){
            Toastr::info('Cant create posts without Categories or Tags');
            return redirect()->back();
        }
        return view('posts.create')->with('categories', $categories)
                                         ->with('tags', Tag::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating data necessary for the creation of a post
        $this->validate($request, [
            'title' => 'required',
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
            'tags'=>'required'
        ]);

        //Getting the featured image, adn storing it in the DB in a proper form
        $featured = $request->featured;


        $featured_new_name = time().$featured->getClientOriginalName();

        $featured->move('uploads/posts/', $featured_new_name);


        //Creating the post with the data passed in the form, and, the featured image, and adding a slug 
        $post = Post::create([
           'title'=>$request->title,
            'content'=>$request->content,
            'feature'=>'uploads/posts/' . $featured_new_name,
            'category_id' => $request->category_id,
            'slug'=>str_slug($request->title),
            'user_id' => Auth::id()
        ]);

        //linking the post with its tags
        $post->tags()->attach($request->tags);

        Toastr::success('Post Created');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit')->with('post', $post)
                                       ->with('categories', Category::all())
                                       ->with('tags', Tag::all());


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        //Updating the post with necessary data

        $this->validate($request, [
            'title' => 'required',
           // 'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $post = Post::find($id);
        //taking care of the featured image
        if($request->hasFile('featured')){
            $featured=$request->featured;

            $featured_new_name= time() . $featured->getClientOriginalName();
            $featured->move('uploades/posts', $featured_new_name);

            $post->feature=$featured_new_name;
        }

        //saving the post
        $post->title=$request->title;
        $post->content=$request->content;
        $post->category_id=$request->category_id;

        $post->save();

        //syncing the posts and the tags tables, by making an intermediate tabel of IDs 
        $post->tags()->sync($request->tags);

        Toastr::success('Post Updated');

        return redirect()->route('posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        Toastr::success('Post Deleted');

        return redirect()->back();
    }

    public function trashed(){

        $posts = Post::onlyTrashed()->get();

        return view('posts.trashed')->with('posts', $posts);
    }

    //Permanetly deleting soft deleted posts
    public function kill($id){

        $post = Post::withTrashed()->where('id', $id)->first();

        $post->forceDelete();

        Toastr::success('Permanently Deleted');

        return redirect()->back();
    }

    // Restoring soft deleted posts
    public function restore($id){

        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();

        Toastr::success('Post Restored');

        return redirect()->route('posts');

    }
}
