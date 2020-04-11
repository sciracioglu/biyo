<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KapatmaController extends Controller
{
    public function index()
    {
        $borclar = collect(DB::select('exec ArgWebKapamaProc ?', [session('musteri.hesapkod')]));
        $alacaklar = collect(DB::select('exec [dbo].[ArgWebKapamaProcAlacak] ?', [session('musteri.hesapkod')]));

        return view('kapatma', compact('borclar', 'alacaklar'));
    }
}
