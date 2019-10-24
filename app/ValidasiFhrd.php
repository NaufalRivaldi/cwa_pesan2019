<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidasiFhrd extends Model
{
    protected $table = "validasi_fhrd";
    protected $fillable = [
        'form_hrd_id', 'user_id', 'karyawan_all_id', 'stat', 'keterangan'
    ];
}
