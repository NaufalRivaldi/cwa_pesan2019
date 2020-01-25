<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ScoreAllExport implements FromView
{
    use Exportable;
    public function view(): View{
        return view('admin.score.exportAll');
    }
}
