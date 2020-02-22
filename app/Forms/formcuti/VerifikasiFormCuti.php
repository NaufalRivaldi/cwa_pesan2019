<?php

namespace App\Forms\formcuti;

use Illuminate\Database\Eloquent\Model;

class VerifikasiFormCuti extends Model
{
    protected $table = 'verifikasi_cuti';
    protected $fillable = [
        'detailCutiId',
        'userId',
        'karyawanAllId',
        'status',
        'keterangan'
    ];

    public function detail_cuti()
    {
        return $this->belongsTo('App\Forms\formcuti\DetailFormCuti', 'detailCutiId');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function karyawan()
    {
        return $this->belongsTo('App\KaryawanAll', 'karyawanAllId');
    }
}
