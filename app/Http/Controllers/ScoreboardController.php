<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;

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

            print_r($addQuery);
            die();
        }
    }

    public function val($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];
        $this->validate($req, [
            'file' => 'required'
        ], $message);
    }
}
