<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sarana;
use App\FormPeminjamanSarana;
use App\DetailFormPeminjamanSarana;

class LaporanPeminjamanSaranaController extends Controller
{
    public function index(){
        $data['menu'] = 9;
        $data['Form'] = FormPeminjamanSarana::orderBy('created_at', 'desc')->get();

        return view('admin.laporan.ga.peminjaman.index', $data);
    }
}
