<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;

class PengumumanController extends Controller
{
    public function index(){
        $pengumuman = Pengumuman::orderBy('tgl', 'desc')->get();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function form(){
        return view('admin.pengumuman.form');
    }

    public function store(Request $req){
        $this->val($req);

        Pengumuman::create([
            'subject' => $req->subject,
            'tgl' => date('Y-m-d H:i:s'),
            'pesan' => $req->pesan,
            'stat' => 1,
            'users_id' => auth()->user()->id
        ]);

        return redirect('/admin/pengumuman');
    }

    
    // Function tambahan
    public function val($req){
        $this->validate($req, [
            'subject' => 'required',
            'pesan' => 'required'
        ]);
    }
}
