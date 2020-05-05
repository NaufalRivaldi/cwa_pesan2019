<?php

namespace App\Http\Controllers\Forms\PenambahanFile;

use Illuminate\Http\Request;
use App\Http\Requests\Form\QA\FormQaUsulanRequest;
use App\Http\Controllers\Controller;
use App\Forms\formqa\FormQaUsulan;
use App\Forms\formqa\DetailFormQaUsulan;
use App\Forms\formqa\MasterFile;
use App\KaryawanAll;

class FormQaUsulanController extends Controller
{
    public function index()
    {
        $data['menu'] = '8';
        $data['formProgress'] = FormQaUsulan::where('status', '<=', 2)->orderBy('id', 'desc')->get();
        $data['formSelesai'] = FormQaUsulan::where('status', 3)->orderBy('id', 'desc')->get();
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

    public function store(FormQaUsulanRequest $request)
    {
        FormQaUsulan::create([
            'kode'=>$request->kode,
            'karyawanId'=>$request->karyawanId,
            'kategori'=>$request->kategori,
            'keterangan'=>$request->keterangan
        ]);

        $formQa = FormQaUsulan::orderBy('id', 'desc')->first();
        // dd($formQa);
        for ($i=0; $i < count($request->dokumenId); $i++) { 
            DetailFormQaUsulan::create([
                'formId'=>$formQa->id,
                'fileId'=>$request->dokumenId[$i],
                'qty'=>$request->qty[$i]
            ]);
        }

        return redirect()->route('form.qa.penambahanfile.index')->with('success', 'Form berhasil diajukan!');
    }

    public function view()
    {
        $id = $_GET['id'];
        $data = FormQaUsulan::find($id);
        $array = [
            'kode'=>$data->kode,
            'kategori'=>$data->kategori,
            'keterangan'=>$data->keterangan,
            'karyawanId'=>$data->karyawan->nama,
            'status'=>$data->status,
            'tanggal'=>$data->created_at
        ];

        return $array;
    }
}
