<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StokDurumController extends Controller
{
    public function index()
    {
        $stoklar = collect(DB::select('EXEC [dbo].[spArgWebStokDurumMalkod] ?',[session('username')]));

	    return view('stok_durum', collect($stoklar));
    }

  
}
