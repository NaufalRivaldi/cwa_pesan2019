<?php

namespace App\Imports;

use App\KaryawanAll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Carbon\Carbon;

HeadingRowFormatter::default('none');

class MasaKerjaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KaryawanAll([
            "id"=>$row['id'],
            "nama"=>$row['nama'],
            "masakerja"=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['masaKerja']))
        ]);
    }
}
