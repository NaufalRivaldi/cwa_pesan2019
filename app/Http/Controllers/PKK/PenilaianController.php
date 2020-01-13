<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\KaryawanAll; 

class PenilaianController extends Controller
{
    public function index()
    {
        $data['menu'] = '12';

        return view('admin.pkk.penilaian.index', $data);
    }

    public function poling(){
        $data['menu'] = '12';
        $data['no'] = 1;
        $data['dep'] = [
            'Accounting',
            'Finance',
            'Gudang',
            'HRD',
            'IT',
            'MT',
            'PAJAK',
            'QA',
            'SCM'
        ];
        return view('admin.pkk.penilaian.poling', $data);
    }
}
