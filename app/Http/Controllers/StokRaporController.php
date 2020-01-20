<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StokRaporController extends Controller
{
    public function index()
    {
        $data['raporlar'] = collect(DB::select('exec [dbo].[ARG_WEB_STOKDURUM] ?', [session('username')]));

        return view('rapor_stok', $data);
    }
}
