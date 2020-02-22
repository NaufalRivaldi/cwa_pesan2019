<?php

namespace App\Http\Controllers\Forms\Cuti;

use App\Http\Requests\KategoriCutiRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Forms\formcuti\KategoriCuti;

class KategoriCutiController extends Controller
{    
    public function index()
    {
        $data['menu'] = '13';
        $data['no'] = 1;
        $data['kategoriCuti'] = KategoriCuti::all();
        return view('admin.form.hrd.formcuti.kategori.index', $data);
    }

    public function form($id=null)
    {
        $data['menu'] = 13;
        if (!empty($id)) {
            $data['kategoriCuti'] = KategoriCuti::find($id);
        }else{            
            $data['kategoriCuti'] = (object)[
                'id' => '',
                'kategori' => '',
                'jumlahCuti' => ''
            ];
        }
        return view('admin.form.hrd.formcuti.kategori.form', $data);
    }

    public function add(KategoriCutiRequest $req)
    {
        KategoriCuti::create([
            'kategori' => $req->kategori,
            'jumlahCuti' => $req->jumlahCuti
        ]);

        return redirect()->route('form.hrd.cuti.kategori')->with('success', 'Data berhasil ditambah!');
    }

    public function update(KategoriCutiRequest $req)
    {
        $data = KategoriCuti::find($req->id);
        $data->kategori=$req->kategori;
        $data->jumlahCuti=$req->jumlahCuti;
        $data->save();

        return redirect()->route('form.hrd.cuti.kategori')->with('success', 'Data berhasil diubah!');
    }

    public function delete(Request $req)
    {
        $data = KategoriCuti::find($req->id);
        $data->delete();
    }
}
