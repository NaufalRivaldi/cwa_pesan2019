<?php

namespace App\Forms\formqa;

use Illuminate\Database\Eloquent\Model;

class MasterFile extends Model
{
    protected $table = 'master_file';
    protected $fillable = [
        'dep', 'nama', 'kategori'
    ];

    public $timestamps = false;

    public function detail()
    {
        return $this->hasMany('App\Forms\formqa\DetailFormQaUsulan', 'fileId');
    }
}
