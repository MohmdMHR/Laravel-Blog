<?php

namespace LaravelBlog\Http\Controllers;


use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use LaravelBlog\Category;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Rendering the cat view, with categories passed 
    public function index()
    {
        $categories = Category::all();
        //return view('categories.index')->with('categories', Category::all());
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required'
        ]);

        $category=new Category;
        $category->name = $request->name;
        $category->save();

        Toastr::success('Created');

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $category = Category::find($id);

        Toastr::info('Editing');

        return view('categories.edit', compact('category'));

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

        $category=Category::find($id);
        $category->name = $request->name;
        $category->save();

        Toastr::success('Updated');

        return redirect()->route('categories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);

        foreach ($category->posts as $post){
            $post->forceDelete();
        }

        $category->delete();

        Toastr::success('Deleted');

        return redirect()->route('categories');
    }
}
