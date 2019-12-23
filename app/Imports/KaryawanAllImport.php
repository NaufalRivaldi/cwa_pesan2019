<?php

namespace App\Imports;

use App\KaryawanAll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class KaryawanAllImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
        $nik = substr($row[0], -9);
        return new KaryawanAll([
            "nik" => $nik,
            "password" => sha1($nik),
            "nama" => $row[1],
            "dep" => $row[2],
            "stat" => 1
        ]);
    }
}
