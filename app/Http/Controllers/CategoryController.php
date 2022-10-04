<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
    	$data = Category::get();
    	return view('admin.category.index', compact('data'));
    }

    public function create()
    {
    	return view('admin.category.create');
    }

    public function insert(Request $request)
    {
    	$request->validate(Category::$rules);
    	$requests = $request->all();
    	$requests['image'] ="";
    	if($request->hasFile('image')){
    		$files = Str::random("20") . "_" . $request->image->getClientOriginalName();
    		$request->file('image')->move("file/category/", $files);
    		$requests['image'] = "file/category/" . $files;
    	}

    	$cat = Category::create($requests);
    	if($cat){
    		return redirect('admin/category')->with('status', 'Berhasil menambah data');
    	}

    	return redirect('admin/category')->with('status', 'Gagal menambah data');
    }

    public function edit($id)
    {
    	$data = Category::find($id);
    	return view('admin.category.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
    	$d = Category::find($id);
    	if($d==null){
    		return redirect('admin/category')->with('status', 'data tidak ditemukan');
    	}

    	$req = $request->all();

    	if($request->hasFile('image')){
    		if($d->image!==null){
    			File::delete("$d->image");
			}
			$nama_asli_file=$request->image->getClientOriginalName();
			$nama_ubah=strlen($nama_asli_file)>5? substr($nama_asli_file, 0, 5): $nama_asli_file;
    		// $files = Str::random("20") . "_" .$request->image->getClientOriginalName();
			$files = Str::random(7) . "_" .$nama_ubah;
    		$request->file('image')->move("file/category/", $files);
    		$req['image'] = "file/category/" . $files;
    	}

    	$data = category::find($id)->update($req);
    	if($data){
    		return redirect('admin/category')->with('status', 'Category berhasil diedit');
    	}
    	return redirect('admin/category')->with('status', 'Gagal edit category');
    }

    public function delete($id)
    {
    	$data = Category::find($id);
    	if($data==null){
    		return redirect('admin/category')->with('status', 'data tidak ditemukan');
    	}
    	if($data->image!==null||$data->image!==""){
    		File::delete("$data->image");
    	}
    	$delete = $data->delete();
    	if($delete){
    		return redirect('admin/category')->with('status', 'Berhasil hapus category');
    	}
    	return redirect('admin/category')->with('status', 'Gagal hapus category');
    }
}
