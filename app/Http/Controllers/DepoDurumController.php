<?php

namespace App\Http\Controllers;

use App\StokDurum;

class DepoDurumController extends Controller
{
    public function index()
    {
        $durumlar = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                            ->whereNotNull('STKKRT_ACIKLAMA3')
                            ->where('STKKRT_ACIKLAMA3', '<>', '')
                            ->where('STKKRT_ACIKLAMA3', 'ACCESSORIES')
                            ->get();
        $sonuclar = [];
        foreach ($durumlar as $durum) {
            array_push($sonuclar, ['aciklama'=>$durum->STKKRT_ACIKLAMA3, 'lkod8'=>$durum->STKKRT_LKOD8, 'depo'=>$durum->STKKRT_LKOD8 . ' - ' . $durum->DEPOKOD . ' - ' . $durum->DEPOAD]);
            $sonuclar[] =
                                                            [
                                                                'malad'   => $durum->STKKRT_MALAD,
                                                                'malkod'  => $durum->MALKOD,
                                                                'ozelkod' => $durum->STKKRT_OZELKOD,
                                                                'devir'   => $durum->STOKDEVIR,
                                                                'cikis'   => $durum->STOKCIKIS,
                                                                'miktar'  => $durum->STOKMIKTAR,
                                                                'seri'    => $durum->SERINO
                                                            ];
        }
        $sonuclar = json_encode($sonuclar, JSON_UNESCAPED_UNICODE);
        dd($sonuclar);
        return view('depo_durum', compact('sonuclar'));
    }
}
