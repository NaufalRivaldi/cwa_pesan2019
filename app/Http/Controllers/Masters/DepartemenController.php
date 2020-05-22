<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Requests\Master\Departemen\DepartemenRequest;
use App\Http\Controllers\Controller;
use App\Departemen;

class DepartemenController extends Controller
{
    public function index()
    {
        $data['menu'] = '13';
        $data['no'] = '1';
        $data['departemen'] = Departemen::orderBy('nama', 'asc')->get();
        return view('admin.master.departemen.index', $data);
    }

    public function form($id = null)
    {
        $data['menu'] = '13';
        if (empty($id)) {            
            $data['departemen'] = (object)[
                'id'=>'',
                'nama'=>''
            ];
        } else {
            $data['departemen'] = Departemen::find($id);
        }
        return view('admin.master.departemen.form', $data);
    }

    public function store(DepartemenRequest $request)
    {
        Departemen::create([
            'nama'=>$request->nama
        ]);

        return redirect()->route('master.departemen.index')->with('success', 'Data berhasil ditambahkan!');
    }
    
    public function update(DepartemenRequest $request)
    {
        $data = Departemen::find($request->id);
        $data->nama = $request->nama;
        $data->save();

        return redirect()->route('master.departemen.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Request $request)
    {
        $data = Departemen::find($request->id);
        $data->delete();
    }
}
