<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pengumuman;
use App\User;
use App\AttachPengumuman;
use App\Setting;
use App\HistoryJual;
use App\Karyawan;

use DateTime;
use DB;

// helper
use App\Helpers\helper;

class HomeController extends Controller
{
    public function index(){
        $date_now = date('Y-m-d H:i:s');
        $pengumuman = Pengumuman::orderBy('tgl', 'desc')->paginate(10);
        return view('frontend.index', compact('pengumuman', 'date_now'));
    }

    public function detail($id){
        $pengumuman = Pengumuman::find($id);
        $file = AttachPengumuman::where('pengumuman_id', $id)->get();
        return view('frontend.detail', compact('pengumuman', 'file'));
    }

    public function scoreboard(Request $req){
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
            $karyawan = $this->karyawan();
            if(!empty($req->input('divisi'))){
                $div = $req->input('divisi');
            }

            // query jika group dan tidak group
            if(!empty($req->input('group'))){
                $score_jual = HistoryJual::select('kd_sales', 'tgl', 'divisi', DB::raw('SUM(skor) AS total_skor'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('divisi')->Where('divisi', 'like', '%'.$div.'%')->orderBy('total_skor', 'desc')->get();
            }else{
                $score_jual = HistoryJual::select('kd_sales', 'tgl', 'divisi', DB::raw('SUM(skor) AS total_skor'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('kd_sales')->Where('divisi', 'like', '%'.$div.'%')->orderBy('total_skor', 'desc')->get();
            }
        }

        return view('frontend.score', compact('divisi', 'setting', 'score', 'diff', 'score_jual', 'no'));
    }

    public function scoreboarddetail(Request $req){
        // variable
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

        return view('frontend.score-detail', compact('setting', 'score', 'diff', 'divisi', 'score_jual', 'karyawan'));
    }

    public function login(){
        return view('frontend.login');
    }
    
    public function inbox(){
        return view('admin.inbox');
    }

    // backend
    public function backend(){
        return view('backend.login');
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
