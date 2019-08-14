<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman;

class PengumumanController extends Controller
{
    public function index(){
        $no = 1;
        $pengumuman = Pengumuman::where('users_id', auth()->user()->id)->orderBy('tgl', 'desc')->get();
        return view('admin.pengumuman.index', compact('no', 'pengumuman'));
    }

    public function form(){
        return view('admin.pengumuman.form');
    }

    public function detail($id){
        $pengumuman = Pengumuman::find($id);
        return view('admin.pengumuman.detail', compact('pengumuman'));
    }

    public function edit($id){
        $pengumuman = Pengumuman::find($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
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

    public function update(Request $req){
        $this->val($req);

        $pengumuman = Pengumuman::find($req->id);
        $pengumuman->subject = $req->subject;
        $pengumuman->pesan = $req->pesan;
        $pengumuman->save();

        return redirect('/admin/pengumuman');
    }

    public function active($id){
        $pengumuman = Pengumuman::find($id);
        $pengumuman->stat = 1;
        $pengumuman->save();

        return redirect('/admin/pengumuman');
    }

    public function nonactive($id){
        $pengumuman = Pengumuman::find($id);
        $pengumuman->stat = 2;
        $pengumuman->save();

        return redirect('/admin/pengumuman');
    }

    public function delete($id){
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();

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
