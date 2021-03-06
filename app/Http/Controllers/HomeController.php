<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pengumuman;
use App\User;
use App\AttachPengumuman;
use App\Setting;
use App\HistoryJual;
use App\Karyawan;
use App\Ultah;

use DateTime;
use DB;
use Session;

// helper
use App\Helpers\helper;

class HomeController extends Controller
{
    public function index(){
        $date_now = date('Y-m-d H:i:s');
        $pengumuman = Pengumuman::orderBy('tgl', 'desc')->where('tgl_akhir', '>=', $date_now)->where('stat', '1')->paginate(10);
        return view('frontend.index', compact('pengumuman', 'date_now'));
    }

    public function detail($id){
        $pengumuman = Pengumuman::find($id);
        $file = AttachPengumuman::where('pengumuman_id', $id)->get();
        return view('frontend.detail', compact('pengumuman', 'file'));
    }
    
    public function inbox(){
        $menu = 1;
        return view('admin.inbox', compact('menu'));
    }

    // backend
    public function backend(){
        return view('backend.login');
    }
}
