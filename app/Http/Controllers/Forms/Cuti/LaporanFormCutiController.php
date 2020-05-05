<?php

namespace App\Http\Controllers\Forms\Cuti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\formcuti\FormCuti;
use App\Forms\formcuti\Cuti;
use App\Forms\formcuti\DetailFormCuti;
use App\Forms\formcuti\KategoriCuti;
use DB;

class LaporanFormCutiController extends Controller
{
    public function index()
    {
        $data['menu'] = '9';
        $data['no'] = '1';
        $data['kategori'] = KategoriCuti::all();
        $data['cuti'] = Cuti::select('*', DB::raw('sum(sisaCuti) as sisa'))->groupBy('idKaryawan')->whereHas('karyawan', function($query){
            $query->orderBy('dep', 'asc');
        })->get();

        if($_GET){
            $tglA = $_GET['tglA'];
            $tglB = $_GET['tglB'];
            $kategoriId = $_GET['kategoriId'];
            $dep = $_GET['dep'];
            $status = $_GET['status'];

            if(empty($kategoriId)){
                $data['formCuti'] = FormCuti::whereBetween('created_at', [$tglA.' 00:00:00', $tglB.' 23:59:59'])->whereHas('karyawan', function($query) use ($dep, $kategoriId){
                    $query->where('dep', 'like', '%'.$dep.'%');
                })->where('status', '>=', 4)->where('status', 'like', '%'.$status.'%')->orderBy('id', 'desc')->get();
            }else{
                $data['formCuti'] = FormCuti::whereBetween('created_at', [$tglA.' 00:00:00', $tglB.' 23:59:59'])->whereHas('karyawan', function($query) use ($dep, $kategoriId){
                    $query->where('dep', 'like', '%'.$dep.'%')->whereHas('cuti', function($query) use ($kategoriId){
                        $query->where('idKategori', $kategoriId);
                    });
                })->where('status', '>=', 4)->where('status', 'like', '%'.$status.'%')->orderBy('id', 'desc')->get();
            }
        }else{
            $data['formCuti'] = FormCuti::where('status', '>=', 4)->orderBy('id', 'desc')->get();
        }
        return view('admin.form.hrd.formcuti.laporan.index', $data);
    }

    public function detail($id)
    {
        $data['no'] = '1';
        $data['menu'] = '9';
        $data['cuti'] = Cuti::where('idKaryawan', $id)->select('*', DB::raw('sum(sisaCuti) as sisa'))->first();
        $data['detailCuti'] = DetailFormCuti::whereHas('formCuti', function($query) use ($id){
            $query->where('karyawanId', $id);
        })->get();
        // dd($data['detailCuti']);
        return view('admin.form.hrd.formcuti.laporan.detail', $data);
    }
}
