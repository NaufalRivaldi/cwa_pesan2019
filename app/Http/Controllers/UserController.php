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
            "dep" => "required"
        ], $message);
    }

    public function depOffice(){
        $data = array(
            'CW1',
            'CW2',
            'CW3',
            'CW4',
            'CW5',
            'CW6',
            'CW7',
            'CW8',
            'CW9',
            'CA0',
            'CA1',
            'CA2',
            'CA3',
            'CA4',
            'CA5',
            'CA6',
            'CA7',
            'CA8',
            'CA9',
            'CS1',
            'CL1',
            'HRD',
            'Finance',
            'Accounting',
            'Pajak',
            'QA',
            'GA',
            'IT',
            'SCM',
            'Gudang',
            'Office'
        );

        return $data;
    }
}
