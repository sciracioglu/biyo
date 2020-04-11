<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KapatmaController extends Controller
{
    public function index()
    {
        $alacaklar = collect(DB::select('exec [dbo].[ArgWebKapamaProcAlacak] ?', [session('musteri.hesapkod')]));
        dd($alacaklar);
        return view('kapatma', compact('alacaklar'));
    }
}
