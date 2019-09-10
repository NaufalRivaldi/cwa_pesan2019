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
        $divisi = array(
            'CW1' => 'CW 1',
            'CW2' => 'CW 2',
            'CW3' => 'CW 3',
            'CW4' => 'CW 4',
            'CW5' => 'CW 5',
            'CW6' => 'CW 6',
            'CW7' => 'CW 7',
            'CW8' => 'CW 8',
            'CW9' => 'CW 9',
            'CA0' => 'CW 10',
            'CA1' => 'CW 11',
            'CA2' => 'CW 12',
            'CA3' => 'CW 13',
            'CA4' => 'CW 14',
            'CA5' => 'CW 15',
            'CA6' => 'CW 16',
            'CA7' => 'CW 17',
            'CA8' => 'CW 18',
            'CA9' => 'CW 19',
            'CL1' => 'CW Lombok'
        );

        $setting = Setting::find(1);
        $score = HistoryJual::orderBy('tgl', 'desc')->first();
        $diff = $this->date($setting->last_update_score);

        // get
        $score_jual = "";
        $no = 1;
        if($req){
            $tgl_a = $req->input('dari_tgl');
            $tgl_b = $req->input('sampai_tgl');

            $karyawan = $this->karyawan();
            $score_jual = HistoryJual::select('kd_sales', 'tgl', 'divisi', DB::raw('SUM(skor) AS total_skor'))->whereBetween('tgl', [$tgl_a, $tgl_b])->groupBy('divisi')->orderBy('total_skor', 'desc')->get();
        }

        return view('frontend.score', compact('divisi', 'setting', 'score', 'diff', 'score_jual', 'no'));
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
