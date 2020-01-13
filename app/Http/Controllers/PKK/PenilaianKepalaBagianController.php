<?php

namespace App\Http\Controllers\PKK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenilaianKepalaBagianController extends Controller
{
    public function index(){
        $data['menu'] = '12';

        return view('admin.pkk.penilaian.kabag.form', $data);
    }
}
