<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\helper;

use App\User;
use App\Attachment;
use App\Pesan;
use App\Penerima;

use DB;

class PesanController extends Controller
{
    public function inbox(){
        $menu = 1;
        $idx = 1;
        $id = Penerima::select('pesan_id')->where('user_id', auth()->user()->id)->where('stat', '1')->get()->toArray();
        $pesan = Pesan::whereIn('id', $id)->orderBy('tgl', 'desc')->get();
        return view('admin.pesan.inbox', compact('menu', 'pesan', 'idx'));
    }

    public function form(){
        $menu = 1;
        $user = User::select('id', 'email')->orderBy('email', 'asc')->get();
        return view('admin.pesan.form', compact('menu', 'user'));
    }

    public function store(Request $req){
        $this->val($req);

        // insert pesan
        Pesan::create([
            'subject' => $req->subject,
            'message' => $req->message,
            'tgl' => date('Y-m-d H:i:s'),
            'stat' => 1,
            'user_id' => auth()->user()->id
        ]);
        
        // upload attachment
        $id = Pesan::select('id')->latest('id')->first();
        $this->upload($id->id, $req);

        // set penerima
        $this->penerima($id->id, $req);
        
        return redirect('/admin/pesan/inbox')->with('status', 'success-pesan');
    }

    public function detail($pesan_id){
        $menu = '1';
        $pesan = Pesan::where('id', $pesan_id)->first();

        // ubah status read
        $read = Penerima::where('pesan_id', $pesan_id)->where('user_id', auth()->user()->id)->first();
        $read->read_user = 'y';
        $read->save();
        return view('admin.pesan.detail', compact('menu', 'pesan'));
    }

    public function hapus($pesan_id){
        $pesan = Penerima::find($pesan_id);
        $pesan->stat = 2;
        $pesan->save();
        return redirect('/admin/pesan/inbox')->with('status', 'delete-pesan');
    }

    public function balas($pesan_id){
        $menu = '1';
        $pesan = Pesan::find($pesan_id);

        return view('admin.pesan.balas', compact('menu', 'pesan'));
    }

    public function forward($pesan_id){
        $menu = 1;
        $user = User::select('id', 'email')->orderBy('email', 'asc')->get();
        $pesan = Pesan::find($pesan_id);
        $penerima = Penerima::where('pesan_id', $pesan_id)->get();
        $untuk = "";
        foreach($penerima as $row){
            $untuk = $untuk.$row->user->email.",";
        }

        $text = "
            <p style='color: grey !important'>--- Forwarded Message ---<br>
            Dari : ".$pesan->user->email."<br>
            Tanggal : ".$pesan->tgl."<br>
            Subject : ".$pesan->subject."<br>
            Untuk : ".substr($untuk, 0, -1)."<br><br>
            ".helper::setText($pesan->message)."</p>

        ";
        return view('admin.pesan.forward', compact('menu', 'user', 'pesan', 'text'));
    }

    // fungsi tambahan
    public function val($req){
        $massage = [
            'required' => ':attribute tidak boleh kosong!'
        ];

        $this->validate($req,[
            'kepada' => 'required',
            'subject' => 'required'
        ], $massage);
    }

    public function upload($id, $req){
        if($req->hasfile('file')){
            foreach ($req->file('file') as $file) {
                $ext = $file->getClientOriginalExtension();
                $name = Str::random(32).'.'.$ext;
                $file->move(public_path().'/Upesan/', $name);

                // save to database
                Attachment::create([
                    'nama' => $file->getClientOriginalName(),
                    'nama_file' => $name,
                    'pesan_id' => $id
                ]);
            }
        }
    }

    public function penerima($id, $req){
        foreach($req->kepada as $r){
            Penerima::create([
                'pesan_id' => $id,
                'user_id' => $r,
                'stat' => 1,
                'read_user' => 'n'
            ]);
        }
    }
}
