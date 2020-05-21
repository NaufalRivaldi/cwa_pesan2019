<?php

namespace App\Forms\formqa;

use Illuminate\Database\Eloquent\Model;

class FormQaUsulan extends Model
{
    protected $table = 'form_qa_usulan';
    protected $fillable = [
        'kode', 'kategori', 'keterangan', 'karyawanId', 'picId', 'status'
    ];

    public $timestamps = true;

    public function karyawan()
    {
        return $this->belongsTo('App\KaryawanAll', 'karyawanId');
    }

    public function detail()
    {
        return $this->hasMany('App\Forms\formqa\DetailFormQaUsulan', 'formId');
    }

    public function pic()
    {
        return $this->belongsTo('App\KaryawanAll', 'picId');
    }
}
