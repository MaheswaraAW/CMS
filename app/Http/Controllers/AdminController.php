<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //
	public function index()
	{
		return view('admin.dashboard');
	}

    public function register()
    {
    	return view('admin.register');
    }

    public function postRegister(Request $request)
    {
    	$request->validate(User::$rules);
    	$requests = $request->all();
    	$requests['password'] = Hash::make($request->password);
    	$requests['image'] = "";
    	if($request->hasFile('image')){
    		$files = Str::random("20") . "_" . $request->image->getClientOriginalName();
    		$request->file('image')->move("file/admin/", $files);
    		$requests['image'] = "file/admin/" . $files;
    	}

    	$user = User::create($requests);
    	if($user){
    		return redirect('register')->with('status', 'Berhasil mendaftar!');
    	}

    	return redirect('register')->with('status', 'Gagal mendaftar!');
    }

    public function login()
    {
    	return view('admin.login');
    }

    public function postLogin(Request $request)
    {
    	$requests = $request->all();
    	$data = User::where('email', $requests['email'])->first();
    	$cek = Hash::check($requests['password'], $data->password);
    	if($cek){
    		Session::put('admin', $data->email);
    		Session::put('admin_id', $data->id);
    		return redirect('admin');
    	}
    	return redirect('login')->with('status', 'Gagal login admin!');
    }

    public function logout()
    {
    	Session::flush();
    	return redirect('login')->with('status', 'Berhasil logout!');
    }

    public function edit($id)
    {
        $data = User::find($id);
        $profile = Profile::find($id);
        return view('admin.profile.edit', compact('data'), compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $d = Profile::find($id);
        if($d==null){
            $request->validate(Profile::$rules);
            $requests = $request->all();
            $requests['photo'] ="";
            if($request->hasFile('photo')){
                $files = Str::random("20") . "_" . $request->photo->getClientOriginalName();
                $request->file('photo')->move("file/profile/", $files);
            $requests['photo'] = "file/profile/" . $files;
            }

            $profile = Profile::create($requests);
            if($profile){
                return redirect('admin/profile/'.$id)->with('status', 'Berhasil menambah data');
            }
        }

        $req = $request->all();

        if($request->hasFile('photo')){
            if($d->photo!==null){
                File::delete("$d->photo");
            }
            $profile = Str::random("20") . "_" .$request->photo->getClientOriginalName();
            $request->file('photo')->move("file/profile/", $profile);
            $req['photo'] = "file/profile/" . $profile;
        }

        $profile = Profile::find($id)->update($req);
        if($profile){
            return redirect('admin/profile/'.$id)->with('status', 'Profile berhasil diedit');
        }
        return redirect('admin/profile/'.$id)->with('status', 'Gagal edit profile');
    }
}