<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SatisRaporController extends Controller
{
    public function index()
    {
        $yillik_satislar = collect(DB::select('SELECT EVRAKYIL,
        SUM(MIKTAR) AS T_MIKTAR,
        SUM(EVRAKTUTAR) AS T_TUTAR,
        SUM(ISKONTO) AS T_ISKONTO,
        SUM(EVRAKNETTUTAR) AS T_NETTUTAR,
        SUM(KDV) AS T_KDV,
        SUM(TOPLAM) AS T_TOPLAM
         FROM [dbo].[VW_ARG_WEB_SATIS_RAPOR]
         GROUP BY EVRAKYIL
         ORDER BY EVRAKYIL DESC'))
         ->map(function($yil){
             return [
                 'yil' => $yil->EVRAKYIL,
                 'miktar' => $yil->T_MIKTAR,
                 'tutar' => $yil->T_TUTAR,
                 'iskonto' => $yil->T_ISKONTO,
                 'nettutar' => $yil->T_NETTUTAR,
                 'kdv' => $yil->T_KDV,
                 'toplam' => $yil->T_TOPLAM,
                 'aylar' => $this->aylar($yil->EVRAKYIL),
             ];
         });

        return view('satis_rapor', compact('yillik_satislar'));
    }

    private function aylar($yil)
    {
        return collect(DB::select('SELECT EVRAKYIL, EVRAKAY,
        SUM(MIKTAR) AS T_MIKTAR,
        SUM(EVRAKTUTAR) AS T_TUTAR,
        SUM(ISKONTO) AS T_ISKONTO,
        SUM(EVRAKNETTUTAR) AS T_NETTUTAR,
        SUM(KDV) AS T_KDV,
        SUM(TOPLAM) AS T_TOPLAM
         FROM [dbo].[VW_ARG_WEB_SATIS_RAPOR]
         WHERE EVRAKYIL = ?
         GROUP BY EVRAKYIL, EVRAKAY
         ORDER BY EVRAKYIL DESC, EVRAKAY ASC',[$yil]))
         ->map(function($ay){
            return [
                'yil' => $ay->EVRAKYIL,
                'ay' => $ay->EVRAKAY,
                'miktar' => $ay->T_MIKTAR,
                'tutar' => $ay->T_TUTAR,
                'iskonto' => $ay->T_ISKONTO,
                'nettutar' => $ay->T_NETTUTAR,
                'kdv' => $ay->T_KDV,
                'toplam' => $ay->T_TOPLAM,
                'musteriler' => $this->musteriler($ay->EVRAKYIL, $ay->EVRAKAY),
            ];
         });
    }

    private function musteriler($yil, $ay)
    {
        return collect(DB::select('SELECT EVRAKYIL, EVRAKAY, CARKRT_UNVAN, CARKRT_UNVAN2, HESAPKOD
        SUM(MIKTAR) AS T_MIKTAR,
        SUM(EVRAKTUTAR) AS T_TUTAR,
        SUM(ISKONTO) AS T_ISKONTO,
        SUM(EVRAKNETTUTAR) AS T_NETTUTAR,
        SUM(KDV) AS T_KDV,
        SUM(TOPLAM) AS T_TOPLAM
         FROM [dbo].[VW_ARG_WEB_SATIS_RAPOR]
         WHERE EVRAKYIL = ?
         AND EVRAKAY = ?
         GROUP BY EVRAKYIL, EVRAKAY, HESAPKOD, CARKRT_UNVAN, CARKRT_UNVAN2
         ORDER BY EVRAKTARIH DESC',[$yil, $ay]))
         ->map(function($musteri){
            return [
                'yil' => $musteri->EVRAKYIL,
                'ay' => $musteri->EVRAKAY,
                'unvan' => $musteri->CARKRT_UNVAN.' '.$musteri->CARKRT_UNVAN2,
                'miktar' => $musteri->T_MIKTAR,
                'tutar' => $musteri->T_TUTAR,
                'iskonto' => $musteri->T_ISKONTO,
                'nettutar' => $musteri->T_NETTUTAR,
                'kdv' => $musteri->T_KDV,
                'toplam' => $musteri->T_TOPLAM,
                'hesaplar' => $this->hesaplar($musteri->EVRAKYIL, $musteri->EVRAKAY, $musteri->HESAPKOD),
            ];
         });
    }

    private function hesaplar($yil, $ay, $hesapkod)
    {
        return collect(DB::select('SELECT *
         FROM [dbo].[VW_ARG_WEB_SATIS_RAPOR]
         WHERE EVRAKYIL = ?
         AND EVRAKAY = ?
         AND HESAPKOD = ?
         ORDER BY EVRAKYIL DESC',[$yil, $ay, $hesapkod]))
         ->map(function($hesap){
            return [
                'yil' => $hesap->EVRAKYIL,
                'ay' => $hesap->EVRAKAY,
                'unvan' => $hesap->CARKRT_UNVAN . ' '. $hesap->CARKRT_UNVAN2,
                'evrak_net_tutar' => $hesap->EVRAKNETTUTAR,
                'net_tutar' => $hesap->NETTUTAR,
                'toplam' => $hesap->TOPLAM,
                'birim_fiyat' => $hesap->BIRIMFIYAT,
                'evrak_no' => $hesap->EVRAKNO,
                'evrak_tarih' => $hesap->EVRAKTARIH,
                'evrak_tip' => $hesap->EVRAKTIP,
                'evrak_tutar' => $hesap->EVRAKTUTAR,
                'hesapkod' => $hesap->HESAPKOD,
                'iskonto' => $hesap->ISKONTO,
                'islem_tip' => $hesap->ISLEMTIP,
                'kdv' => $hesap->KDV,
                'malkod' => $hesap->MALKOD,
                'miktar' => $hesap->MIKTAR,
                'serino' => $hesap->SERINO,
                'tutar' => $hesap->TUTAR,
                'vade_tarih' => $hesap->VADETARIH,
                'aciklama' => $hesap->STKKRT_ACIKLAMA1,
                'grupkod' => $hesap->STKKRT_GRUPKOD,
                'malad' => $hesap->STKKRT_MALAD,
                'malkod' => $hesap->STKKRT_MKOD1,
                'tipkod' => $hesap->STKKRT_TIPKOD,
            ];
         });
    }
}
