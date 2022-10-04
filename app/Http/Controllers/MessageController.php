<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //
    public function index()
    {
    	$data = Message::get();
    	return view('admin.message.index', compact('data'));
    }

    public function insert(Request $request)
    {
    	$request->validate(Message::$rules);
    	$requests = $request->all();

    	$msg = Message::create($requests);

    	if($msg){
    		return redirect('contact/');
    	}

    	return redirect('contact/');
	}
	
	public function delete($id)
    {
        $data = Message::find($id);
        if($data==null){
            return redirect('admin/message')->with('status', 'data tidak ditemukan');
        }
        $delete = $data->delete();
        if($delete){
            return redirect('admin/message')->with('status', 'Berhasil hapus');
        }
        return redirect('admin/message')->with('status', 'Gagal hapus');
    }

}
