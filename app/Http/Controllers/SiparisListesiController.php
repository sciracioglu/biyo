<?php

namespace App\Http\Controllers;

use App\Siparis;
use App\Hareket;
use Illuminate\Support\Facades\DB;

class SiparisListesiController extends Controller
{
    public function index()
    {
        $siparisler =  Siparis::where('GIRENKULLANICI', session('username'))->get();
        return view('siparisListe', compact('siparisler'));
    }

    public function destroy($kalemsn)
    {
        DB::connection('sqlsrv')->statement('SET ANSI_NULLS, QUOTED_IDENTIFIER, CONCAT_NULL_YIELDS_NULL, ANSI_WARNINGS, ANSI_PADDING ON');
        Hareket::where('KALEMSN', $kalemsn)->delete();
    }
}
