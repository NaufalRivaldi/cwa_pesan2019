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
        if (auth()->user()->dep == 'QA') {            
            $data['formProgress'] = FormQaUsulan::where('status', '<=', 2)->orderBy('id', 'desc')->get();
            $data['formSelesai'] = FormQaUsulan::where('status', '>=', 3)->orderBy('id', 'desc')->get();
        } else {
                       
            $data['formProgress'] = FormQaUsulan::where('status', '<=', 2)->whereHas('karyawan', function($query){
                $query->where('dep', auth()->user()->dep);
            })->orderBy('id', 'desc')->get();
            $data['formSelesai'] = FormQaUsulan::where('status', '>=', 3)->whereHas('karyawan', function($query){
                $query->where('dep', auth()->user()->dep);
            })->orderBy('id', 'desc')->get();
        }
        return view('admin.form.qa.penambahanfile.index', $data);
    }

    public function form()
    {
        $data['menu'] = '8';
        $data['kodeForm'] = $this->kodeForm();
        $data['pembuat'] = KaryawanAll::where('dep', auth()->user()->dep)->where('ket', 1)->get();
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
        $form = MasterFile::where('kategori', $kategori)->get();
        $text = '';
        foreach ($form as $p) {
            $text .= '<option value="'.$p->id.'">'.$p->no_form.' - '.$p->nama.'</option>';
        }
        return $text;
    }

    public function store(FormQaUsulanRequest $request)
    {
        // dd($request->all());
        if(empty($request->keterangan)) {
            $keterangan = '-';
        } else {
            $keterangan = $request->keterangan;
        } 
        FormQaUsulan::create([
            'kode'=>$request->kode,
            'karyawanId'=>$request->karyawanId,
            'kategori'=>$request->kategori,
            'keterangan'=>$keterangan,
            'status'=>1,
            'pic'=>null
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
        if ($data->pic == null) {
            $pic = null;
        }else{
            $pic = $data->pic->nama;
        }
        $array = [
            'id'=>$data->id,
            'kode'=>$data->kode,
            'kategori'=>Helper::kategoriFormQa($data->kategori),
            'keterangan'=>$data->keterangan,
            'karyawanId'=>$data->karyawan->nama,
            'dep'=>$data->karyawan->dep,
            'status'=>Helper::statusFormQa($data->status),
            'status1'=>$data->status,
            'tanggal'=>Helper::setDate($data->created_at),
            'pic'=>$pic,
            'user'=>auth()->user()->dep
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

    public function selesai(Request $request)
    {
        // dd($request->all());

        $karyawan = KaryawanAll::where('dep', 'QA')->where('ket', 1)->where('nik', $request->nik)->where('password', sha1($request->password))->first();

        if (!empty($karyawan)) {
            $form = FormQaUsulan::find($request->form_qa_id);
            switch ($request->form_qa_type) {
                case '1':
                    $form->status = 2;
                    $form->picId = $karyawan->id;
                    $form->save();
                    return redirect()->route('form.qa.penambahanfile.index')->with('success', 'Form telah disetujui!');
                    break;
                case '2':
                    $form->status = 4;
                    $form->picId = $karyawan->id;
                    $form->save();
                    return redirect()->route('form.qa.penambahanfile.index')->with('success', 'Form telah ditolak!');
                    break;
                case '3':
                    if ($karyawan->stat == 2) {
                        $form->status = 3;
                        $form->save();
                        return redirect()->route('form.qa.penambahanfile.index')->with('success', 'Form telah diselesaikan!');
                    } else {
                        return redirect()->route('form.qa.penambahanfile.index')->with('error', 'Anda bukan kepala bagian!');
                    }
                    break;
                default:
                    return redirect()->route('form.qa.penambahanfile.index')->with('error', 'Anda bukan kepala bagian!');
                    break;
            }
        } else {
            return redirect()->route('form.qa.penambahanfile.index')->with('error', 'NIK atau Password salah!');
        }       
    }

    public function destroy(Request $request)
    {
        $data = FormQaUsulan::find($request->id);
        $data->delete();
    }
}
