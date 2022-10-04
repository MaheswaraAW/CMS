<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Slider;
use App\Models\Category;

class SliderController extends Controller
{
    //
    public function index()
    {
    	$data = Slider::get();
    	return view('admin.slider.index', compact('data'));
    }

    public function create()
    {
    	$slider = Slider::get();
        $category = Category::get();
    	return view('admin.slider.create', compact('slider'), compact('category'));
    }

    public function insert(Request $request)
    {
    	$request->validate(Slider::$rules);
    	$requests = $request->all();
    	$requests['image'] ="";
    	if($request->hasFile('image')){
    		$files = Str::random("20") . "_" . $request->image->getClientOriginalName();
    		$request->file('image')->move("file/slider/", $files);
    		$requests['image'] = "file/slider/" . $files;
    	}

    	$sld = Slider::create($requests);
    	if($sld){
    		return redirect('admin/slider')->with('status', 'Berhasil menambah data');
    	}

    	return redirect('admin/slider')->with('status', 'Gagal menambah data');
    }

    public function edit($id)
    {
    	$data = Slider::find($id);
        $category = Category::get();
    	return view('admin.slider.edit', compact('data'), compact('category'));
    }

    public function update(Request $request, $id)
    {
    	$d = Slider::find($id);
    	if($d==null){
    		return redirect('admin/slider')->with('status', 'data tidak ditemukan');
    	}

    	$req = $request->all();

    	if($request->hasFile('image')){
    		if($d->image!==null){
    			File::delete("$d->image");
			}
			$nama_asli_file=$request->image->getClientOriginalName();
			$nama_ubah=strlen($nama_asli_file)>5? substr($nama_asli_file, 0, 5): $nama_asli_file;
			// $files = Str::random("3") . "_" .$request->image->getClientOriginalName();
			$files = Str::random(7) . "_" .$nama_ubah;
    		$request->file('image')->move("file/slider/", $files);
    		$req['image'] = "file/slider/" . $files;
    	}

    	$data = Slider::find($id)->update($req);
    	if($data){
    		return redirect('admin/slider')->with('status', 'Post berhasil diedit');
    	}
    	return redirect('admin/slider')->with('status', 'Gagal edit post');
    }

    public function delete($id)
    {
    	$data = Slider::find($id);
    	if($data==null){
    		return redirect('admin/slider')->with('status', 'data tidak ditemukan');
    	}
    	if($data->image!==null||$data->image!==""){
    		File::delete("$data->image");
    	}
    	$delete = $data->delete();
    	if($delete){
    		return redirect('admin/slider')->with('status', 'Berhasil hapus slider');
    	}
    	return redirect('admin/slider')->with('status', 'Gagal hapus slider');
    }
}
