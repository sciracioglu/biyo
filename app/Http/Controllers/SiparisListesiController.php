<?php

namespace App\Http\Controllers;

use App\Hareket;
use Illuminate\Support\Facades\DB;

class SiparisListesiController extends Controller
{
    public function index()
    {
        $siparisler =  collect(DB::select('EXEC [dbo].[spArgWebSiparisListesi] ?', [session('username')]));
        return view('siparisListe', compact('siparisler'));
    }

    public function destroy($kalemsn)
    {
        DB::connection('sqlsrv')->statement('SET ANSI_NULLS, QUOTED_IDENTIFIER, CONCAT_NULL_YIELDS_NULL, ANSI_WARNINGS, ANSI_PADDING ON');
        return DB::delete('EXEC [dbo].[spArgWebSiparisSil] ?',[$kalemsn]);
    }
}
