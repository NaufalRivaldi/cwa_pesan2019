<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $fillable = [
        'rule_name', 'kd_barang', 'jd_merk', 'kd_golongan', 'kd_satuan', 'kd_jenis', 'skor', 'stat'
    ];
}
