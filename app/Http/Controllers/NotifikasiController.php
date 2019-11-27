<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifikasi;

class NotifikasiController extends Controller
{
    public function readnotif($id){
        $notif = Notifikasi::find($id);
        $notif->baca = 2;
        $notif->save();
    }

    public function clicknotif(){
        $notif = Notifikasi::where('user_id', auth()->user()->id)->update(['stat'=>'2']);
    }
}
