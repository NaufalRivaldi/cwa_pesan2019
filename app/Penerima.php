<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    protected $table = 'penerima';
    protected $fillable = [
        'pesan_id', 'user_id', 'read_user', 'stat'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
