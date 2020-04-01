<?php

namespace App\Http\Controllers;

use App\StokDurum;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepoDurumController extends Controller
{
    public function index()
    {
        if (DB::select('EXEC [dbo].[ARG_WEB_STOKDURUM_GRUP]')) {
            $durumlar = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                            ->orderBy('STKKRT_LKOD8')
                            ->orderBy('DEPOKOD')
                            ->orderBy('DEPOAD')
                            ->whereNotNull('STKKRT_ACIKLAMA3')
                            ->where('STKKRT_ACIKLAMA3', '<>', '')
                            ->get();
            $bir = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                                ->whereNotNull('STKKRT_ACIKLAMA3')
                                ->where('STKKRT_ACIKLAMA3', '<>', '')
                                ->groupBy('STKKRT_ACIKLAMA3')
                                ->get(['STKKRT_ACIKLAMA3',  DB::raw('sum(STOKMIKTAR) as total')]);
            $iki = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                                ->whereNotNull('STKKRT_ACIKLAMA3')
                                ->where('STKKRT_ACIKLAMA3', '<>', '')
                                ->groupBy('STKKRT_ACIKLAMA3','STKKRT_LKOD8','MALKOD')
                                ->get(['STKKRT_ACIKLAMA3', 'STKKRT_LKOD8','MALKOD', DB::raw('sum(STOKMIKTAR) as total')]);
            $uc = StokDurum::orderBy('STKKRT_ACIKLAMA3')
                                ->whereNotNull('STKKRT_ACIKLAMA3')
                                ->where('STKKRT_ACIKLAMA3', '<>', '')
                                ->groupBy('STKKRT_ACIKLAMA3')
                                ->groupBy('STKKRT_LKOD8')
                                ->groupBy('DEPOAD', 'DEPOKOD')
                                ->get([
                                    'STKKRT_ACIKLAMA3', 'STKKRT_LKOD8', 'DEPOAD', 'DEPOKOD',
                                    DB::raw('sum(STOKMIKTAR) as total')
                                ]);
            $sonuclar = [];

            foreach ($durumlar as $durum) {
                $sonuclar[$durum->STKKRT_ACIKLAMA3]
                        [$durum->STKKRT_LKOD8.'-'.$durum->MALKOD]
                        [$durum->STKKRT_LKOD8 . ' - ' . $durum->DEPOKOD . ' - ' . $durum->DEPOAD . '-' . $durum->MALKOD]
                        [] = [
                                'malad' => $durum->STKKRT_MALAD,
                                'malkod' => $durum->MALKOD,
                                'ozelkod' => $durum->STKKRT_OZELKOD,
                                'miktar' => $durum->STOKMIKTAR,
                                'seri' => $durum->SERINO,
                                'tarih' => Carbon::parse($durum->SERKRT_SONKULLANMATARIH)->format('d/m/Y')
                            ];
            }
            $sonuclar = json_encode($sonuclar, JSON_UNESCAPED_UNICODE);
            return view('depo_durum', compact('sonuclar', 'bir', 'iki', 'uc'));
        }
    }
}
