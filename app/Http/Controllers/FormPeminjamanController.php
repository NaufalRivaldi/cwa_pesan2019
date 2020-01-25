<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormPeminjamanController extends Controller
{
    public function index(){
        $data['menu'] = 8;
        $data['no'] = 1;

        return view('admin.form.ga.peminjaman.index', $data);
    }
}
