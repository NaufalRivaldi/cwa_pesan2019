<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\helper;

use App\User;
use App\Cabang;

class UserController extends Controller
{
    public function index(){
        $no = 1;
        $data['title'] = 'User';
        $data['user'] = User::orderBy('dep', 'asc')->get();
        $data['cabang'] = Cabang::orderBy('inisial', 'desc')->get();
        $data['dep'] = helper::allDep();
        return view('backend.user.index', compact('no', 'data'));
    }

    public function edit($id){
        $data['title'] = 'User Edit';
        $data['user'] = User::find($id);
        $data['cabang'] = Cabang::orderBy('inisial', 'desc')->get();
        $data['dep'] = helper::allDep();
        return view('backend.user.form', $data);
    }

    public function update(Request $req){
        $user = user::find($req->id);
        $user->nama = $req->nama;
        $user->email = $req->email;
        $user->dep = $req->dep;
        $user->level = $req->level;
        $user->save();

        return redirect()->route('backend.user')->with('success', 'Data berhasil di edit.');
    }

    public function save(Request $req){
        $this->val($req);
        
        User::create([
            "nama" => $req->nama,
            "email" => $req->email,
            "email_verified_at" => date('Y-m-d H:i:s'),
            "password" => bcrypt('123456'),
            "dep" => $req->dep,
            "stat" => 1,
            "level" => $req->level
        ]);

        return redirect('/backend/user')->with('status', 'simpan-success');
    }

    public function resetPassword($id){       
        $user = User::find($id);
        $user->password = bcrypt('123456');
        $user->save();

        return redirect('/backend/user')->with('status', 'reset-success');
    }

    public function nonactive($id){       
        $user = User::find($id);
        $user->stat = 2;
        $user->save();

        return redirect('/backend/user');
    }

    public function active($id){       
        $user = User::find($id);
        $user->stat = 1;
        $user->save();

        return redirect('/backend/user');
    }

    public function val($req){
        $message = [
            "required" => ":attribute tidak boleh kosong!",
            "email" => ":attribute tidak valid."
        ];

        $this->validate($req, [
            "nama" => "required",
            "email" => "required|email",
            "dep" => "required",
            "level" => "required"
        ], $message);
    }
}
