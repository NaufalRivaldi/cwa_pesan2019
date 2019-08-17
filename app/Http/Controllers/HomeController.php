<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pengumuman;
use App\AttachPengumuman;

class HomeController extends Controller
{
    public function index(){
        $date_now = date('Y-m-d H:i:s');
        $pengumuman = Pengumuman::orderBy('tgl', 'desc')->paginate(10);
        return view('frontend.index', compact('pengumuman', 'date_now'));
    }

    public function detail($id){
        $pengumuman = Pengumuman::find($id);
        $file = AttachPengumuman::where('pengumuman_id', $id)->get();
        return view('frontend.detail', compact('pengumuman', 'file'));
    }

    public function scoreboard(){
        $divisi = array(
            'CW1' => 'CW 1',
            'CW2' => 'CW 2',
            'CW3' => 'CW 3',
            'CW4' => 'CW 4',
            'CW5' => 'CW 5',
            'CW6' => 'CW 6',
            'CW7' => 'CW 7',
            'CW8' => 'CW 8',
            'CW9' => 'CW 9',
            'CA0' => 'CW 10',
            'CA1' => 'CW 11',
            'CA2' => 'CW 12',
            'CA3' => 'CW 13',
            'CA4' => 'CW 14',
            'CA5' => 'CW 15',
            'CA6' => 'CW 16',
            'CA7' => 'CW 17',
            'CA8' => 'CW 18',
            'CA9' => 'CW 19',
            'CL1' => 'CW Lombok'
        );

        return view('frontend.score', compact('divisi'));
    }

    public function login(){
        return view('frontend.login');
    }

    public function inbox(){
        return view('admin.inbox');
    }
}
