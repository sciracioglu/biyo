<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MusteriController extends Controller
{
    public function index()
    {
        $musteri = DB::select('exec spArgWebGetCari ?', [
            session('username')
        ]);

        $liste   = [];
        foreach ($musteri as $m) {
            $liste[$m->HESAPKOD] = $m->HESAPKOD . ' - ' . $m->UNVAN . ' ' . $m->UNVAN2;
        }

        return view('anasayfa', compact('liste'));
    }

    public function store()
    {
        if (request()->has('musteri')) {
            $musteri = DB::select('SELECT * FROM dbo.CARKRT WHERE HESAPKOD = ?', [
                request('musteri')
            ]);

            if ($musteri) {
                session()->put('musteri.hesapkod', request('musteri'));
                session()->put('musteri.unvan', $musteri[0]->UNVAN . ' ' . $musteri[0]->UNVAN2);
                return view('musteri', compact('musteri'));
            }
        }
    }
}
