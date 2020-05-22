<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prosedur;
use App\Departemen;

class ProsedurController extends Controller
{
    public function index()
    {
        $data['menu'] = '13';
        $data['no'] = '1';

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
        }
        Prosedur::create([
            'nama'=>$request->nama,
        ]);
    }
}
