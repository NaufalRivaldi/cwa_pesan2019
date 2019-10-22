<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;

use App\KodeBarang;

class KodeBarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KodeBarang([
            "mrbr" => $row[0],
            "glbr" => $row[1],
            "kmbr" => $row[2],
            "jnbr" => $row[3],
            "kdbr" => $row[4],
            "nmbr" => $row[5]
        ]);
    }
}
