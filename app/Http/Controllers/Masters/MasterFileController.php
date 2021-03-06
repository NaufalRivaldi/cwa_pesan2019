<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\MasterFile\MasterFileRequest;
use App\Forms\formqa\MasterFile;

class MasterFileController extends Controller
{
    public function index()
    {
        $data['menu'] = '13';
        $data['masterfile'] = MasterFile::all();
        return view('admin.master.penambahanfile.index', $data);
    }

    public function form()
    {
        $data['menu'] = '13';
        $data['masterfile'] = (object)[
            'id'=>'',
            'nama'=>'',
            'kategori'=>'',
            'no_form'=>'',
            'no_revisi'=>'',
            'tgl_terbit'=>''
        ];

        return view('admin.master.penambahanfile.form', $data);
    }

    public function store(MasterFileRequest $request)
    {
        MasterFile::create([
            'nama'=>$request->nama,
            'kategori'=>$request->kategori,
            'no_form'=>$request->no_form,
            'no_revisi'=>$request->no_revisi,
            'tgl_terbit'=>$request->tgl_terbit
        ]);

        return redirect()->route('master.masterfile.index')->with('success', 'Data berhasil ditambah!');
    }

    public function edit($id)
    {
        $data['menu'] = '13';
        $data['masterfile'] = MasterFile::find($id);
        return view('admin.master.penambahanfile.form', $data);
    }

    public function update(MasterFileRequest $request)
    {
        $data = MasterFile::find($request->id);
        $data->nama=$request->nama;
        $data->kategori=$request->kategori;
        $data->no_form=$request->no_form;
        $data->no_revisi=$request->no_revisi;
        $data->tgl_terbit=$request->tgl_terbit;
        $data->save();

        return redirect()->route('master.masterfile.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Request $request)
    {
        $data = MasterFile::find($request->id);
        // dd($data);
        $data->delete();
    }
}
