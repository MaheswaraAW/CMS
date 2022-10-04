<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;


class CommentController extends Controller
{
    //
    public function index()
    {
    	$data = Comment::get();
    	return view('admin.comment.index', compact('data'));
    }

    public function insert(Request $request)
    {
    	$request->validate(Comment::$rules);
    	$requests = $request->all();
    	$id_post=$request->id_post;

    	$msg = Comment::create($requests);

    	if($msg){
    		return redirect('post-detail/'. $id_post);
    	}

    	return redirect('post-detail/'. $id_post);
    }
}
