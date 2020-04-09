<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SatisRaporController extends Controller
{
    public function index()
    {
        $satis_durumu = DB::select('SELECT * FROM [dbo].[VW_ARG_WEB_SATIS_RAPOR]');
        dd($satis_durumu);
    }
}
