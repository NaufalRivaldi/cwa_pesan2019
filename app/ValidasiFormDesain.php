<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidasiFormDesain extends Model
{
    protected $table = 'validasi_form_desain';
    protected $fillable = [
        'form_pengajuan_desain_id', 'user_id', 'stat', 'keterangan'
    ];

    // fk
    public function formPengajuanDesain(){
        return $this->belongsTo('App\FormPengajuanDesain', 'form_pengajuan_desain_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
