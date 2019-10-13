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

        $pesan = Pesan::where('user_id', auth()->user()->id)->orderBy('tgl', 'desc')->get();

        return view('admin.pesan.outbox.index', compact('menu', 'pesan', 'idx'));
    }

    public function detail($pesan_id){
        $menu = '1';
        $pesan = Pesan::where('id', $pesan_id)->first();

        return view('admin.pesan.outbox.detail', compact('menu', 'pesan'));
    }
}
