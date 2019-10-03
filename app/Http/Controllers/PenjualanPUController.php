<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use DB;
use DateTime;

use App\Karyawan;
use App\HistoryJual;
use App\RecordScore;
use App\Kriteria;
use App\Setting;

// helper
use App\Helpers\helper;

class PenjualanPUController extends Controller
{
    public function index(Request $req){
        $menu = 4;
        $divisi = Karyawan::select('divisi')->groupBy('divisi')->orderBy('divisi')->get();

        $setting = Setting::find(1);
        $score = HistoryJual::orderBy('tgl', 'desc')->first();
        $diff = $this->date($setting->last_update_score);

        // get
        $score_jual = "";
        $no = 1;
        if($req){
            // deklarasi variabel
            $tgl_a = $req->input('dari_tgl');
            $tgl_b = $req->input('sampai_tgl');
            $div = '';
            if(!empty($req->input('divisi'))){
                $div = $req->input('divisi');
            }

            $score_jual = HistoryJual::select('divisi', DB::raw('SUM(jml*brt) AS total_brt'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('divisi')->Where('divisi', 'like', '%'.$div.'%')->orderBy('total_brt', 'desc')->get();
        }
 
        return view('admin.pu.index', compact('divisi', 'setting', 'score', 'diff', 'score_jual', 'no', 'menu'));
    }

    public function detail(Request $req){
        // variable
        $menu = 4;
        $tgl_a = $req->input('dari_tgl');
        $tgl_b = $req->input('sampai_tgl');
        $divisi = $req->input('divisi');
        $kd_sales = $req->input('kd_sales');

        $setting = Setting::find(1);
        $score = HistoryJual::orderBy('tgl', 'desc')->first();
        $diff = $this->date($setting->last_update_score);

        // query
        $karyawan = Karyawan::where('kd_sales', $kd_sales)->where('divisi', $divisi)->first();
        $score_jual = HistoryJual::select('tgl', 'kd_barang', DB::raw('SUM(jml) AS total_jml'), DB::raw('SUM(skor) AS total_skor'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('kd_barang')->where('kd_sales', $kd_sales)->orderBy('tgl', 'desc')->get();

        // covert divisi
        $divisi = helper::get_divisi($divisi);

        return view((empty(auth()->user())) ? 'frontend.score-detail' : 'admin.score.detail', compact('setting', 'score', 'diff', 'divisi', 'score_jual', 'karyawan', 'menu'));
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
