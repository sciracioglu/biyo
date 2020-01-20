<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RiskGonder;

class RiskController extends Controller
{
    private $bakiye;
    private $bakiye_bakiye;
    private $bakiye_tip;
    private $ust_bakiye;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->bakiye= DB::select("EXEC dbo.SPAPP_RISK @SABLONNO = 0, @SIRKETNO = '002', @HESAPKOD = ?, @GOSTERIMTIP = 0, @DOVIZTIP = 0", [
                session('musteri.hesapkod')
            ]);
            $this->bakiye_bakiye = DB::select("SELECT GUNCELBAKIYE, GECIKENBAKIYEORTVADE, DOVIZGECIKENBAKIYE,DOVIZBAKIYE AS BAKIYE,
            (CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS [BAKIYE_ORTALAMA_VADESI],
             BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
                session('musteri.hesapkod')
            ]);
            $tip        = DB::select("SELECT KOD,r.ACIKLAMA FROM dbo.REFKRT r WHERE r.TABLOAD='PRMRIT' AND r.ALANAD='RISKTIP' ORDER BY r.KOD");
            foreach ($tip as $t) {
                $this->bakiye_tip[$t->KOD] = $t->ACIKLAMA;
            }
            $this->ust_bakiye = DB::select("SELECT DOVIZBAKIYE AS BAKIYE, (CASE WHEN DOVIZCINS = '' THEN 'TL' ELSE
                                        DOVIZCINS END) AS [HESAP_PARA_BIRIMI],BAKIYEORTVADE AS                
                                        [BAKIYE_ORTALAMA_VADESI], BAKIYEVADEFARKGUN*-1 AS [BAKIYE_BEKLEME_SURESI] 
                        FROM dbo.XAYBAK WHERE (KARTKOD = ?)", [
                                                                session('musteri.hesapkod')
                                                         ]);

            return $next($request);
        });
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $bakiye_bakiye = $this->bakiye_bakiye;
        $ust_bakiye    = $this->ust_bakiye;
        $bakiye        = $this->bakiye;
        $bakiye_tip    = $this->bakiye_tip;
        return view('risk', compact('bakiye', 'bakiye_tip', 'ust_bakiye', 'bakiye_bakiye'));
    }

    public function store()
    {
        if (request()->has('email')) {
            Mail::to(request('email'))->send(new RiskGonder($this->bakiye, $this->bakiye_bakiye, $this->bakiye_tip, $this->ust_bakiye));
        }

        return back();
    }
}
