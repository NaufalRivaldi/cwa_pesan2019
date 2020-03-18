<?php

namespace App\Forms\formcuti;

use Illuminate\Database\Eloquent\Model;

class DetailFormCuti extends Model
{
    protected $table = 'detail_form_cuti';
    protected $fillable = [
        'idCuti',
        'idFormCuti',
        'tanggalCuti',
        'keterangan'
    ];

    public function cuti()
    {
        return $this->belongsTo('App\Forms\formcuti\Cuti','idCuti');
    }

    public function formCuti()
    {
        return $this->belongsTo('App\Forms\formcuti\FormCuti', 'idFormCuti');
    }
}
