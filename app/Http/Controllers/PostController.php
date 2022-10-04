<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    //
    public function index()
    {
    	$data = Post::get();
    	return view('admin.post.index', compact('data'));
    }

    public function create()
    {
    	$category = Category::get();
    	return view('admin.post.create', compact('category'));
    }

    public function insert(Request $request)
    {
    	$request->validate(Post::$rules);
    	$requests = $request->all();
    	$requests['thumbnail'] ="";
    	if($request->hasFile('thumbnail')){
    		$files = Str::random("20") . "_" . $request->thumbnail->getClientOriginalName();
    		$request->file('thumbnail')->move("file/post/", $files);
    		$requests['thumbnail'] = "file/post/" . $files;
    	}

    	$pos = Post::create($requests);
    	if($pos){
    		return redirect('admin/post')->with('status', 'Berhasil menambah data');
    	}

    	return redirect('admin/post')->with('status', 'Gagal menambah data');
    }

    public function edit($id)
    {
    	$category = Category::get();
    	$data = Post::find($id);
    	return view('admin.post.edit', compact('data'), compact('category'));
    }

    public function update(Request $request, $id)
    {
    	$d = Post::find($id);
    	if($d==null){
    		return redirect('admin/post')->with('status', 'data tidak ditemukan');
    	}

    	$req = $request->all();

    	if($request->hasFile('thumbnail')){
    		if($d->thumbnail!==null){
    			File::delete("$d->thumbnail");
			}
			$nama_asli_file=$request->thumbnail->getClientOriginalName();
			$nama_ubah=strlen($nama_asli_file)>5? substr($nama_asli_file, 0, 5): $nama_asli_file;
			$files = Str::random(7) . "_" .$nama_ubah;
    		// $post = Str::random("20") . "_" .$request->thumbnail->getClientOriginalName();
    		$request->file('thumbnail')->move("file/post/", $files);
    		$req['thumbnail'] = "file/post/" . $files;
    	}

    	$data = post::find($id)->update($req);
    	if($data){
    		return redirect('admin/post')->with('status', 'Post berhasil diedit');
    	}
    	return redirect('admin/post')->with('status', 'Gagal edit post');
    }

    public function delete($id)
    {
    	$data = Post::find($id);
    	if($data==null){
    		return redirect('admin/post')->with('status', 'data tidak ditemukan');
    	}
    	if($data->thumbnail!==null||$data->thumbnail!==""){
    		File::delete("$data->thumbnail");
    	}
    	$delete = $data->delete();
    	if($delete){
    		return redirect('admin/post')->with('status', 'Berhasil hapus post');
    	}
    	return redirect('admin/post')->with('status', 'Gagal hapus post');
    }
}