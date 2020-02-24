<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DepoDurumController extends Controller
{
    public function index()
    {
        $durumlar = DB::select('EXEC ARG_WEB_STOKDURUM_GRUP');
        $sonuclar = [];
        foreach ($durumlar as $durum) {
            if ($durum->STKKRT_ACIKLAMA3 === '') {
                continue;
            }
            $sonuclar[$durum->STKKRT_ACIKLAMA3][$durum->STKKRT_LKOD8][$durum->STKKRT_LKOD8 . '-' . $durum->DEPOKOD . '-' . $durum->DEPOAD][] =[
                                                                    'malad'   => $durum->STKKRT_MALAD,
                                                                    'malkod'  => $durum->MALKOD,
                                                                    'ozelkod' => $durum->STKKRT_OZELKOD,
                                                                    'devir'   => $durum->STOKDEVIR,
                                                                    'cikis'   => $durum->STOKCIKIS,
                                                                    'miktar'  => $durum->STOKMIKTAR,
                                                                    'seri'    => $durum->SERINO
                                                                ];
        }
        $sonuclar = collect(ksort($sonuclar));

        return view('depo_durum', compact('sonuclar'));
    }
}
