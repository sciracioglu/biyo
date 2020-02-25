<?php

namespace App\Http\Controllers;

use App\StokDurum;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepoDurumController extends Controller
{
    public function index()
    {
        $durumlar = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                            ->whereNotNull('STKKRT_ACIKLAMA3')
                            ->whereNotNull('STKKRT_LKOD8')
                            ->whereNotNull('DEPOAD')
                            ->where('STKKRT_ACIKLAMA3', '<>', '')
                            ->get();
        $bir = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                                ->whereNotNull('STKKRT_ACIKLAMA3')
                                ->where('STKKRT_ACIKLAMA3', '<>', '')
                                ->whereNotNull('STKKRT_LKOD8')
                            ->whereNotNull('DEPOAD')
                                ->groupBy('STKKRT_ACIKLAMA3')
                                ->get(['STKKRT_ACIKLAMA3',  DB::raw('count(*) as total')]);
        $iki = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                                ->whereNotNull('STKKRT_ACIKLAMA3')
                                ->where('STKKRT_ACIKLAMA3', '<>', '')
                                ->whereNotNull('STKKRT_LKOD8')
                            ->whereNotNull('DEPOAD')
                                ->groupBy('STKKRT_ACIKLAMA3')
                                ->groupBy('STKKRT_LKOD8')
                                ->get(['STKKRT_ACIKLAMA3', 'STKKRT_LKOD8', DB::raw('count(*) as total')]);
        $uc = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                                ->whereNotNull('STKKRT_ACIKLAMA3')
                                ->where('STKKRT_ACIKLAMA3', '<>', '')
                                ->whereNotNull('STKKRT_LKOD8')
                            ->whereNotNull('DEPOAD')
                                ->groupBy('STKKRT_ACIKLAMA3')
                                ->groupBy('STKKRT_LKOD8')
                                ->groupBy('DEPOAD', 'DEPOKOD')
                                ->get([
                                        'STKKRT_ACIKLAMA3', 'STKKRT_LKOD8', 'DEPOAD', 'DEPOKOD',
                                        DB::raw('count(*) as total')
                                    ]);
        $sonuclar = [];

        foreach ($durumlar as $durum) {
            $sonuclar[$durum->STKKRT_ACIKLAMA3][$durum->STKKRT_LKOD8][$durum->STKKRT_LKOD8 . ' - ' . $durum->DEPOKOD . ' - ' . $durum->DEPOAD][] =
                                                            [
                                                                'malad'   => $durum->STKKRT_MALAD,
                                                                'malkod'  => $durum->MALKOD,
                                                                'ozelkod' => $durum->STKKRT_OZELKOD,
                                                                'miktar'  => $durum->STOKMIKTAR,
                                                                'seri'    => $durum->SERINO,
                                                                'tarih'   => Carbon::parse($durum->SERKRT_SONKULLANMATARIH)->format('d/m/Y')
                                                            ];
        }
        $sonuclar = json_encode($sonuclar, JSON_UNESCAPED_UNICODE);
        return view('depo_durum', compact('sonuclar', 'bir', 'iki', 'uc'));
    }
}
