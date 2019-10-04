<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function inbox(){
        $menu = 1;
        return view('admin.pesan.inbox', compact('menu'));
    }
}
