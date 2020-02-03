<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\KaryawanAll; 
use App\PKK\Periode;

class PenilaianController extends Controller
{
    public function index()
    {
        $data['menu'] = '12';
        $dateNow = date('Y-m-d');
        $data['periodeBestEmployee'] = Periode::where('status', 1)->where('kategori', 1)->where('tglMulai', '<=', $dateNow)->where('tglSelesai', '>=', $dateNow)->first();
        $data['periodeKabagToko'] = Periode::where('status', 1)->where('kategori', 3)->where('tglMulai', '<=', $dateNow)->where('tglSelesai', '>=', $dateNow)->first();
        $data['periodeKabagOffice'] = Periode::where('status', 1)->where('kategori', 2)->where('tglMulai', '<=', $dateNow)->where('tglSelesai', '>=', $dateNow)->first();
        $data['periodeKabagKepuasan'] = Periode::where('status', 1)->where('kategori', 4)->where('tglMulai', '<=', $dateNow)->where('tglSelesai', '>=', $dateNow)->first();
        return view('admin.pkk.penilaian.index', $data);
    }
}
