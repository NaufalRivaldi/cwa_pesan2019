<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FormPeminjamanSarana;

class FormPeminjamanController extends Controller
{
    public function index(){
        $data['menu'] = 8;
        $data['no'] = 1;
        
        $data['formProgress'] = FormPeminjamanSarana::where('status', '<', '2')->orderBy('created_at', 'desc')->get();

        $data['formSelesai'] = FormPeminjamanSarana::where('status', '>', '1')->orderBy('created_at', 'desc')->get();

        return view('admin.form.ga.peminjaman.index', $data);
    }

    public function form(){
        $data['menu'] = 8;
    
        return view('admin.laporam.ga.sarana.index', $data);
    }
}
