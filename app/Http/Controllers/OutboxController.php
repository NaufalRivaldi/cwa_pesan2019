<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\helper;

use App\User;
use App\Attachment;
use App\Pesan;
use App\Penerima;

use DB;

class OutboxController extends Controller
{
    public function index(){
        $menu = 1;
        $idx = 1;

        $pesan = Pesan::where('user_id', auth()->user()->id)->where('stat', '1')->orderBy('tgl', 'desc')->get();

        return view('admin.pesan.outbox.index', compact('menu', 'pesan', 'idx'));
    }

    public function detail($pesan_id){
        $menu = '1';
        $pesan = Pesan::where('id', $pesan_id)->first();

        return view('admin.pesan.outbox.detail', compact('menu', 'pesan'));
    }

    public function hapus($pesan_id){
        $pesan = Pesan::find($pesan_id);
        $pesan->stat = 2;
        $pesan->save();
        return redirect('/admin/pesan/outbox')->with('status', 'delete-pesan');
    }

    public function hapuscek($pesan_id){
        $pesan_id = explode(',', $pesan_id);
        for($i = 0; $i < count($pesan_id); $i++){
            $pesan = Pesan::find($pesan_id[$i]);
            $pesan->stat = 2;
            $pesan->save();
        }

        return redirect('/admin/pesan/outbox')->with('status', 'delete-pesan');
    }
}
