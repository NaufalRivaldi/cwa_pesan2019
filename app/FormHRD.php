<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormHRD extends Model
{
    protected $table = 'form_hrd';
    protected $fillable = [
        'kategori', 'tgl_a', 'tgl_b', 'keterangan', 'stat', 'user_id', 'karyawan_all_id', 'created_at'
    ];

    // fk
    public function karyawanAll(){
        return $this->belongsTo('App\KaryawanAll');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
