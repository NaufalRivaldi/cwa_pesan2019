<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFormPenangananIt extends Model
{
    protected $table = 'detail_form_penanganan_it';
    protected $fillable = [
        'keterangan', 'karyawanId', 'formPenangananItId'
    ];

    // fk
    public function formPenangananIt(){
        return $this->belongsTo('App\FormPenangananIt', 'formPenangananItId');
    }

    public function karyawan(){
        return $this->belongsTo('App\KaryawanAll', 'karyawanId');
    }
}
