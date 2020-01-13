<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPerbaikanSarana extends Model
{
    protected $table = 'form_perbaikan_sarana';
    protected $fillable = [
        'tglPengajuan', 'tglSelesai', 'permintaan', 'alasan', 'status', 'keterangan', 'userId'
    ];

    // fk
    public function user(){
        return $this->belongsTo('App\User', 'userId');
    }
}
