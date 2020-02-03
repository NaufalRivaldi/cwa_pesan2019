<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sarana;

class SaranaController extends Controller
{
    public function index(){
        $data['menu'] = 9;
        $data['no'] = 1;
        
        $data['sarana'] = Sarana::orderBy('namaSarana', 'asc')->get();

        return view('admin.laporan.ga.sarana.index', $data);
    }
}
