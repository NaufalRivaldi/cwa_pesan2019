<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class AuthController extends Controller
{
    public function postlogin(Request $req){
        $this->val($req);
        
        if(Auth::attempt($req->only('email', 'password'))){
            return redirect('/admin/inbox');
        }

        return redirect('/login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
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
}
