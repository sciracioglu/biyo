<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CekSenetGonder;

class CekSenetController extends Controller
{
    private $cek_senet;
    private $detay;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->cek_senet = DB::select('EXEC [dbo].[spArgWebGetCekSenet2] ?', [session('musteri.hesapkod')]);
            foreach ($cekSenet as $cek) {
                $this->detay[$cek->ISLEMTIPI] = DB::select('EXEC [dbo].[spArgWebGetCekSenet_Hrk] ?, ?', [session('musteri.hesapkod'), $cek->ISLEMTIPI]);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $cek_senet = $this->cek_senet;
        $detay     = $this->detay;

        return view('cek_senet', compact('cek_senet', 'detay'));
    }

    public function store()
    {
        if (request()->has('email')) {
            Mail::to(request('email'))->send(new CekSenetGonder($this->cek_senet, $this->detay));
        }

        return back();
    }
}
