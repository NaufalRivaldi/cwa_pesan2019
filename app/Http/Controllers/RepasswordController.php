<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class RepasswordController extends Controller
{
    public function index(){
        $menu = 7;
        return view('admin.repassword.index', compact('menu'));
    }

    public function save(Request $req){
        $this->val($req);

        if($req->password != $req->password2){
            session()->flash('alert', 'Password tidak sama!');
            return redirect('/admin/repassword/');
        }

        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($req->password);
        $user->save();
        
        return redirect('/admin/repassword/');
    }

    public function val($req){
        $this->validate($req, [
            'password' => 'required',
            'password2' => 'required'
        ]);
    }
}
