<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pengumuman;
use App\AttachPengumuman;

class DashboardController extends Controller
{
    public function index(){
        $data['menu'] = 0;
        $data['date_now'] = date('Y-m-d H:i:s');
        $date_now = date('Y-m-d');
        $data['pengumuman'] = Pengumuman::where('stat', '1')->where('tgl_akhir', '>=', $date_now)->orderBy('tgl', 'desc')->paginate(10);
        
        return view('admin.dashboard.index', $data);
    }

    public function detailp($id){
        $menu = 0;
        $pengumuman = Pengumuman::find($id);
        $file = AttachPengumuman::where('pengumuman_id', $id)->get();
        return view('admin.dashboard.detailp', compact('pengumuman', 'file', 'menu'));
    }

}
