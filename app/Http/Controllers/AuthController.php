<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class AuthController extends Controller
{
    public function login(){
        if(!empty(auth()->user()->email)){
            return redirect('/admin/pesan/inbox');
        }
        return view('frontend.login');
    }
    
    public function postlogin(Request $req){
        $this->val($req);
        $attempts = [
            'email' => $req->email,
            'password' => $req->password,
            'stat' => 1
        ];
        
        if(Auth::attempt($attempts)){
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('status', 'fail-login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    // function
    public function val($req){
        $message = [
            'required' => ':attribute tidak boleh kosong.',
            'email' => 'Format email tidak valid.'
        ];

        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required'
        ], $message);
    }

    // backend
    public function postloginbackend(Request $req){
        $this->valBack($req);

        $username = $req->username;
        $password = $req->password;
        if($username == 'it' && $password == '1sampai9'){
            session(['username' => $username]);
            return redirect('/backend/scoreboard');
        }

        return redirect('/backend')->with('status', 'fail-login');
    }

    public function logoutbackend(){
        session()->forget('username');
        return redirect('/backend');
    }

    // function
    public function valBack($req){
        $message = [
            'required' => ':attribute tidak boleh kosong.'
        ];

        $this->validate($req, [
            'username' => 'required',
            'password' => 'required'
        ], $message);
    }
}
