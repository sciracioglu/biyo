<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DepoDurumController extends Controller
{
    public function index()
    {
        $durumlar = DB::select('EXEC ARG_WEB_STOKDURUM_GRUP');
        dd($durumlar);
    }
}
