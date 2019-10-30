<?php

namespace App\Exports;

use App\FormHRD;
use App\Helpers\helper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class LaporanHRDExport implements FromView
{
    use Exportable;
    public function view(): View{
        $no = 1;
        $month = date('Y-m-01 H:i:s');
        if(empty($_GET)){
            $form = FormHRD::join('karyawan_all', 'form_hrd.karyawan_all_id', '=', 'karyawan_all.id')->orderBy('form_hrd.created_at', 'asc')->select('form_hrd.id',  'form_hrd.tgl_a', 'form_hrd.tgl_b', 'karyawan_all_id', 'keterangan', 'lembur', 'form_hrd.stat')->where('form_hrd.stat', 3)->whereHas('KaryawanAll', function($query){
             $query->whereIn('dep', helper::AllDep());
             })->where('tgl_a', '>=', $month)->get();
         }else{
             $tgl_a = '';
             $tgl_b = '';
             $kategoriSet = [];
             $dep = [];
             $urls = explode('&', $_SERVER['QUERY_STRING']);
             foreach($urls as $url){
                 $value = explode('=', $url);
                 if($value[0] == 'tgl_a')
                     $tgl_a = helper::minDay($value[1]);
                 
                 if($value[0] == 'tgl_b')
                     $tgl_b = helper::plusDay($value[1]);
 
                 if($value[0] == 'kategori')
                     $kategoriSet[] = $value[1];
 
                 if($value[0] == 'dep')
                     $dep[] = $value[1];
             }
             
             if(empty($_GET['kategori'])){
                $form = FormHRD::join('karyawan_all', 'form_hrd.karyawan_all_id', '=', 'karyawan_all.id')->orderBy('form_hrd.created_at', 'asc')->orderBy('karyawan_all.dep', 'asc')->select('form_hrd.id', 'form_hrd.tgl_a', 'form_hrd.tgl_b', 'karyawan_all_id', 'keterangan', 'lembur', 'form_hrd.stat')->where('form_hrd.stat', 3)->whereHas('KaryawanAll', function($query){
                    $urls = explode('&', $_SERVER['QUERY_STRING']);
                    $dep = [];
                    foreach($urls as $url){
                        $value = explode('=', $url);
                        if($value[0] == 'dep')
                            if($value[1] == 'All'){
                                $dep = helper::allDep();
                            }else if($value[1] == 'Office'){
                                    $dep = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak', 'MT', 'Office');
                            }else{
                                $dep[] = $value[1];
                            }
                    }
                    $query->whereIn('dep', $dep);
                })->whereBetween('tgl_a', [$tgl_a, $tgl_b])->get();
            }else{
                $form = FormHRD::join('karyawan_all', 'form_hrd.karyawan_all_id', '=', 'karyawan_all.id')->orderBy('form_hrd.created_at', 'asc')->orderBy('karyawan_all.dep', 'asc')->select('form_hrd.id', 'form_hrd.tgl_a', 'form_hrd.tgl_b', 'karyawan_all_id', 'keterangan', 'lembur', 'form_hrd.stat')->where('form_hrd.stat', 3)->whereHas('KaryawanAll', function($query){
                    $urls = explode('&', $_SERVER['QUERY_STRING']);
                    $dep = [];
                    foreach($urls as $url){
                        $value = explode('=', $url);
                        if($value[0] == 'dep')
                            if($value[1] == 'All'){
                                $dep = helper::allDep();
                            }else if($value[1] == 'Office'){
                                    $dep = array('IT', 'QA', 'GA', 'HRD', 'Gudang', 'Finance', 'Accounting', 'SCM', 'Pajak', 'MT', 'Office');
                            }else{
                                $dep[] = $value[1];
                            }
                    }
                    $query->whereIn('dep', $dep);
                })->whereHas('SetKategoriHRD', function($query){
                    $urls = explode('&', $_SERVER['QUERY_STRING']);
                    $kategori = [];
                    foreach($urls as $url){
                        $value = explode('=', $url);
                        if($value[0] == 'kategori')
                            $kategori[] = $value[1];
                    }
                    $query->whereIn('kategori_fhrd_id', $kategori);
                })->whereBetween('tgl_a', [$tgl_a, $tgl_b])->get();
            }
         }
        return view('admin.formhrd.laporan.export', compact('no', 'form', 'month'));
    }
}
