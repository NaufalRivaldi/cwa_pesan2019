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
}
