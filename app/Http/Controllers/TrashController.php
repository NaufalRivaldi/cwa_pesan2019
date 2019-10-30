<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\helper;

use App\User;
use App\Attachment;
use App\Pesan;
use App\Penerima;

use DB;

class TrashController extends Controller
{
    public function index(){
        $menu = 1;
        $idx = 1;

        // outbox
        $outbox = Pesan::where('user_id', auth()->user()->id)->where('stat', '2')->orderBy('tgl', 'desc')->get();
        
        // inbox
        $id = Penerima::select('pesan_id')->where('user_id', auth()->user()->id)->where('stat', '2')->get()->toArray();
        $inbox = Pesan::whereIn('id', $id)->orderBy('tgl', 'desc')->get();

        return view('admin.pesan.trash.index', compact('menu', 'outbox', 'inbox', 'idx'));
    }

    public function detail($pesan_id){
        $menu = '1';
        $pesan = Pesan::where('id', $pesan_id)->first();

        return view('admin.pesan.trash.detail', compact('menu', 'pesan'));
    }

    public function hapusout($pesan_id){
        $pesan_id = explode(',', $pesan_id);
        for($i = 0; $i < count($pesan_id); $i++){
            $pesan = Pesan::find($pesan_id[$i]);
            $pesan->stat = 3;
            $pesan->save();
        }

        return redirect('/admin/pesan/trash')->with('status', 'delete-pesan');
    }

    public function hapusin($pesan_id){
        $pesan_id = explode(',', $pesan_id);
        for($i = 0; $i < count($pesan_id); $i++){
            $pesan = Penerima::where('pesan_id', $pesan_id[$i])->where('user_id', auth()->user()->id)->first();
            $pesan->stat = 3;
            $pesan->save();
        }

        return redirect('/admin/pesan/trash')->with('status', 'delete-pesan');
    }

    public function buInbox($pesan_id){
        $pesan_id = explode(',', $pesan_id);
        for($i = 0; $i < count($pesan_id); $i++){
            $pesan = Penerima::where('pesan_id', $pesan_id[$i])->where('user_id', auth()->user()->id)->first();
            $pesan->stat = 1;
            $pesan->save();
        }

        return redirect('/admin/pesan/trash')->with('status', 'pulih-pesan');
    }

    public function buOutbox($pesan_id){
        $pesan_id = explode(',', $pesan_id);
        for($i = 0; $i < count($pesan_id); $i++){
            $pesan = Pesan::find($pesan_id[$i]);
            $pesan->stat = 1;
            $pesan->save();
        }

        return redirect('/admin/pesan/trash')->with('status', 'pulih-pesan');
    }
}
