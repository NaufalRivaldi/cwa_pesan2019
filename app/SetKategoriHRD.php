<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetKategoriHRD extends Model
{
    protected $table = 'sethrd_kategori';
    protected $fillable = [
        'kategori_fhrd_id', 'form_hrd_id'
    ];

    public $timestamps = false;

    // fk
    public function formHRD(){
        return $this->belongsTo('App\FormHRD');
    }

    public function kategoriFhrd(){
        return $this->belongsTo('App\KategoriHRD');
    }
}
