<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\UpdateMaster;
use File;
use DateTime;

class UpdateMasterController extends Controller
{
    public function index(){
        $menu = 6;
        $dep = auth()->user()->dep;
        $file = UpdateMaster::all();
        foreach($file as $r){
            $data['file_name'] = $r->file_name;
            $data['tgl'] = $r->tgl;
            $tgl = $r->tgl;
        }
        
        // selesih hari
        $date_now = date('Y-m-d H:i:s');
        $date1 = new DateTime($tgl);
        $date2 = new DateTime($date_now);
        $diff = $date1->diff($date2);

        return view('admin.master.index', compact('dep', 'data', 'diff', 'menu'));
    }

    public function save(Request $req){
        $this->val($req);
        $cek = UpdateMaster::all();

        // cek file
        if(!empty($cek)){
            foreach ($cek as $r) {
                File::delete('file-master'.$r->file_name);
                $r->delete();
            }
        }

        if($req->hasfile('file')){
            $file = $req->file;
            $ext = $file->getClientOriginalExtension();
            $name = date('d-m-Y').'-data-master.'.$ext;
            $file->move(public_path().'/file-master/', $name);
            
            // save to database
            UpdateMaster::insert([
                'file_name' => $name,
                'tgl' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect('/admin/master')->with('status', 'simpan-success');
    }

    // function
    public function val($req){
        $message = [
            'mimes' => ':attribute harus bertipe .rar',
            'required' => ':attribute tidak boleh kosong!'
        ];

        $this->validate($req, [
            'file' => 'required|mimes:rar'
        ], $message);
    }
}
