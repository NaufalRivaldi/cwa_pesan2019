<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachment';
    protected $fillable = [
        'nama', 'nama_file', 'pesan_id'
    ];

    public function pesan(){
        return $this->belongsTo('App\Pesan');
    }
}
