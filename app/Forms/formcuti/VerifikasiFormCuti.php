<?php

namespace App\Forms\formcuti;

use Illuminate\Database\Eloquent\Model;

class VerifikasiFormCuti extends Model
{
    protected $table = 'verifikasi_cuti';
    protected $fillable = [
        'idFormCuti',
        'userId',
        'karyawanId',
        'status',
        'keterangan'
    ];

    public function formCuti()
    {
        return $this->belongsTo('App\Forms\formcuti\FormCuti', 'idFormCuti');
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
