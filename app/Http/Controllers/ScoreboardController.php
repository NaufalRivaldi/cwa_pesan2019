<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use DB;

use App\Karyawan;
use App\HistoryJual;
use App\RecordScore;

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

            // cek extension
            if($ext != 'cwa'){
                return redirect('/backend/scoreboard')->with('status', 'fail-score');
            }

            // upload
            $file->move(public_path().'/file-score/', $name);

            // getjson
            $text = file_get_contents(public_path().'/file-score/'.$name);
            $array = json_decode($text, true);

            $tgl = $array['tgl'];
            $karyawan = $array['karyawan'];
            $skor = $array['skor'];
            $addQuery = $array['query'];
            $kriteria = $array['kriteria'];

            // print_r($skor);
            // logica
            if($this->update_karyawan($karyawan)){
                // if($this->update_score($skor, $addQuery)){
                    if($this->record_score($addQuery)){
                        
                    }
                // }
            }
            die();
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
}
