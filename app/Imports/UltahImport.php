<?php

namespace App\Imports;

use App\Ultah;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class UltahImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ultah([
            "nama" => $row[0],
            "tgl" => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])),
            "divisi" => $row[2]
        ]);
    }
}
