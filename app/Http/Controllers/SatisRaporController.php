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
         ORDER BY EVRAKYIL DESC'));

        return view('satis_rapor', compact('yillik_satislar'));
    }
}
