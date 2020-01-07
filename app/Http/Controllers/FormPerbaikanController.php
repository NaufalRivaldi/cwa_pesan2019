<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormPerbaikanController extends Controller
{
    public function index(){
        $data['menu'] = 8;
        
        return view('admin.form.ga.perbaikan.index', $data);
    }

    public function form(){
        $data['menu'] = 8;

        return view('admin.form.ga.perbaikan.form', $data);
    }
}
