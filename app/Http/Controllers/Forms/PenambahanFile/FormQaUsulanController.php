<?php

namespace App\Http\Controllers\Forms\PenambahanFile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\formqa\FormQaUsulan;
use App\Forms\formqa\MasterFile;
use App\KaryawanAll;

class FormQaUsulanController extends Controller
{
    public function index()
    {
        $data['menu'] = '8';
        return view('admin.form.qa.penambahanfile.index', $data);
    }

    public function form()
    {
        $data['menu'] = '8';
        $data['kodeForm'] = $this->kodeForm();
        $data['pembuat'] = KaryawanAll::where('dep', auth()->user()->dep)->get();
        return view('admin.form.qa.penambahanfile.form', $data);
    }

    public function kodeForm()
    {
        $y = date('y');
        $m = date('m');
        $kode = 'FQA';
        $form = FormQaUsulan::where('created_at','LIKE','%'.$y."-".$m.'%')->orderBy('id', 'desc')->first();
        if(empty($form)){
            $kode .= $y.$m.'001';
        } else {
            $row = explode($y.$m, $form->kode);
            $kode .= $y.$m.$row[1]+1;
        }
        return $kode;
    }

    public function formDoc()
    {
        $kategori = $_GET['id'];
        $form = MasterFile::where('kategori', $kategori)->where('dep', auth()->user()->dep)->get();
        $text = '';
        foreach ($form as $p) {
            $text .= '<option value="'.$p->id.'">'.$p->nama.'</option>';
        }
        return $text;
    }
}
