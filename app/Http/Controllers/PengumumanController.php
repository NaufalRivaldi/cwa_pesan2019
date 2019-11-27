<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\helper;

use App\Pengumuman;
use App\AttachPengumuman;
use App\KaryawanAll;
use File;

class PengumumanController extends Controller
{
    public function index(){
        $menu = 2;
        $no = 1;
        $pengumuman = Pengumuman::where('user_id', auth()->user()->id)->orderBy('tgl', 'desc')->get();

        return view('admin.pengumuman.index', compact('no', 'pengumuman', 'menu'));
    }

    public function form(){
        $menu = 2;
        $date_now = date('Y-m-d');
        return view('admin.pengumuman.form', compact('menu', 'date_now'));
    }

    public function detail($id){
        $menu = 2;
        $pengumuman = Pengumuman::find($id);
        $file = AttachPengumuman::where('pengumuman_id', $id)->get();
        return view('admin.pengumuman.detail', compact('pengumuman', 'file', 'menu'));
    }

    public function edit($id){
        $menu = 2;
        $date_now = date('Y-m-d');
        $file = AttachPengumuman::where('pengumuman_id', $id)->get();
        $pengumuman = Pengumuman::find($id);
        return view('admin.pengumuman.edit', compact('pengumuman', 'file', 'menu', 'date_now'));
    }

    public function store(Request $req){
        $this->val($req);

        Pengumuman::create([
            'subject' => $req->subject,
            'tgl' => date('Y-m-d H:i:s'),
            'pesan' => $req->pesan,
            'tgl_akhir' => $req->tgl_akhir,
            'stat' => 3,
            'user_id' => auth()->user()->id
        ]);

        // get id
        $pengumuman = Pengumuman::latest()->first();
        $id = $pengumuman->id;


        // Upload File
        $this->upload($id, $req);

        return redirect('/admin/pengumuman')->with('success', 'Pengumuman berhasil dibuat, aktifkan pengumuman untuk dibagikan.');
    }

    public function update(Request $req){
        $this->val($req);

        $pengumuman = Pengumuman::find($req->id);
        $pengumuman->subject = $req->subject;
        $pengumuman->pesan = $req->pesan;
        $pengumuman->tgl_akhir = $req->tgl_akhir;
        $pengumuman->save();

        // uplaod file
        $this->upload($req->id, $req);

        return redirect('/admin/pengumuman');
    }

    public function active(Request $req){
        $nik = $req->nik;
        $password = sha1($req->password);
        $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', auth()->user()->dep)->where('stat', '>=', '2')->first();
        
        if(isset($karyawan)){
            $pengumuman = Pengumuman::find($req->pengumuman_id);
            $pengumuman->stat = 1;
            $pengumuman->save();

            return redirect('/admin/pengumuman')->with('success', 'Pengumuman berhasil di aktifkan');
        }else{
            return redirect('/admin/pengumuman')->with('error', 'Validasi tidak valid!');
        }
    }

    public function nonactive(Request $req){
        $nik = $req->nik;
        $password = sha1($req->password);
        $karyawan = KaryawanAll::where('nik', $nik)->where('password', $password)->where('dep', auth()->user()->dep)->where('stat', '>=', '2')->first();
        
        if(isset($karyawan)){
            $pengumuman = Pengumuman::find($req->pengumuman_id);
            $pengumuman->stat = 2;
            $pengumuman->save();

            return redirect('/admin/pengumuman')->with('success', 'Pengumuman berhasil di nonaktifkan');
        }else{
            return redirect('/admin/pengumuman')->with('error', 'Validasi tidak valid!');
        }
    }

    public function delete($id){
        // delete file
        $file = AttachPengumuman::where('pengumuman_id', $id)->get();
        foreach($file as $f){
            $attc = AttachPengumuman::find($f->id);
            // delete file
            File::delete('Upengumuman/'.$attc->nama_file);
            $attc->delete();
        }
        
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();

        return redirect('/admin/pengumuman');
    }

    public function delattc($id){
        $attc = AttachPengumuman::find($id);

        // delete file
        File::delete('Upengumuman/'.$attc->nama_file);
        
        $attc->delete();

        return back();
    }

    
    // Function tambahan
    public function val($req){
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];

        $this->validate($req, [
            'subject' => 'required',
            'pesan' => 'required',
            'tgl_akhir' => 'required|date',
        ], $message);
    }

    public function upload($id, $req){
        if($req->hasfile('file')){
            foreach($req->file('file') as $file){
                $ext = $file->getClientOriginalExtension();
                $name = Str::random(32).'.'.$ext;
                $file->move(public_path().'/Upengumuman/', $name);
                
                // save to database
                AttachPengumuman::create([
                    'nama' => $file->getClientOriginalName(),
                    'nama_file' => $name,
                    'pengumuman_id' => $id
                ]);
            }
        }
    }
}
