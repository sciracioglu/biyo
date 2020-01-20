<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokDurumController extends Controller
{
    public function index()
    {
	return view('stok_durum');
    }

    public function show($mal_kod)
    {
	return collect(DB::select('EXEC [dbo].[spArgWebStokDurumMalkod] ?',[$mal_kod]));
    }
}
