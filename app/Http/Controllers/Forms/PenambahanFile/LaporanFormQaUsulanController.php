<?php

namespace App\Http\Controllers\Forms\PenambahanFile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\formqa\FormQaUsulan;
use App\Cabang;

class LaporanFormQaUsulanController extends Controller
{
    public function index()
    {
        $data['menu'] = 9;
        $data['form'] = FormQaUsulan::orderBy('id', 'desc')->get();
        $data['month'] = date('Y-m-01 H:i:s');
        $data['cabang'] = Cabang::orderBy('inisial', 'asc')->get();
        return view('admin.laporan.qa.penambahanfile.index', $data);
    }
}
