<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Slider;
use App\Models\User;
use App\Models\Comment;
use App\Models\Mainmenu;
use App\Models\Profile;
use App\Models\Message;

class PortalController extends Controller
{
    //
    public function index(){
    	$data['sliders'] = Slider::where('status', 1)->get();
    	$data['posts'] = Post::where('status', 1)->get();
    	$data['latestposts'] = Post::where('status', 1)->limit(5)->get();
    	$data['headline'] = Post::where('status', 1)->where('is_headline', 1)->get();
    	$data['user'] = User::first();
    	$data['category'] = Category::get();

        $data['profile'] = Profile::first();

    	return view('portal.index', compact('data'));
    }

    public function about(){
    	$data['posts'] = Post::where('status', 1)->get();
    	$data['latestposts'] = Post::where('status', 1)->limit(5)->get();
    	$data['category'] = Category::get();
    	$data['user'] = User::first();
    	return view('portal.about', compact('data'));
    }

    public function contact(){
    	$data['posts'] = Post::where('status', 1)->get();
    	$data['latestposts'] = Post::where('status', 1)->limit(5)->get();
    	$data['category'] = Category::get();
    	// $data['user'] = User::first();

        $data['profile'] = Profile::first();
        $data['message'] = Message::get();
    	return view('portal.contact', compact('data'));
    }

    public function post(){
    	$data['posts'] = Post::where('status', 1)->get();
    	$data['latestposts'] = Post::where('status', 1)->limit(5)->get();
    	$data['category'] = Category::get();
    	// $data['user'] = User::first();

        $data['profile'] = Profile::first();
    	return view('portal.post', compact('data'));
    }

    public function postDetail($id){
    	$data['posts'] = Post::where('status', 1)->get();
    	$data['latestposts'] = Post::where('status', 1)->limit(5)->get();
    	$data['category'] = Category::get();
    	$data['comment'] = Comment::where('id_post', $id)->get();
    	// $data['user'] = User::first();
    	$posts = Post::find($id);

        // $data['message'] = Message::where('id_post', $id)->get();
        $data['profile'] = Profile::first();

    	return view('portal.detail-post', compact('posts', 'data'));
    }

    public function menu($id){
    	$data['posts'] = Post::where('status', 1)->get();
    	$data['latestposts'] = Post::where('status', 1)->limit(5)->get();
    	$data['category'] = Category::get();
    	$data['user'] = User::first();
    	$data['menu'] = Mainmenu::find($id);
    	return view('portal.menu', compact('data'));
    }

    // public function category($id){
    public function category($name){
    	// $data['posts'] = Post::where('status', 1)->where('category_id', $id)->get();
        $data['posts'] = Post::where('status', 1)->where('name', $name)->get();
    	$data['latestposts'] = Post::where('status', 1)->limit(5)->get();
    	$data['category'] = Category::get();
    	$data['user'] = User::first();

        $data['profile'] = Profile::first();
    	return view('portal.category', compact('data'));
    }

    public function search(Request $request){
    	$data['posts'] = Post::where('status', 1)
    			->where('title', 'LIKE', '%'.$request->search.'%')
    			->orWhere('content', 'LIKE', '%'.$request->search.'%')
    			->get();
    	$data['latestposts'] = Post::where('status', 1)->limit(5)->get();
    	$data['category'] = Category::get();
    	// $data['user'] = User::first();

        $data['profile'] = Profile::first();
    	return view('portal.search', compact('data'));
    }

}
