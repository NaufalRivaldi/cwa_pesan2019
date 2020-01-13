<?php

namespace App\Exports;

use App\FormPerbaikanSarana;
use App\Helpers\helper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class LaporanPerbaikanSaranaExport implements FromView
{
    use Exportable;
    public function view(): View{
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
        
        return view('admin.laporan.ga.perbaikan.export', $data);
    }
}
