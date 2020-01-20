<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\GecikenBakiyeGonder;

class GecikenBakiyeController extends Controller
{
    private $geciken;
    private $detay;
    private $evr_tip;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->geciken = DB::select('EXEC [dbo].[SP_ARG_GECIKEN_BAK] ?', [session('musteri.hesapkod')]);
            $this->detay   = DB::select('EXEC [dbo].[SP_ARG_GECIKEN_BAK_DETAY] ?', [session('musteri.hesapkod')]);
            $kod     = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='ISLEMTIP' AND TABLOAD='CARHAR'");
            foreach ($kod as $k) {
                $this->evr_tip[$k->KOD] = $k->ACIKLAMA;
            }
            return $next($request);
        });
    }

    public function index()
    {
        $geciken =  $this->geciken;
        $detay   = $this->detay;
        $evr_tip = $this->evr_tip;

        return view('geciken', compact('geciken', 'detay', 'evr_tip'));
    }

    public function store()
    {
        if (request()->has('email')) {
            Mail::to(request('email'))->send(new GecikenBakiyeGonder($this->geciken, $this->detay, $this->evr_tip));
        }

        return back();
    }
}
