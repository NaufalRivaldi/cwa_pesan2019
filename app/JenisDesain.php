<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisDesain extends Model
{
    protected $table = 'jenis_desain';
    protected $fillable = ['nama'];
    public $timestamps = false;

    // fk
    public function formPengajuanDesain(){
        return $this->hasMany('App\FormPengajuanDesain', 'jenis_desain_id');
    }
}
