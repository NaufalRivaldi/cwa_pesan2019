<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Karyawan;
use App\HistoryJual;
use App\RecordScore;
use App\Kriteria;
use App\Setting;
use App\KodeBarang;

use DB;
use DateTime;

// helper
use App\Helpers\helper;

class ScoreProdukController extends Controller
{
    public function index(Request $req){
        $data['menu'] = 10;
        $data['divisi'] = Karyawan::select('divisi')->groupBy('divisi')->orderBy('divisi')->get();

        $data['setting'] = Setting::find(1);
        $data['score'] = HistoryJual::orderBy('tgl', 'desc')->first();
        $data['diff'] = $this->date($data['setting']->last_update_score);

        // get
        $data['score_jual'] = "";
        $data['no'] = 1;
        if($req){
            // deklarasi variabel
            $tgl_a = $req->input('dari_tgl');
            $tgl_b = $req->input('sampai_tgl');
            $div = '';
            $arr = array();
            $produk = $req->input('produk');
            $karyawan = $this->karyawan();
            if(!empty($req->input('divisi'))){
                $div = $req->input('divisi');
            }

            // query jika group dan tidak group
            $sql_produk = KodeBarang::where('nmbr', 'like', '%'.$produk.'%')->get();
            foreach($sql_produk as $r){
                $arr[] = $r['kdbr'];
            }

            if(!empty($req->input('group'))){
                $data['score_jual'] = HistoryJual::select('kd_sales', 'tgl', 'divisi', DB::raw('SUM(skor) AS total_skor'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('divisi')->Where('divisi', 'like', '%'.$div.'%')->whereIn('kd_barang', $arr)->orderBy('total_skor', 'desc')->get();
            }else{
                $data['score_jual'] = HistoryJual::select('kd_sales', 'tgl', 'divisi', DB::raw('SUM(skor) AS total_skor'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('kd_sales')->Where('divisi', 'like', '%'.$div.'%')->whereIn('kd_barang', $arr)->orderBy('total_skor', 'desc')->get();
            }
        }

        return view('admin.scoreproduk.index', $data);
    }

    public function detail(Request $req){
        // variable
        $data['menu'] = 10;
        $tgl_a = $req->input('dari_tgl');
        $tgl_b = $req->input('sampai_tgl');
        $divisi = $req->input('divisi');
        $kd_sales = $req->input('kd_sales');

        $data['setting'] = Setting::find(1);
        $data['score'] = HistoryJual::orderBy('tgl', 'desc')->first();
        $data['diff'] = $this->date($data['setting']->last_update_score);

        // query
        $produk = $_GET['produk'];
        $sql_produk = KodeBarang::where('nmbr', 'like', '%'.$produk.'%')->get();
        foreach($sql_produk as $r){
            $arr[] = $r['kdbr'];
        }

        $data['karyawan'] = Karyawan::where('kd_sales', $kd_sales)->where('divisi', $divisi)->first();
        $data['score_jual'] = HistoryJual::select('tgl', 'kd_barang', DB::raw('SUM(jml) AS total_jml'), DB::raw('SUM(skor) AS total_skor'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('kd_barang')->where('kd_sales', $kd_sales)->whereIn('kd_barang', $arr)->orderBy('tgl', 'desc')->get();

        // covert divisi
        $data['divisi'] = helper::get_divisi($divisi);

        return view('admin.scoreproduk.detail', $data);
    }

    // function tambahan
    public function date($past){
        // selisih tgl
        $past = new DateTime($past);
        $now = new DateTime();

        $diff = $past->diff($now);
        return $diff->d;
    }
    public function karyawan(){
        $karyawan = Karyawan::where('stat', '1')->get();
        $arr = [];
        foreach($karyawan as $row){
            $arr[$row->kd_sales] = $row->nama;
        }

        return $arr;
    }
}
