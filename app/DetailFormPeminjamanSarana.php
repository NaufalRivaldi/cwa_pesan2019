<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFormPeminjamanSarana extends Model
{
    protected $table = 'detail_form_peminjaman_sarana';
    protected $fillable = [
        'tgl',
        'keterangan',
        'pukulA',
        'pukulB',
        'formPeminjamanId',
        'saranaId'
    ];
    public $timestamps = false;

    // fk
    public function sarana(){
        return $this->belongsTo('App\Sarana', 'saranaId');
    }
    
    public function formPeminjaman(){
        return $this->belongsTo('App\FormPeminjamanSarana', 'formPeminjamanId');
    }
}
