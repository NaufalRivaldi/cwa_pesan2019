<?php

namespace App\Forms\formqa;

use Illuminate\Database\Eloquent\Model;

class MasterFile extends Model
{
    protected $table = 'master_file';
    protected $fillable = [
        'nama', 'kategori', 'no_form', 'no_revisi', 'tgl_terbit'
    ];

    public $timestamps = false;

    public function detail()
    {
        return $this->hasMany('App\Forms\formqa\DetailFormQaUsulan', 'fileId');
    }
}
