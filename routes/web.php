<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// The index page - Handled by the frontEnd Controller
Route::get('/', 'FrontEndController@index')->name('index');
//Rendering posts as single views. passig the slug as a path parameter, to make paths prettier 
Route::get('/post/{slug}', 'FrontEndController@singlePost')->name('post.single');
//Search results views
Route::get('/results', function(){
    //storing the search query in a post variable
    $posts =\App\Post::where('title', 'like', '%' . request('query') . '%')->get();

    //returning the search results as view, organized in 5 posts, ordered by the last updated post and 
    return view('results')->with('posts', $posts)
        ->with('title', 'search results: ' . request('query'))
        ->with('settings', \App\Setting::first())
        ->with('categories', \App\Category::take(5)->get())
        ->with('query', request('query'));
});

//Helper method for generating authentication routes
Auth::routes();

//Routes that are protected by the auth middleware, and prefixed with "admin" to differentiate them
//basically all aour routes, to make the app more secure and not visible whe not authenticated
Route::group(['prefix' => 'admin', 'middleware' => 'auth' ], function(){

    // Admin Dashboard
    Route::get('/home', 'HomeController@index')->name('home');
    // Create and store posts
    Route::get('post/create', 'PostController@create')->name('post.create');
    Route::post('/post/store', 'PostController@store')->name('post.store');
    // Create and store cats
    Route::get('/category/create', 'CategoriesController@create')->name('category.create');
    Route::post('/category/store', 'CategoriesController@store')->name('category.store');
    // Showing categories view
    Route::get('/categories', 'CategoriesController@index')->name('categories');
    // Edit, Delete, Update Categories
    Route::get('/category/edit/{id}', 'CategoriesController@edit')->name('category.edit');
    Route::get('/category/delete/{id}', 'CategoriesController@destroy')->name('category.delete');
    Route::post('/category/update/{id}', 'CategoriesController@update')->name('category.update');
    // Showing posts view
    Route::get('/posts', 'PostController@index')->name('posts');
    // Posts Delete
    Route::get('post/delete/{id}', 'PostController@destroy')->name('post.delete');
    // For soft deleted posts
    Route::get('/posts/trashed', 'PostController@trashed')->name('post.trashed');
    // Permantly deleting posts
    Route::get('/posts/kill/{id}', 'PostController@kill')->name('post.kill');
    // restoring trashed posts
    Route::get('/posts/restore/{id}', 'PostController@restore')->name('post.restore');
    // Posts edit and update
    Route::get('/posts/edit/{id}', 'PostController@edit')->name('post.edit');
    Route::post('post/update/{id}', 'PostController@update')->name('post.update');
    // Showing Tags view
    Route::get('/tags', 'TagsController@index')->name('tags');
    // Categories CRUD
    Route::get('/tag/create', 'TagsController@create')->name('tag.create');
    Route::post('/tag/store', 'TagsController@store')->name('tag.store');
    Route::get('/tag/edit/{id}', 'TagsController@edit')->name('tag.edit');
    Route::post('/tag/update/{id}', 'TagsController@update')->name('tag.update');
    Route::get('/tag/delete/{id}', 'TagsController@destroy')->name('tag.delete');
    // Showing the blog users    
    Route::get('/users', 'UsersController@index')->name('users');
    // Creating/storing a user
    Route::get('user/create', 'UsersController@create')->name('user.create');
    Route::post('/user/store', 'UsersController@store')->name('user.store');
    // Giving/Revoking admin privellages to users
    Route::get('user/admin/{id}', 'UsersController@admin')->name('user.admin');
    Route::get('user/not_admin/{id}', 'UsersController@not_admin')->name('user.not.admin');
    // User profiles RUD
    Route::get('user/profile', 'ProfilesController@index')->name('user.profile');
    Route::post('user/profile/update', 'ProfilesController@update')->name('user.profile.update');
    Route::get('user/profile/delete/{id}', 'UsersController@destroy')->name('user.delete');
    // Blog Settings view, only accessible by admins
    Route::get('/settings', 'SettingsController@index')->name('settings')->middleware('admin');
    Route::post('/settings/update/', 'SettingsController@update')->name('settings.update')->middleware('admin');
    //Showing a single category
    Route::get('/category/{id}', 'FrontEndController@category')->name('category.single');



});

