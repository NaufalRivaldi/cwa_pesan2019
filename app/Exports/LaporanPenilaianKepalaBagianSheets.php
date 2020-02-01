<?php

namespace App\Exports;

use App\DetailPenilaian;
use App\Helpers\helper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;

class LaporanPenilaianKepalaBagianSheets implements FromQuery, WithTitle
{
    private $kbag;
    private $periodeId;

    public function __construct(int $kbag, int $periodeId)
    {
        $this->kbag = $kbag;
        $this->periodeId  = $periodeId;
    }

    /**
     * @return Builder
     */
    public function query()
    {

        dd($this->kbag);
        // return Invoice
        //     ::query()
        //     ->whereYear('created_at', $this->year)
        //     ->whereMonth('created_at', $this->month);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Month ' . $this->month;
    }
}
