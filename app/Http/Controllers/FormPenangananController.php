<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use FormPenangananIt;

class FormPenangananController extends Controller
{
    public function index(){
        $data['menu'] = '8';
        $data['form'] = FormPenangananIt::orderBy('tgl', 'desc')->get();
        
        return view('admin.form.it.index', $data);
    }
}
