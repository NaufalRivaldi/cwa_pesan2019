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
        'nama', 'email', 'email_verified_at', 'password', 'dep', 'stat','level'
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

    public function validasiFhrd(){
        return $this->hasMany('App\validasiFhrd');
    }

    public function notifikasi(){
        return $this->hasMany('App\Notifikasi');
    }

    public function formPenangananIt(){
        return $this->hasMany('App\FormPenangananIt', 'user_id');
    }

    public function validasiFormDesain(){
        return $this->hasMany('App\ValidasiFormDesain', 'user_id');
    }

    public function formPengajuanDesain(){
        return $this->hasMany('App\FormPengajuanDesain', 'user_id');
    }

    public function poling(){
        return $this->hasMany('App\PKK\Poling', 'userId');
    }

    public function penilaian(){
        return $this->hasMany('App\PKK\Penilaian', 'userId');
    }
    
    public function formPerbaikanSarana(){
        return $this->hasMany('App\FormPerbaikanSarana', 'userId');
    }
    
    public function verifikasi_cuti(){
        return $this->hasMany('App\Forms\formcuti\VerifikasiFormCuti', 'userId');
    }

    public function formPeminjamanSarana(){
        return $this->hasMany('App\FormPeminjamanSarana', 'userId');
    }

    public function penilaianEmployee(){
        return $this->hasMany('App\PenilaianEmployee', 'userId');
    }

    public function formCuti()
    {
        return $this->hasMany('App\Forms\formcuti\FormCuti', 'userId');
    }
}
