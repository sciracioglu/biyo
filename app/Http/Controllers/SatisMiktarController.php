<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SatisMiktarGonder;

class SatisMiktarController extends Controller
{
    private $yilllar;
    private $analiz;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->yillar = DB::select('SELECT EVRAKYIL
            FROM VW_ARG_WEB_SATIS_ANALIZ_FINAL
            WHERE HESAPKOD = ? GROUP BY EVRAKYIL ORDER BY EVRAKYIL DESC', [session('musteri.hesapkod')]);

            foreach ($this->yillar as $yil) {
                $this->analiz[$yil->EVRAKYIL] = DB::select('SELECT HESAPKOD,UNVAN,UNVAN2,EVRAKYIL,MALKOD,MALAD,BIRIM,OCAK_MIKTAR,SUBAT_MIKTAR,MART_MIKTAR,
            NISAN_MIKTAR,MAYIS_MIKTAR,HAZIRAN_MIKTAR,TEMMUZ_MIKTAR,AGUSTOS_MIKTAR,EYLUL_MIKTAR,EKIM_MIKTAR,KASIM_MIKTAR,
            ARALIK_MIKTAR,TOPLAM_MIKTAR 
            FROM VW_ARG_WEB_SATIS_ANALIZ_MIKTAR
            WHERE HESAPKOD = ? AND EVRAKYIL = ?', [session('musteri.hesapkod'), $yil->EVRAKYIL]);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $yillar =  $this->yillar;
        $analiz = $this->analiz;

        return view('satis_analiz_miktar', compact('yillar', 'analiz'));
    }

    public function store()
    {
        if (request()->has('email')) {
            Mail::to(request('email'))->send(new SatisMiktarGonder($this->yillar, $this->analiz));
        }

        return back();
    }
}
