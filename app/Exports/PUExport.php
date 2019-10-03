<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use App\Cabang;

class PUExport implements FromView
{
    use Exportable;
    public function view(): View{
        $cabang = Cabang::all();
        return view('admin.pu.expall', compact('cabang'));
    }
}
