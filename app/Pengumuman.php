<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = [
        'subject', 'tgl', 'pesan', 'tgl_akhir', 'stat', 'user_id'
    ];

    // FK
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function attachPengumuman(){
        return $this->hasMany('App\AttachPengumuman', 'pengumuman_id');
    }
}
