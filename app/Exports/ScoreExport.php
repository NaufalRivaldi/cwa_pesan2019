<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use App\Cabang;

class ScoreExport implements FromView
{
    use Exportable;
    public function view(): View{
        $data['cabang'] = Cabang::all();
        return view('admin.score.export', $data);
    }
}
