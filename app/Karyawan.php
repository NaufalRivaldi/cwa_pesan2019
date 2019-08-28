<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $fillable = [
        'kd_sales', 'nama', 'alamat', 'telp', 'divisi', 'stat'
    ];
}
