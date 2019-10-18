<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Cabang;

class UserController extends Controller
{
    public function index(){
        $no = 1;
        $data['title'] = 'User';
        $data['user'] = User::orderBy('email', 'asc')->get();
        $data['cabang'] = Cabang::orderBy('inisial', 'desc')->get();
        $data['dep'] = $this->depOffice();
        return view('backend.user.index', compact('no', 'data'));
    }

    public function save(Request $req){
        $this->val($req);
        
        User::create([
            "nama" => $req->nama,
            "email" => $req->email,
            "email_verified_at" => date('Y-m-d H:i:s'),
            "password" => bcrypt('123456'),
            "dep" => $req->dep,
            "stat" => 1
        ]);

        return redirect('/backend/user')->with('status', 'simpan-success');
    }

    public function val($req){
        $message = [
            "required" => ":attribute tidak boleh kosong!",
            "email" => ":attribute tidak valid."
        ];

        $this->validate($req, [
            "nama" => "required",
            "email" => "required|email",
            "dep" => "required"
        ], $message);
    }

    public function depOffice(){
        $data = array(
            'IT', 'QA', 'HRD', 'Finance', 'Accounting', 'Pajak', 'GA', 'SCM', 'Gudang'
        );

        return $data;
    }
}
