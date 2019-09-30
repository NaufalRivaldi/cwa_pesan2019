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

class ScoreboardController extends Controller
{
    public function index(){
        return view('backend.scoreboard.index');
    }

    public function save(Request $req){
        $this->val($req);
        
        if($req->hasfile('file')){
            $file = $req->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = strtolower($file->getClientOriginalName());

            // cek extension .cwa
            if($ext != 'cwa'){
                return redirect('/backend/scoreboard')->with('status', 'fail-score');
            }

            // upload
            $file->move(public_path().'/file-score/', $name);

            // getjson data untuk query
            $text = file_get_contents(public_path().'/file-score/'.$name);
            $array = json_decode($text, true);

            $tgl = $array['tgl'];
            $karyawan = $array['karyawan'];
            $skor = $array['skor'];
            $addQuery = $array['query'];
            $kriteria = $array['kriteria'];

            // logika simpan karyawan, simpan score, simpan record score per orang, simpan kritria barang.
            if($this->update_karyawan($karyawan)){
                if($this->update_score($skor, $addQuery)){
                    // update setting
                    $set = Setting::all()->count();
                    if($set == 0){
                        Setting::insert([
                            'last_update_score' => date('Y-m-d H:i:s'),
                            'last_update_member' => date('Y-m-d H:i:s')
                        ]);
                    }else{
                        $setting = Setting::find(1);
                        $setting->last_update_score = date('Y-m-d H:i:s');
                        $setting->save();
                    }

                    if($this->record_score($addQuery)){
                        $this->kriteria($kriteria);
                        return redirect('/backend/scoreboard')->with('status', 'success-score');
                    }
                }
            }
            
            return redirect('/backend/scoreboard')->with('status', 'error-score');
        }
    }

    // function
    public function val($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];
        $this->validate($req, [
            'file' => 'required'
        ], $message);
    }

    function update_karyawan($karyawan){
        // hapus karyawan lama
        Karyawan::truncate();

        // insert karyawan baru
        $data = array();
        foreach($karyawan as $row){
            $data[] = [
                'kd_sales' => $row['kd_sales'],
                'nama' => $row['nama'],
                'alamat' => '-',
                'telp' => '0',
                'divisi' => $row['divisi'],
                'stat' => '1'
            ];

        }

        Karyawan::insert($data);

        return true;
    }

    function update_score($skor, $addQuery){
        $date = str_replace("'", "", $addQuery);
        $date = explode('AND', $date);
        
        // delete
        HistoryJual::whereBetween('tgl', [$date[0], $date[1]])->delete();

        // insert
        $data = array();
        foreach($skor as $row){
            $data[] = [
                'kd_sales' => $row['kd_sales'],
                'tgl' => $row['tgl'],
                'divisi' => $row['divisi'],
                'kd_barang' => $row['kd_barang'],
                'jml' => $row['jml'],
                'skor' => $row['skor'],
                'brt' => $row['brt']
            ];
        }

        HistoryJual::insert($data);

        return true;
    }

    function record_score($addQuery){
        $date = str_replace("'", "", $addQuery);
        $date = explode('AND', $date);
        
        $sql = HistoryJual::select('tgl', 'kd_sales', 'divisi', DB::raw("SUM(skor) as total_skor"))->whereBetween('tgl', [$date[0], $date[1]])->groupBy('divisi', 'kd_sales', 'tgl');

        if($sql->count() > 0){
            RecordScore::whereBetween('tgl', [$date[0], $date[1]])->delete();
        }

        // insert
        $data = array();
        foreach($sql->get() as $row){
            $data[] = [
                'tgl' => $row['tgl'],
                'kd_sales' => $row['kd_sales'],
                'divisi' => $row['divisi'],
                'skor' => $row['total_skor']
            ];
        }

        RecordScore::insert($data);

        return true;
    }

    function kriteria($kriteria){
        // hapus kriteria lama
        Kriteria::truncate();

        // insert kriteria baru
        $data = array();
        foreach($kriteria as $row){
            $data[] = [
                'rule_name' => $row['rule_name'],
                'kd_barang' => $row['kd_barang'],
                'kd_merk' => $row['kd_merk'],
                'kd_golongan' => $row['kd_golongan'],
                'kd_satuan' => $row['kd_satuan'],
                'kd_jenis' => $row['kd_jenis'],
                'skor' => $row['skor'],
                'stat' => $row['stat']
            ];

        }

        Kriteria::insert($data);

        return true;
    }

    // show data
    public function scoreboard(Request $req){
        $menu = 3;
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

        return view((empty(auth()->user())) ? 'frontend.score' : 'admin.score.index', compact('divisi', 'setting', 'score', 'diff', 'score_jual', 'no', 'menu'));
    }

    public function scoreboarddetail(Request $req){
        // variable
        $menu = 3;
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
