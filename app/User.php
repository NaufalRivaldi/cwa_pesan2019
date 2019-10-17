<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';

    protected $fillable = [
        'name', 'email', 'password', 'dep'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // FK
    public function pengumuman(){
        return $this->hasMany('App\Pengumuman');
    }

    public function pesan(){
        return $this->hasMany('App\Pesan');
    }

    public function penerima(){
        return $this->hasMany('App\Penerima');
    }

    public function hrd(){
        return $this->hasMany('App\FormHRD');
    }
}
