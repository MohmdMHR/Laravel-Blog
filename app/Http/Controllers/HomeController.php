<?php
namespace LaravelBlog\Http\Controllers;
use LaravelBlog\Category;
use LaravelBlog\Post;
use LaravelBlog\Tag;
use Illuminate\Http\Request;
use LaravelBlog\User;
use DB;
use Charts;
class HomeController extends Controller
{
    //Dashboard, accessible by the admins
    //Showing describtle data of the whole blog
    public function index(){
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $posts = Post::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $categories = Category::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $tags = Tag::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::multiDatabase('bar', 'material')
            ->title("Blog Statistics")
            ->colors(['#2196F3', '#F44336', '#FFC107', '#07FF8B'])
            ->dataset('Users', $users)
            ->dataset('Posts', $posts)
            ->dataset('Categories', $categories)
            ->dataset('Tags', $tags)
            ->groupByMonth(date('Y'), true);
        return view('home',compact('chart'));
    }
}