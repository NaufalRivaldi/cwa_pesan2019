<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPeminjamanSarana extends Model
{
    protected $table = 'form_peminjaman_sarana';
    protected $fillable = [
        'status',
        'userId'
    ];
    public $timestampt = false;

    // fk
    public function detailForm(){
        return $this->hasMany('App\DetailFormPeminjamanSarana', 'formPeminjamanId');
    }

    public function user(){
        return $this->belongsTo('App\User', 'userId');
    }
}
