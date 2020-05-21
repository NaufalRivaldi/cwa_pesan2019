<?php

namespace App\Http\Controllers\Forms\PenambahanFile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\formqa\FormQaUsulan;
use App\Exports\LaporanFormQaUsulanExport;
use App\KaryawanAll;

class LaporanFormQaUsulanController extends Controller
{
    public function index()
    {
        $data['menu'] = 9;
        $data['form'] = FormQaUsulan::orderBy('id', 'desc')->get();
        $data['month'] = date('Y-m-01 H:i:s');
        $data['pic'] = KaryawanAll::where('dep', 'QA')->where('ket', 1)->orderBy('stat', 'desc')->get();
        // dd($data['pic']);
        if($_GET){
            $tglA = $_GET['tglA'];
            $tglB = $_GET['tglB'];
            $kategoriId = $_GET['kategoriId'];
            $dep = $_GET['dep'];
            $status = $_GET['status'];
            $pic = $_GET['picId'];

            if(empty($tglA && $tglB)) {
                $data['form'] = FormQaUsulan::whereHas('karyawan', function($query) use ($dep){
                    $query->where('dep', 'like', '%'.$dep.'%');
                })->where('kategori', 'like', '%'.$kategoriId.'%')->where('status', '>=', 3)->where('status', 'like', '%'.$status.'%')->where('picId', 'like', '%'.$pic.'%')->orderBy('id', 'desc')->get();
            }else{
                $data['form'] = FormQaUsulan::whereBetween('created_at', [$tglA.' 00:00:00', $tglB.' 23:59:59'])->whereHas('karyawan', function($query) use ($dep){
                    $query->where('dep', 'like', '%'.$dep.'%')->where('id', 'like', '%'.$pic.'%');
                })->where('status', '>=', 3)->where('status', 'like', '%'.$status.'%')->where('kategori', 'like', '%'.$kategoriId.'%')->where('picId', 'like', '%'.$pic.'%')->orderBy('id', 'desc')->get();                
            }
        }else{
            $data['form'] = FormQaUsulan::where('status', '>=', 3)->orderBy('id', 'desc')->get();
        }

        return view('admin.laporan.qa.penambahanfile.index', $data);
    }

    public function export()
    {
        return (new LaporanFormQaUsulanExport)->download('laporan-penampahancopy.xlsx');
    }
}
