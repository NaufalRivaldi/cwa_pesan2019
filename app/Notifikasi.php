<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $fillable = [
        'keterangan', 'link', 'stat', 'baca', 'user_id'
    ];

    // fk
    public function user(){
        return $this->belongsTo('App\User');
    }
}
