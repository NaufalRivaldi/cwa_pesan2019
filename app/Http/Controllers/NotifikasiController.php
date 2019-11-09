<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifikasi;

class NotifikasiController extends Controller
{
    public function readnotif($id){
        $notif = Notifikasi::find($id);
        $notif->stat = 2;
        $notif->save();
        echo "lol";
    }
}
