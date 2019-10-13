<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';
    protected $fillable = [
        'subject', 'message', 'tgl', 'stat', 'user_id'
    ];

    // fk
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function attach(){
        return $this->hasMany('App\Attachment');
    }

    public function penerima(){
        return $this->hasMany('App\Penerima');
    }
}
