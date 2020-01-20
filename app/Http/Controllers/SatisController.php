<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SatisGonder;

class SatisController extends Controller
{
    private $grup;
    private $detay;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->grup = DB::select('SELECT * FROM VW_WEB_MUSTERI_STOK_GRUP WHERE HESAPKOD=? ORDER BY EVRAKYIL DESC, EVRAKAY DESC', [session('musteri.hesapkod')]);

            foreach ($this->grup as $g) {
                $this->detay[$g->EVRAKYIL][$g->EVRAKAY] = DB::select("SELECT EVRAKTIPI, EVRAKNO, EVRAKTARIH, MALKOD, MALAD, MIKTAR, FIYAT, FIYATDOVIZCINS, FIYATDOVIZKUR, DOVIZTUTAR,
                                    DOVIZISKONTO, DOVIZKDV, _DOVIZNETTUTAR, _DOVIZTOPLAM FROM dbo.VW_WEB_MUSTERI_STOK_1
                                    WHERE (HESAPKOD = ?) AND EVRAKYIL = ? AND EVRAKAY = ? AND EVRAKTIPI != 'Satışdan İade Faturası' ORDER BY EVRAKTARIH DESC", [
                    session('musteri.hesapkod'),
                    $g->EVRAKYIL,
                    $g->EVRAKAY
                ]);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $grup  = $this->grup;
        $detay = $this->detay;

        return view('satis', compact('grup', 'detay'));
    }

    public function store()
    {
        if (request()->has('email')) {
            Mail::to(request('email'))->send(new SatisGonder($this->grup, $this->detay));
        }

        return back();
    }
}
