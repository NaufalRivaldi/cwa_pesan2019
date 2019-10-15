<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FormHRD;
use App\KaryawanAll;

class FormHRDController extends Controller
{
    public function index(){
        $menu = 8;
        return view('admin.form.hrd.index', compact('menu'));
    }

    public function form(){
        $menu = 8;
        $karyawan = KaryawanAll::where('dep', auth()->user()->dep)->get();

        return view('admin.form.hrd.form', compact('menu', 'karyawan'));
    }
}
