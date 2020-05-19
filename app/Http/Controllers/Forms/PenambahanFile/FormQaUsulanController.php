<?php

namespace App\Http\Controllers\Forms\PenambahanFile;

use Illuminate\Http\Request;
use App\Http\Requests\Form\QA\FormQaUsulanRequest;
use App\Http\Controllers\Controller;
use App\Forms\formqa\FormQaUsulan;
use App\Forms\formqa\DetailFormQaUsulan;
use App\Forms\formqa\MasterFile;
use App\KaryawanAll;
use App\Helpers\helper;

class FormQaUsulanController extends Controller
{
    public function index()
    {
        $data['menu'] = '8';
        $data['formProgress'] = FormQaUsulan::where('status', '<=', 2)->orderBy('id', 'desc')->get();
        $data['formSelesai'] = FormQaUsulan::where('status', '>=', 3)->orderBy('id', 'desc')->get();
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
            $text .= '<option value="'.$p->id.'">'.$p->no_form.' - '.$p->nama.'</option>';
        }
        return $text;
    }

    public function store(FormQaUsulanRequest $request)
    {
        FormQaUsulan::create([
            'kode'=>$request->kode,
            'karyawanId'=>$request->karyawanId,
            'kategori'=>$request->kategori,
            'keterangan'=>$request->keterangan,
            'status'=>1
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
            'id'=>$data->id,
            'kode'=>$data->kode,
            'kategori'=>Helper::kategoriFormQa($data->kategori),
            'keterangan'=>$data->keterangan,
            'karyawanId'=>$data->karyawan->nama,
            'dep'=>$data->karyawan->dep,
            'status'=>Helper::statusFormQa($data->status),
            'status1'=>$data->status,
            'tanggal'=>Helper::setDate($data->created_at)
        ];

        return $array;
    }

    public function table()
    {
        $id = $_GET['id'];
        $data['no'] = 1;
        $data['formQa'] = FormQaUsulan::find($id);
        $data['detailFormQa'] = DetailFormQaUsulan::where('formId', $id)->get();

        return view('admin.form.qa.penambahanfile.table', $data);
    }

    public function acc(Request $req)
    {
        // dd($req->id);
        $data = FormQaUsulan::find($req->id);
        $data->status = 2;
        $data->save();
    }

    public function tolak(Request $req)
    {
        // dd($req->id);
        $data = FormQaUsulan::find($req->id);
        $data->status = 4;
        $data->save();
    }

    public function selesai($id)
    {
        $data = FormQaUsulan::find($id);
        $data->status = 3;
        $data->save();

        return redirect()->route('form.qa.penambahanfile.index')->with('success', 'Form telah selesai.');
    }
}
