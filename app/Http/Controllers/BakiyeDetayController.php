<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BakiyeDetayGonder;

class BakiyeDetayController extends Controller
{
    private $geciken;
    private $evr_tip;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->geciken = DB::select('EXEC [dbo].[SP_ARG_BAKIYE_DETAY] ?', [session('musteri.hesapkod')]);
            $kod           = DB::select("SELECT KOD,ACIKLAMA from refkrt where ALANAD='ISLEMTIP' AND TABLOAD='CARHAR'");
            foreach ($kod as $k) {
                $this->evr_tip[$k->KOD] = $k->ACIKLAMA;
            }
            return $next($request);
        });
    }

    public function index()
    {
        $geciken =  $this->geciken;
        $evr_tip = $this->evr_tip;

        return view('detay', compact('geciken', 'evr_tip'));
    }

    public function store()
    {
        if (request()->has('email')) {
            Mail::to(request('email'))->send(new BakiyeDetayGonder($this->geciken, $this->evr_tip));
        }

        return back();
    }
}
