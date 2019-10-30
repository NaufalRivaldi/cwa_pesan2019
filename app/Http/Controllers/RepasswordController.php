<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Hash;

class RepasswordController extends Controller
{
    public function index(){
        $menu = 7;
        return view('admin.repassword.index', compact('menu'));
    }

    public function save(Request $req){
        $this->val($req);

        $user = User::find(auth()->user()->id);
        
        if(Hash::check($req->oldpassword, $user->password)){
            $user->password = bcrypt($req->password);
            $user->save();

            return redirect('/admin/repassword/')->with('success', 'Password berhasil dirubah.');
        } 
        
        return redirect('/admin/repassword/')->with('error', 'Password gagal dirubah!');
    }

    public function val($req){
        $massage = [
            "required" => "Password tidak boleh kosong!",
            "same" => "Password baru dan konfirmasi password harus sama!"
        ];

        $this->validate($req, [
            'oldpassword' => 'required',
            'password' => 'required',
            'password2' => 'required|same:password'
        ], $massage);
    }
}
