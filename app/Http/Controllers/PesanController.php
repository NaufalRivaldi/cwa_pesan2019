<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class PesanController extends Controller
{
    public function inbox(){
        $menu = 1;
        return view('admin.pesan.inbox', compact('menu'));
    }

    public function form(){
        $menu = 1;
        $user = User::select('id', 'email')->orderBy('email', 'asc')->get();
        return view('admin.pesan.form', compact('menu', 'user'));
    }
}
