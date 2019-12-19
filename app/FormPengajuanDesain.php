<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPengajuanDesain extends Model
{
    protected $table = 'form_pengajuan_desain';
    protected $fillable = [
        'tgl_perlu', 'qty', 'ukuran', 'deskripsi', 'stat', 'keterangan', 'keterangan_lain', 'jenis_desain_id', 'user_id', 'karyawan_all_id'
    ];

    // fk
    public function jenisDesain(){
        return $this->belongsTo('App\JenisDesain', 'jenis_desain_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function karyawanAll(){
        return $this->belongsTo('App\KaryawanAll', 'karyawan_all_id');
    }
}
