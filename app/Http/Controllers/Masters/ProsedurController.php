<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Requests\Master\Prosedur\ProsedurRequest;
use App\Http\Controllers\Controller;
use App\Prosedur;
use App\Departemen;

class ProsedurController extends Controller
{
    public function index()
    {
        $data['menu'] = '13';
        $data['no'] = '1';
        $data['prosedur'] = Prosedur::orderBy('id', 'desc')->get();
        return view('admin.master.prosedur.index', $data);
    }

    public function form($id = null)
    {
        $data['menu'] = '13';
        $data['departemen'] = Departemen::orderBy('nama', 'asc')->get();
        if (empty($id)) {
            $data['prosedur'] = (object)[
                'id'=>'',
                'nama'=>'',
                'file'=>'',
                'departemenId'=>''
            ];
        } else {
            $data['prosedur'] = Prosedur::find($id);
        }
        return view('admin.master.prosedur.form', $data);
    }

    public function store(ProsedurRequest $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $ext = $file->getClientOriginalExtension();
            $name = str_random(32).'.'.$ext;
            $file->move(public_path().'/file-prosedur/', $name);
        }
        Prosedur::create([
            'nama'=>$request->nama,
            'departemenId'=>$request->departemenId,
            'file'=>$name
        ]);

        return redirect()->route('master.prosedur.index')->with('success', 'Data berhasil ditambah!');
    }

    public function update(ProsedurRequest $request)
    {
        // dd($request->hasFile('file'));
        if ($request->hasFile('file')) {            
            $file = $request->file;
            $fileOld = $request->fileOld;
            $ext = $file->getClientOriginalExtension();
            $name = str_random(32).'.'.$ext;
            $file->move(public_path().'/file-prosedur/', $name);
            $url = public_path().'/file-prosedur/'.$fileOld;
            unlink($url);
        } else {
            $name = $request->fileOld;
        }

        $data = Prosedur::find($request->id);
        $data->nama = $request->nama;
        $data->departemenId = $request->departemenId;
        $data->file = $name;
        $data->save();

        return redirect()->route('master.prosedur.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Request $request)
    {
        $data = Prosedur::find($request->id);
        unlink(public_path().'./file-prosedur/'.$data->file);
        $data->delete();
    }

    public function view($id)
    {
        $data['menu'] = '13';
        $data['prosedur'] = Prosedur::find($id);

        return view('admin.master.prosedur.view', $data);
    }
}
