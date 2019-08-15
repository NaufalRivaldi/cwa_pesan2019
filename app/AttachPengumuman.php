<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachPengumuman extends Model
{
    protected $table = 'file_attach_pengumuman';
    protected $fillable = [
        'nama', 'nama_file', 'pengumuman_id'
    ];

    // fk
    public function pengumuman(){
        return $this->belongsTo('App\Pengumuman');
    }
}
