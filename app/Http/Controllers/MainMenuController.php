<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\MainMenu;

class MainMenuController extends Controller
{
    //
    public function index()
    {
    	$data = MainMenu::get();
    	return view('admin.mainmenu.index', compact('data'));
    }

    public function create()
    {
    	$parent = MainMenu::get();
    	return view('admin.mainmenu.create', compact('parent'));
    }

    public function insert(Request $request)
    {
        $request->validate(MainMenu::$rules);
        $requests = $request->all();
        $requests['file'] ="";
        if($request->hasFile('file')){
            $files = Str::random("20") . "_" . $request->file->getClientOriginalName();
            $request->file('file')->move("file/mainmenu/", $files);
            $requests['file'] = "file/mainmenu/" . $files;
        }

        $mainmenu = MainMenu::create($requests);
        if($mainmenu){
            return redirect('admin/mainmenu')->with('status', 'Berhasil menambah data');
        }

        return redirect('admin/mainmenu')->with('status', 'Gagal menambah data');
    }

    public function edit($id)
    {
        $data = MainMenu::find($id);
        $mainmenu = MainMenu::get();
        return view('admin.mainmenu.edit', compact('data'), compact('mainmenu'));
    }

    public function update(Request $request, $id)
    {
        $d = MainMenu::find($id);
        if($d==null){
            return redirect('admin/mainmenu')->with('status', 'data tidak ditemukan');
        }

        $req = $request->all();

        if($request->hasFile('file')){
            if($d->file!==null){
                File::delete("$d->thumbnail");
            }
            $mainmenu = Str::random("20") . "_" .$request->file->getClientOriginalName();
            $request->file('file')->move("file/mainmenu/", $mainmenu);
            $req['file'] = "file/mainmenu/" . $mainmenu;
        }

        $data = MainMenu::find($id)->update($req);
        if($data){
            return redirect('admin/mainmenu')->with('status', 'Mainmenu berhasil diedit');
        }
        return redirect('admin/mainmenu')->with('status', 'Gagal edit mainmenu');
    }

    public function delete($id)
    {
        $data = MainMenu::find($id);
        if($data==null){
            return redirect('admin/mainmenu')->with('status', 'data tidak ditemukan');
        }
        if($data->file!==null||$data->file!==""){
            File::delete("$data->file");
        }
        $delete = $data->delete();
        if($delete){
            return redirect('admin/mainmenu')->with('status', 'Berhasil hapus mainmenu');
        }
        return redirect('admin/mainmenu')->with('status', 'Gagal hapus mainmenu');
    }
}
