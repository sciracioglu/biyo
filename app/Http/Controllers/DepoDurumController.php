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
                            ->get();
        $sonuclar = [];
        foreach ($durumlar as $durum) {
            $sonuclar[$durum->STKKRT_ACIKLAMA3]['toplam']                                                                                                = 0;
            $sonuclar[$durum->STKKRT_ACIKLAMA3][$durum->STKKRT_LKOD8]['toplam']                                                                          = 0;
            //$sonuclar[$durum->STKKRT_ACIKLAMA3][$durum->STKKRT_LKOD8][$durum->STKKRT_LKOD8 . ' - ' . $durum->DEPOKOD . ' - ' . $durum->DEPOAD]['toplam'] = 0;
        }
        foreach ($durumlar as $durum) {
            $sonuclar[$durum->STKKRT_ACIKLAMA3][$durum->STKKRT_LKOD8][$durum->STKKRT_LKOD8 . ' - ' . $durum->DEPOKOD . ' - ' . $durum->DEPOAD][] =
                                                            [
                                                                'malad'   => $durum->STKKRT_MALAD,
                                                                'malkod'  => $durum->MALKOD,
                                                                'ozelkod' => $durum->STKKRT_OZELKOD,
                                                                'miktar'  => $durum->STOKMIKTAR,
                                                                'seri'    => $durum->SERINO,
                                                                'tarih'   => $durum->SERKRT_SONKULLANMATARIH
                                                            ];
            $sonuclar[$durum->STKKRT_ACIKLAMA3]['toplam'] += $durum->STOKMIKTAR;
            $sonuclar[$durum->STKKRT_ACIKLAMA3][$durum->STKKRT_LKOD8]['toplam'] += $durum->STOKMIKTAR;
            // $sonuclar[$durum->STKKRT_ACIKLAMA3][$durum->STKKRT_LKOD8][$durum->STKKRT_LKOD8 . ' - ' . $durum->DEPOKOD . ' - ' . $durum->DEPOAD]['toplam'] += $durum->STOKMIKTAR;
        }
        $sonuclar = json_encode($sonuclar, JSON_UNESCAPED_UNICODE);
        return view('depo_durum', compact('sonuclar'));
    }
}
