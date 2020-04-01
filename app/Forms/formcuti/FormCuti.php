<?php

namespace App\Forms\formcuti;

use Illuminate\Database\Eloquent\Model;

class FormCuti extends Model
{
    protected $table = 'form_cuti';
    protected $fillable = [
        'karyawanId',
        'userId',
        'status'
    ];

    public function karyawan()
    {
        return $this->belongsTo('App\KaryawanAll', 'karyawanId');
    }

    public function user()
    {
        return $this->belongsTo('App\User','userId');
    }

    public function detailCuti()
    {
        return $this->hasMany('App\Forms\formcuti\DetailFormCuti', 'idFormCuti');
    }
}
