<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LaporanPerbaikanSaranaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\FormPerbaikanSarana;

class LaporanPerbaikanSaranaController extends Controller
{
    public function index(){
        $data['menu'] = 9;
        $data['no'] = 1;
        $data['dateFirst'] = date('Y-m-01');
        $data['dateNow'] = date('Y-m-d');

        if(!$_GET){
            $data['form'] = FormPerbaikanSarana::where('status', '>', '1')->where('status', '<', '5')->orderBy('tglPengajuan', 'asc')->get();
        }else{
            $data['form'] = FormPerbaikanSarana::where('status', '>', '1')
                            ->where('status', '<', '5')
                            ->orderBy('tglPengajuan', 'asc')
                            ->where('tglPengajuan', '>=', $_GET['tgl_a'])
                            ->where('tglPengajuan', '<=', $_GET['tgl_b'])
                            ->where('status', 'like', '%'.$_GET['status'].'%')
                            ->whereHas('user', function($query){
                                $query->where('dep', 'like', '%'.$_GET['dep'].'%');
                            })->get();
        }
        
        return view('admin.laporan.ga.perbaikan.index', $data);
    }

    public function export(){
        return (new LaporanPerbaikanSaranaExport)->download('laporan-perbaikan.xlsx');
    }

}
